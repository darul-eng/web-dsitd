<div class="flex flex-col h-full overflow-hidden">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between h-20 border-b border-slate-100 px-6 shrink-0 transition-all duration-300" :class="!sidebarOpen && !isMobile && 'justify-center px-0'">
        <div class="flex items-center justify-center">
            <img src="{{ asset('img/logo-dark.png') }}" alt="Logo"
                class="transition-all duration-300 object-contain"
                :class="sidebarOpen || isMobile ? 'h-10 w-auto' : 'h-6 w-12'">
        </div>
        
        <!-- Close button (Mobile only) -->
        <button @click="mobileOpen = false" class="lg:hidden p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-50 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Sidebar Content -->
    <nav class="flex-1 py-6 space-y-1 overflow-y-auto custom-scrollbar" :class="sidebarOpen || isMobile ? 'px-4' : 'px-2'">
        <div x-show="sidebarOpen || isMobile" class="px-4 text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Main Menu</div>
        <div x-show="!sidebarOpen && !isMobile" class="w-full flex justify-center mb-2">
            <div class="w-4 h-px bg-slate-200"></div>
        </div>

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center text-sm font-medium transition-colors rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            :class="sidebarOpen || isMobile ? 'px-4 py-3' : 'justify-center py-3 px-0'"
            title="Dashboard">
            <svg class="w-6 h-6 shrink-0" :class="sidebarOpen || isMobile ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span x-show="sidebarOpen || isMobile" class="whitespace-nowrap">Dashboard</span>
        </a>

        <div x-show="sidebarOpen || isMobile" class="px-4 text-[11px] font-semibold text-slate-400 uppercase tracking-wider mt-8 mb-2">CMS Content</div>
        <div x-show="!sidebarOpen && !isMobile" class="w-full flex justify-center mt-6 mb-2">
            <div class="w-4 h-px bg-slate-200"></div>
        </div>

        <a href="{{ route('admin.news.index') }}"
            class="flex items-center text-sm font-semibold transition-colors rounded-xl {{ request()->routeIs('admin.news.*') ? 'bg-rose-50 text-red-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            :class="sidebarOpen || isMobile ? 'px-4 py-3' : 'justify-center py-3 px-0'"
            title="Berita & Info">
            <svg class="w-6 h-6 shrink-0" :class="sidebarOpen || isMobile ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            <span x-show="sidebarOpen || isMobile" class="whitespace-nowrap tracking-tight">Berita & Info</span>
        </a>

        <a href="{{ route('admin.services.index') }}"
            class="flex items-center text-sm font-semibold transition-colors rounded-xl {{ request()->routeIs('admin.services.*') ? 'bg-rose-50 text-red-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            :class="sidebarOpen || isMobile ? 'px-4 py-3' : 'justify-center py-3 px-0'"
            title="Layanan">
            <svg class="w-6 h-6 shrink-0" :class="sidebarOpen || isMobile ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg>
            <span x-show="sidebarOpen || isMobile" class="whitespace-nowrap tracking-tight">Layanan & Fasilitas</span>
        </a>

        <a href="{{ route('admin.documents.index') }}"
            class="flex items-center text-sm font-semibold transition-colors rounded-xl {{ request()->routeIs('admin.documents.*') ? 'bg-rose-50 text-red-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            :class="sidebarOpen || isMobile ? 'px-4 py-3' : 'justify-center py-3 px-0'"
            title="Dokumen">
            <svg class="w-6 h-6 shrink-0" :class="sidebarOpen || isMobile ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span x-show="sidebarOpen || isMobile" class="whitespace-nowrap tracking-tight">E-Dokumen</span>
        </a>

        <a href="{{ route('admin.galleries.index') }}"
            class="flex items-center text-sm font-semibold transition-colors rounded-xl {{ request()->routeIs('admin.galleries.*') ? 'bg-rose-50 text-red-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            :class="sidebarOpen || isMobile ? 'px-4 py-3' : 'justify-center py-3 px-0'"
            title="Galeri">
            <svg class="w-6 h-6 shrink-0" :class="sidebarOpen || isMobile ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span x-show="sidebarOpen || isMobile" class="whitespace-nowrap tracking-tight">Galeri Foto</span>
        </a>

        <a href="{{ route('admin.faqs.index') }}"
            class="flex items-center text-sm font-semibold transition-colors rounded-xl {{ request()->routeIs('admin.faqs.*') ? 'bg-rose-50 text-red-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            :class="sidebarOpen || isMobile ? 'px-4 py-3' : 'justify-center py-3 px-0'"
            title="FAQ">
            <svg class="w-6 h-6 shrink-0" :class="sidebarOpen || isMobile ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-show="sidebarOpen || isMobile" class="whitespace-nowrap tracking-tight">Tanya Jawab (FAQ)</span>
        </a>

        <a href="{{ route('admin.members.index') }}"
            class="flex items-center text-sm font-semibold transition-colors rounded-xl {{ request()->routeIs('admin.members.*') ? 'bg-rose-50 text-red-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            :class="sidebarOpen || isMobile ? 'px-4 py-3' : 'justify-center py-3 px-0'"
            title="Personnel">
            <svg class="w-6 h-6 shrink-0" :class="sidebarOpen || isMobile ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span x-show="sidebarOpen || isMobile" class="whitespace-nowrap tracking-tight">Struktur SDM</span>
        </a>

        <a href="{{ route('admin.pages.index') }}"
            class="flex items-center text-sm font-semibold transition-colors rounded-xl {{ request()->routeIs('admin.pages.*') ? 'bg-rose-50 text-red-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            :class="sidebarOpen || isMobile ? 'px-4 py-3' : 'justify-center py-3 px-0'"
            title="Halaman">
            <svg class="w-6 h-6 shrink-0" :class="sidebarOpen || isMobile ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span x-show="sidebarOpen || isMobile" class="whitespace-nowrap tracking-tight">Halaman Profil</span>
        </a>

        <a href="{{ route('admin.jumbotrons.index') }}"
            class="flex items-center text-sm font-semibold transition-colors rounded-xl {{ request()->routeIs('admin.jumbotrons.*') ? 'bg-rose-50 text-red-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            :class="sidebarOpen || isMobile ? 'px-4 py-3' : 'justify-center py-3 px-0'"
            title="Banner Utama">
            <svg class="w-6 h-6 shrink-0" :class="sidebarOpen || isMobile ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span x-show="sidebarOpen || isMobile" class="whitespace-nowrap tracking-tight">Banner Utama</span>
        </a>

        <a href="{{ route('admin.links.index') }}"
            class="flex items-center text-sm font-semibold transition-colors rounded-xl {{ request()->routeIs('admin.links.*') ? 'bg-rose-50 text-red-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            :class="sidebarOpen || isMobile ? 'px-4 py-3' : 'justify-center py-3 px-0'"
            title="Tautan Terkait">
            <svg class="w-6 h-6 shrink-0" :class="sidebarOpen || isMobile ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
            </svg>
            <span x-show="sidebarOpen || isMobile" class="whitespace-nowrap tracking-tight">Tautan Terkait</span>
        </a>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-slate-100">
        <div class="bg-slate-50 rounded-2xl transition-all overflow-hidden" :class="sidebarOpen || isMobile ? 'p-4' : 'p-2'">
            <div class="flex items-center" :class="!sidebarOpen && !isMobile && 'justify-center'">
                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold shrink-0">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="ml-3 truncate" x-show="sidebarOpen || isMobile">
                    <p class="text-sm font-semibold text-slate-800 truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-[11px] text-slate-500 truncate">{{ auth()->user()->email ?? 'admin@unhas.ac.id' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}" x-show="sidebarOpen || isMobile">
                @csrf
                <button type="submit" class="mt-4 w-full flex items-center justify-center px-4 py-2 text-xs font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors">
                    Logout
                </button>
            </form>
            <!-- Simple logout button for mini sidebar -->
            <form method="POST" action="{{ route('admin.logout') }}" x-show="!sidebarOpen && !isMobile" class="mt-2 text-center">
                @csrf
                <button type="submit" class="inline-flex items-center justify-center p-2 text-slate-400 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
