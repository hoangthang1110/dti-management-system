<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý Người dùng') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Đây là trang quản lý người dùng.</h3>
                    @if($users->count() > 0)
                        <p>Số lượng người dùng: {{ $users->total() }}</p>
                        <ul>
                            @foreach($users as $user)
                                <li>{{ $user->name }} ({{ $user->email }})</li>
                            @endforeach
                        </ul>
                    @else
                        <p>Không có người dùng nào.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>