<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- Navigation for Admin Roles --}}
                    @can('manage users')
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                            {{ __('Quản lý Người dùng') }}
                        </x-nav-link>
                    @endcan

                    @can('manage roles')
                        <x-nav-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')">
                            {{ __('Quản lý Vai trò') }}
                        </x-nav-link>
                    @endcan

                    @can('configure indicators')
                        <x-nav-link :href="route('admin.dti-categories.index')" :active="request()->routeIs('admin.dti-categories.index')">
                            {{ __('Quản lý Danh mục DTI') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.dti-indicators.index')" :active="request()->routeIs('admin.dti-indicators.index')">
                            {{ __('Quản lý Chỉ số DTI') }}
                        </x-nav-link>
                    @endcan

                    @can('enter dti data')
                        <x-nav-link :href="route('admin.dti-data-entries.index')" :active="request()->routeIs('admin.dti-data-entries.index')">
                            {{ __('Nhập liệu Dữ liệu DTI') }}
                        </x-nav-link>
                    @endcan

                    @can('view dti reports')
                        {{-- Thêm liên kết báo cáo ở đây sau khi bạn phát triển chức năng báo cáo --}}
                        {{-- <x-nav-link :href="route('admin.dti-reports.index')" :active="request()->routeIs('admin.dti-reports.index')">
                            {{ __('Xem Báo cáo DTI') }}
                        </x-nav-link> --}}
                    @endcan
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        {{-- Responsive Navigation for Admin Roles --}}
        @can('manage users')
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                    {{ __('Quản lý Người dùng') }}
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('manage roles')
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')">
                    {{ __('Quản lý Vai trò') }}
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('configure indicators')
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.dti-categories.index')" :active="request()->routeIs('admin.dti-categories.index')">
                    {{ __('Quản lý Danh mục DTI') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.dti-indicators.index')" :active="request()->routeIs('admin.dti-indicators.index')">
                    {{ __('Quản lý Chỉ số DTI') }}
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('enter dti data')
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.dti-data-entries.index')" :active="request()->routeIs('admin.dti-data-entries.index')">
                    {{ __('Nhập liệu Dữ liệu DTI') }}
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('view dti reports')
            {{-- Thêm liên kết báo cáo ở đây sau --}}
            {{-- <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.dti-reports.index')" :active="request()->routeIs('admin.dti-reports.index')">
                    {{ __('Xem Báo cáo DTI') }}
                </x-responsive-nav-link>
            </div> --}}
        @endcan

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>