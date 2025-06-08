<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Thay đổi tên Laravel thành nội dung mong muốn --}}
        <title>{{ config('app.name', 'Hệ thống Quản lý DTI') }}</title>

        {{-- Favicon --}}
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        {{-- Hoặc nếu bạn dùng .png: <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png"> --}}

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('scripts') {{-- Dòng này RẤT QUAN TRỌNG và phải ở đây --}}
    </body>
</html>