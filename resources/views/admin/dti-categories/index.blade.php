<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý Danh mục DTI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Danh sách Danh mục DTI</h3>
                        {{-- Nút "Thêm Danh mục mới" mở tab mới thông qua JS --}}
                        <button type="button"
                                onclick="openCreateCategoryTab()"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Thêm Danh mục mới') }}
                        </button>
                    </div>

                    {{-- Khu vực hiển thị thông báo từ tab con --}}
                    <div id="dynamic-success-message" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline" id="dynamic-message-text"></span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="document.getElementById('dynamic-success-message').classList.add('hidden');">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                             <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.classList.add('hidden');">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @endif

                    @if ($categories->isEmpty())
                        <p>Chưa có danh mục DTI nào được tạo.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        {{-- Cột Thứ tự ở đầu tiên --}}
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Thứ tự
                                        </th>
                                        {{-- Cột ID có thể sắp xếp --}}
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('admin.dti-categories.index', ['sort' => 'id', 'direction' => ($sortField == 'id' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="flex items-center">
                                                ID
                                                @if ($sortField == 'id')
                                                    @if ($sortDirection == 'asc')
                                                        <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                                    @else
                                                        <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        {{-- Cột Tên Danh mục có thể sắp xếp --}}
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('admin.dti-categories.index', ['sort' => 'name', 'direction' => ($sortField == 'name' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="flex items-center">
                                                Tên Danh mục
                                                @if ($sortField == 'name')
                                                    @if ($sortDirection == 'asc')
                                                        <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                                    @else
                                                        <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        {{-- Thêm cột Danh mục cha --}}
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Danh mục cha
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Mô tả
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hành động
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="category-list">
                                    @foreach ($categories as $category)
                                        <tr data-id="{{ $category->id }}" class="cursor-move">
                                            {{-- Hiển thị thứ tự tăng dần trên mỗi trang --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $category->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $category->name }}
                                            </td>
                                            {{-- Hiển thị tên danh mục cha --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $category->parent ? $category->parent->name : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ Str::limit($category->description, 50) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('admin.dti-categories.show', $category) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Xem</a>
                                                <a href="{{ route('admin.dti-categories.edit', $category) }}" class="text-blue-600 hover:text-blue-900 mr-3">Sửa</a>
                                                <form action="{{ route('admin.dti-categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $categories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
            // Hàm mở tab tạo danh mục mới
            function openCreateCategoryTab() {
                // Mở cửa sổ mới với kích thước và các thuộc tính mong muốn
                window.open('{{ route('admin.dti-categories.create') }}', '_blank', 'width=800,height=600,resizable=yes,scrollbars=yes');
            }

            document.addEventListener('DOMContentLoaded', function() {
                var el = document.getElementById('category-list');
                if (el) { // Kiểm tra xem phần tử có tồn tại không trước khi khởi tạo Sortable
                    var sortable = new Sortable(el, {
                        animation: 150,
                        onEnd: function (evt) {
                            var itemEl = evt.item;
                            var order = sortable.toArray();

                            fetch('{{ route('admin.dti-categories.update-order') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ ids: order })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.message) {
                                    console.log(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi khi cập nhật thứ tự:', error);
                            });
                        }
                    });
                }

                // Lắng nghe thông báo từ cửa sổ con (tab thêm mới)
                window.addEventListener('message', function(event) {
                    // Đảm bảo tin nhắn đến từ cùng một origin để bảo mật
                    if (event.origin !== window.location.origin) {
                        return;
                    }

                    if (event.data && event.data.type === 'success_message' && event.data.message) {
                        const messageDiv = document.getElementById('dynamic-success-message');
                        const messageTextSpan = document.getElementById('dynamic-message-text');

                        messageTextSpan.textContent = event.data.message;
                        messageDiv.classList.remove('hidden'); // Hiển thị thông báo

                        // Tự động ẩn thông báo sau 5 giây và sau đó tải lại trang
                        setTimeout(() => {
                            messageDiv.classList.add('hidden'); // Ẩn thông báo
                            window.location.reload(); // Tải lại trang sau khi thông báo đã ẩn
                        }, 15000); // Hiển thị trong 15 giây (5000 milliseconds)
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>