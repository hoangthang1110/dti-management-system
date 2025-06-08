<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tạo Danh mục DTI mới') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ __('Thông tin Danh mục mới') }}
                    </h3>

                    <form action="{{ route('admin.dti-categories.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Tên Danh mục')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            @error('name')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Trường chọn Danh mục cha --}}
                        <div class="mb-4">
                            <x-input-label for="parent_id" :value="__('Danh mục cha (Tùy chọn)')" />
                            <select id="parent_id" name="parent_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Không có danh mục cha --</option>
                                @foreach ($parentCategories as $parentCategory)
                                    <option value="{{ $parentCategory['id'] }}" {{ old('parent_id') == $parentCategory['id'] ? 'selected' : '' }}>
                                        {{ $parentCategory['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Mô tả')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ms-3">
                                {{ __('Tạo Danh mục') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script để đóng tab và gửi thông báo cho tab cha sau khi lưu thành công --}}
    @if (session('status') === 'success')
        <script>
            // Đảm bảo cửa sổ được mở bởi một cửa sổ khác và cửa sổ cha không bị đóng
            if (window.opener && !window.opener.closed) {
                // Gửi thông báo thành công cho cửa sổ cha
                window.opener.postMessage({
                    type: 'success_message',
                    message: '{{ session('message') }}'
                }, window.location.origin);
                // Đóng cửa sổ hiện tại
                window.close();
            } else {
                // Nếu cửa sổ được mở trực tiếp (không phải từ cửa sổ cha),
                // hoặc cửa sổ cha đã bị đóng, chuyển hướng đến trang index trong cùng tab.
                window.location.href = '{{ route('admin.dti-categories.index') }}';
            }
        </script>
    @endif
</x-app-layout>