<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DtiCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection; // Import Collection

class DtiCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Kiểm tra quyền truy cập 'configure indicators'
        $this->authorize('configure indicators');

        $sortField = $request->query('sort', 'order_column'); // Mặc định sắp xếp theo order_column
        $sortDirection = $request->query('direction', 'asc'); // Mặc định sắp xếp tăng dần

        // Đảm bảo chỉ sắp xếp theo các trường hợp lệ
        if (!in_array($sortField, ['id', 'name', 'order_column'])) {
            $sortField = 'order_column';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Lấy tất cả danh mục, eager load quan hệ 'parent' và phân trang
        $categories = DtiCategory::with('parent')
                                ->orderBy($sortField, $sortDirection)
                                ->paginate(10);

        return view('admin.dti-categories.index', compact('categories', 'sortField', 'sortDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Kiểm tra quyền truy cập 'configure indicators'
        $this->authorize('configure indicators');

        // Lấy tất cả các danh mục để làm danh mục cha, eager load children đệ quy
        $allCategories = DtiCategory::whereNull('parent_id')
                                ->with('children') // Tải quan hệ con
                                ->orderBy('order_column')
                                ->get();

        $parentCategories = $this->getFormattedCategoriesForDropdown($allCategories);

        return view('admin.dti-categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Kiểm tra quyền truy cập 'configure indicators'
        $this->authorize('configure indicators');

        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                // Quy tắc unique: tên danh mục phải duy nhất trong cùng một cấp độ cha
                Rule::unique('dti_categories')->where(function ($query) use ($request) {
                    return $query->where('parent_id', $request->parent_id);
                }),
            ],
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:dti_categories,id', // parent_id có thể null hoặc phải tồn tại
        ], [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.unique' => 'Tên danh mục đã tồn tại trong cùng cấp độ.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
        ]);

        // Gán order_column tự động
        // Tìm order_column lớn nhất hiện có. Nếu không có, bắt đầu từ 1.
        $maxOrder = DtiCategory::max('order_column');
        $validatedData['order_column'] = $maxOrder ? $maxOrder + 1 : 1;

        // Tạo danh mục mới
        $newCategory = DtiCategory::create($validatedData);

        // Xây dựng thông báo thành công tùy chỉnh
        $message = "Bạn đã thêm thành công danh mục '{$newCategory->name}'";
        if ($newCategory->parent_id) {
            // Eager load parent nếu chưa có để đảm bảo truy cập $newCategory->parent->name
            $newCategory->loadMissing('parent');
            $parentName = $newCategory->parent->name ?? 'không xác định';
            $message .= " con của danh mục '{$parentName}'.";
        } else {
            $message .= " cấp cao nhất.";
        }

        // Sau khi lưu thành công, redirect về lại trang create với cờ status và message
        // để JavaScript trong create.blade.php có thể xử lý việc đóng tab và gửi thông báo.
        return redirect()->route('admin.dti-categories.create')
                         ->with('status', 'success')
                         ->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(DtiCategory $dtiCategory)
    {
        // Kiểm tra quyền truy cập 'configure indicators'
        $this->authorize('configure indicators');

        // Eager load parent relationship for display
        $dtiCategory->load('parent');

        return view('admin.dti-categories.show', compact('dtiCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DtiCategory $dtiCategory)
    {
        // Kiểm tra quyền truy cập 'configure indicators'
        $this->authorize('configure indicators');

        // Lấy tất cả các danh mục gốc, eager load children đệ quy
        $allCategories = DtiCategory::whereNull('parent_id')
                                ->with('children')
                                ->orderBy('order_column')
                                ->get();

        // Tạo một collection rỗng để lưu các danh mục đã lọc
        $filteredCategories = new Collection();

        // Lọc ra chính danh mục đang sửa và các danh mục con cháu của nó
        // để không cho phép chọn chúng làm cha để tránh vòng lặp.
        $this->filterAndBuildCategories(
            $allCategories,
            $dtiCategory,
            $filteredCategories
        );

        // Định dạng danh sách các danh mục hợp lệ để làm cha cho dropdown
        $parentCategories = $this->getFormattedCategoriesForDropdown($filteredCategories);

        return view('admin.dti-categories.edit', compact('dtiCategory', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DtiCategory $dtiCategory)
    {
        // Kiểm tra quyền truy cập 'configure indicators'
        $this->authorize('configure indicators');

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                // Quy tắc unique: tên danh mục phải duy nhất trong cùng một cấp độ cha, bỏ qua chính nó
                Rule::unique('dti_categories')->ignore($dtiCategory->id)->where(function ($query) use ($request) {
                    return $query->where('parent_id', $request->parent_id);
                }),
            ],
            'description' => 'nullable|string',
            'parent_id' => [
                'nullable',
                'exists:dti_categories,id',
                // Quy tắc tùy chỉnh để ngăn danh mục tự làm cha cho chính nó hoặc con cháu của nó
                function ($attribute, $value, $fail) use ($dtiCategory) {
                    if ($value && (int)$value === $dtiCategory->id) { // Đảm bảo so sánh kiểu số nguyên
                        $fail('Danh mục cha không thể là chính nó.');
                    }
                    if ($value && $dtiCategory->isDescendantOf((int)$value)) { // Ép kiểu $value sang int
                        $fail('Danh mục cha không thể là một danh mục con của nó.');
                    }
                },
            ],
        ], [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.unique' => 'Tên danh mục đã tồn tại trong cùng cấp độ.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
        ]);

        $dtiCategory->update($request->all());

        return redirect()->route('admin.dti-categories.index')
                         ->with('success', 'Danh mục DTI đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DtiCategory $dtiCategory)
    {
        // Kiểm tra quyền truy cập 'configure indicators'
        $this->authorize('configure indicators');

        $dtiCategory->delete();

        return redirect()->route('admin.dti-categories.index')
                         ->with('success', 'Danh mục DTI đã được xóa thành công.');
    }

    /**
     * Update the order of resources.
     */
    public function updateOrder(Request $request)
    {
        // Kiểm tra quyền truy cập 'configure indicators'
        $this->authorize('configure indicators');

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:dti_categories,id', // Đảm bảo các ID tồn tại
        ]);

        $ids = $request->input('ids');

        foreach ($ids as $index => $id) {
            DtiCategory::where('id', $id)->update(['order_column' => $index + 1]);
        }

        return response()->json(['message' => 'Thứ tự danh mục đã được cập nhật thành công.'], 200);
    }

    /**
     * Hàm trợ giúp đệ quy để lọc các danh mục (loại bỏ danh mục đang sửa và con cháu của nó).
     *
     * @param Collection $categories Nguồn danh mục để lọc.
     * @param DtiCategory $excludeCategory Danh mục cần loại trừ.
     * @param Collection $resultCollection Collection để thêm các danh mục đã lọc vào.
     * @param int $level Cấp độ hiện tại để kiểm soát thụt lề cho debug (không sử dụng trực tiếp cho filter logic)
     */
    protected function filterAndBuildCategories(
        Collection $categories,
        DtiCategory $excludeCategory,
        Collection &$resultCollection
    ) {
        foreach ($categories as $category) {
            // Kiểm tra xem danh mục hiện tại có phải là chính danh mục đang sửa
            // hoặc là con cháu của danh mục đang sửa hay không.
            // Nếu có, bỏ qua danh mục này và các con của nó.
            if ($category->id === $excludeCategory->id || $category->isDescendantOf($excludeCategory->id)) {
                continue;
            }

            // Thêm danh mục vào kết quả
            $resultCollection->push($category);

            // Xử lý các danh mục con (đệ quy)
            if ($category->children->isNotEmpty()) {
                $this->filterAndBuildCategories($category->children, $excludeCategory, $resultCollection);
            }
        }
    }


    /**
     * Hàm trợ giúp để xây dựng danh sách danh mục thụt lề cho dropdown.
     *
     * @param Collection $categories Collection các danh mục (đã được eager load children).
     * @param int $level Cấp độ hiện tại để thụt lề.
     * @param string $prefix Ký tự tiền tố cho mỗi cấp độ (ví dụ: '-').
     * @return array Danh sách danh mục đã định dạng (ID và tên có thụt lề).
     */
    protected function getFormattedCategoriesForDropdown(
        Collection $categories,
        int $level = 0,
        string $prefix = '--'
    ): array {
        $formattedList = [];
        foreach ($categories as $category) {
            $indent = $level > 0 ? str_repeat($prefix, $level) . ' ' : '';
            $formattedList[] = [
                'id' => $category->id,
                'name' => $indent . $category->name,
            ];

            // Đệ quy gọi hàm cho các danh mục con
            if ($category->children->isNotEmpty()) {
                $formattedList = array_merge(
                    $formattedList,
                    $this->getFormattedCategoriesForDropdown($category->children, $level + 1, $prefix)
                );
            }
        }
        return $formattedList;
    }
}