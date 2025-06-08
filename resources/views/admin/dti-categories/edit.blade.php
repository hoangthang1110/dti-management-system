<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chỉnh sửa Danh mục DTI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ __('Thông tin Danh mục') }}
                    </h3>

                    <form action="{{ route('admin.dti-categories.update', $dtiCategory) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Sử dụng phương thức PUT cho cập nhật --}}

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Tên Danh mục')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $dtiCategory->name)" required autofocus />
                            @error('name')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Thêm trường chọn Danh mục cha --}}
                        <div class="mb-4">
                            <x-input-label for="parent_id" :value="__('Danh mục cha (Tùy chọn)')" />
                            <select id="parent_id" name="parent_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Không có danh mục cha --</option>
                                @foreach ($parentCategories as $parentCategory)
                                    <option value="{{ $parentCategory['id'] }}"
                                        {{ old('parent_id', $dtiCategory->parent_id) == $parentCategory['id'] ? 'selected' : '' }}>
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
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $dtiCategory->description) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.dti-categories.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Hủy') }}
                            </a>

                            <x-primary-button class="ms-3">
                                {{ __('Cập nhật Danh mục') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>