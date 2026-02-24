<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') | {{ config('app.name', 'DSITD UNHAS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
 
     <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js" referrerpolicy="origin"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     @livewireStyles
 
     <style>
         body {
             font-family: 'Inter', 'Plus Jakarta Sans', sans-serif;
         }

        [x-cloak] {
            display: none !important;
        }

        /* Force SweetAlert2 Button Styles */
        .swal2-styled.swal2-confirm {
            background-color: #e11d48 !important;
            color: #fff !important;
            box-shadow: 0 4px 6px -1px rgba(225, 29, 72, 0.2) !important;
        }

        .swal2-styled.swal2-cancel {
            background-color: #94a3b8 !important;
            color: #fff !important;
        }
    </style>
</head>

<body class="h-full antialiased text-slate-900 overflow-hidden" 
    x-data="{ 
        sidebarOpen: true, 
        mobileOpen: false,
        isMobile: window.innerWidth < 1024,
        init() {
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 1024;
                if (!this.isMobile) this.mobileOpen = false;
            });
        }
    }">

    <div class="flex h-screen bg-slate-50">
        <!-- Sidebar (Desktop Mode) -->
        <aside x-show="!isMobile"
            :class="{
                'w-72': sidebarOpen,
                'w-20': !sidebarOpen
            }"
            class="relative h-full bg-white border-r border-slate-200 shrink-0 transition-all duration-300 ease-in-out hidden lg:block">
            @include('layouts.sidebar-content')
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-slate-50">
            <!-- Topbar (Header) -->
            <header class="flex items-center justify-between h-20 bg-white border-b border-slate-200 px-6 shrink-0 z-20">
                <div class="flex items-center space-x-4">
                    <!-- Toggle Sidebar Button (Common) -->
                    <button @click.stop="isMobile ? mobileOpen = !mobileOpen : sidebarOpen = !sidebarOpen"
                        class="flex items-center justify-center p-2.5 bg-white border border-slate-200 text-slate-600 hover:text-primary-600 hover:border-primary-100 hover:bg-primary-50 rounded-xl transition-all shadow-sm group">
                        <svg class="w-6 h-6 transition-transform duration-300" :class="!sidebarOpen && !isMobile ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="(!isMobile && sidebarOpen) || (isMobile && !mobileOpen)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="(!isMobile && !sidebarOpen) || (isMobile && mobileOpen)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <h1 class="text-xl font-bold text-slate-800 ml-2">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center space-x-3">
                    <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-full transition-colors relative">
                        <span class="absolute top-2 right-2 w-2 h-2 bg-primary-500 rounded-full border-2 border-white"></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <div class="w-px h-6 bg-slate-200 mx-2"></div>
                    <div class="flex items-center space-x-3 relative" x-data="{ userMenuOpen: false }">
                        <div @click="userMenuOpen = !userMenuOpen" 
                            class="flex items-center space-x-3 cursor-pointer hover:bg-slate-50 p-1.5 rounded-xl transition-colors">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 hidden sm:inline-block leading-none">{{ auth()->user()->name ?? 'Admin' }}</span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="userMenuOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        <!-- User Dropdown Menu -->
                        <div x-show="userMenuOpen" 
                            @click.away="userMenuOpen = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 top-full mt-2 w-48 bg-white border border-slate-200 rounded-2xl shadow-xl shadow-slate-200/50 py-2 z-50"
                            x-cloak>
                            <div class="px-4 py-2 border-b border-slate-50 mb-1">
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Akun Saya</p>
                                <p class="text-xs font-semibold text-slate-700 truncate pt-1">{{ auth()->user()->email }}</p>
                            </div>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center px-4 py-2 text-sm font-semibold text-rose-600 hover:bg-rose-50 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout Sesi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50/50 p-4 lg:p-8 custom-scrollbar relative">
                <div class="w-full">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Elements (Placed at the end for ultimate stacking priority) -->
    <div x-show="mobileOpen"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileOpen = false"
        class="fixed inset-0 bg-slate-900/50 lg:hidden"
        style="z-index: 9998 !important;"
        x-cloak></div>

    <aside x-show="isMobile"
        :class="mobileOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 w-72 bg-white border-r border-slate-200 transition-transform duration-300 ease-in-out lg:hidden"
        style="z-index: 9999 !important;"
        @click.away="mobileOpen = false"
        x-cloak>
        @include('layouts.sidebar-content')
    </aside>

    @livewireScripts

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(session()->has('message'))
        Toast.fire({
            icon: 'success',
            title: "{{ session('message') }}"
        });
        @endif

        @if(session()->has('error'))
        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}"
        });
        @endif

        window.addEventListener('swal:success', event => {
            Toast.fire({
                icon: 'success',
                title: event.detail.message
            });
        });

        window.addEventListener('swal:error', event => {
            Toast.fire({
                icon: 'error',
                title: event.detail.message
            });
        });
    </script>
</body>

</html>