<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chi tiết Danh mục DTI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <x-input-label :value="__('Tên Danh mục')" />
                        <p class="text-gray-700 text-lg">{{ $dtiCategory->name }}</p>
                    </div>

                    <div class="mb-4">
                        <x-input-label :value="__('Mô tả')" />
                        <p class="text-gray-700">{{ $dtiCategory->description ?? 'Không có mô tả' }}</p>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.dti-categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            {{ __('Quay lại Danh sách') }}
                        </a>
                        <a href="{{ route('admin.dti-categories.edit', $dtiCategory) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Sửa Danh mục') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>