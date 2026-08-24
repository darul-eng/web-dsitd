<header x-data="{ scrolled: {{ ($forceLight ?? false) ? 'true' : 'false' }}, profileOpen: false, mobileMenuOpen: false, mobileProfileOpen: false }"
    @scroll.window="scrolled = {{ ($forceLight ?? false) ? 'true' : '(window.pageYOffset > 20)' }}"
    :class="scrolled ? 'glass h-16 border-white/40' : 'bg-transparent h-24 border-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out border-b">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
    <div class="flex items-center gap-10">
        <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-3 group">
            <img :src="scrolled ? '{{ asset('img/logo-dark.png') }}' : '{{ asset('img/logo.png') }}'"
                alt="Logo Lembaga Transformasi Digital & Kecerdasan Artifisial"
                class="h-9 md:h-11 transition-all duration-500 group-hover:scale-105"
                loading="lazy">
        </a>

        <nav class="hidden md:flex items-center gap-8">
            <a href="{{ route('services.index') }}" wire:navigate
                :class="scrolled ? '{{ request()->routeIs('services.*') ? 'text-red-600' : 'text-slate-500 hover:text-red-600' }}' : 'text-slate-300 hover:text-white'"
                class="text-[11px] font-bold transition-all uppercase tracking-widest">Layanan</a>

            <div class="relative" @click.outside="profileOpen = false">
                @php
                    $isProfileRoute = request()->routeIs('profile.*');
                @endphp
                <button @click="profileOpen = !profileOpen"
                    :class="scrolled ? '{{ $isProfileRoute ? 'text-red-600' : 'text-slate-500 hover:text-red-600' }}' : 'text-slate-300 hover:text-white'"
                    class="inline-flex items-center gap-1 text-[11px] font-bold transition-all uppercase tracking-widest">
                    Profil
                    <svg class="w-3 h-3 transition-transform" :class="profileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="profileOpen" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute top-8 left-0 min-w-[220px] rounded-2xl bg-white border border-slate-200 shadow-xl p-2 z-50">
                    <a href="{{ route('profile.vision-mission') }}" wire:navigate class="block px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-700 hover:bg-slate-100">Visi & Misi</a>
                    <a href="{{ route('profile.history') }}" wire:navigate class="block px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-700 hover:bg-slate-100">Sejarah</a>
                    <a href="{{ route('profile.organization') }}" class="block px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-700 hover:bg-slate-100">Tim Kami</a>
                </div>
            </div>

            <a href="{{ route('documents.index') }}" wire:navigate
                :class="scrolled ? '{{ request()->routeIs('documents.*') ? 'text-red-600' : 'text-slate-500 hover:text-red-600' }}' : 'text-slate-300 hover:text-white'"
                class="text-[11px] font-bold transition-all uppercase tracking-widest">Dokumen</a>

            <a href="{{ route('news.index') }}" wire:navigate
                :class="scrolled ? '{{ request()->routeIs('news.*') ? 'text-red-600' : 'text-slate-500 hover:text-red-600' }}' : 'text-slate-300 hover:text-white'"
                class="text-[11px] font-bold transition-all uppercase tracking-widest">Warta</a>

            <a href="{{ route('gallery.index') }}" wire:navigate
                :class="scrolled ? '{{ request()->routeIs('gallery.*') ? 'text-red-600' : 'text-slate-500 hover:text-red-600' }}' : 'text-slate-300 hover:text-white'"
                class="text-[11px] font-bold transition-all uppercase tracking-widest">Galeri</a>
        </nav>
    </div>

    <div class="flex items-center gap-4">
        <!-- Mobile Menu Toggle -->
        <button @click="mobileMenuOpen = !mobileMenuOpen"
            :class="scrolled ? 'text-slate-900' : 'text-white'"
            class="flex md:hidden p-2 rounded-xl transition-colors hover:bg-white/10">
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
            <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
    </div>

    </div>{{-- end container --}}

    <!-- Mobile Menu Overlay -->
    <div x-show="mobileMenuOpen" x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute top-16 sm:top-20 left-3 right-3 sm:left-6 sm:right-6 bg-white rounded-2xl sm:rounded-[2rem] shadow-2xl border border-slate-100 p-5 sm:p-8 md:hidden z-50">
        <nav class="flex flex-col gap-4 sm:gap-6">
            <a @click="mobileMenuOpen = false" href="{{ route('services.index') }}" wire:navigate class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Layanan</a>

            <div class="space-y-3">
                <button @click="mobileProfileOpen = !mobileProfileOpen"
                    class="flex items-center justify-between w-full text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">
                    Profil
                    <svg class="w-3 h-3 transition-transform" :class="mobileProfileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="mobileProfileOpen" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="grid grid-cols-1 gap-2 mt-2">
                    <a href="{{ route('profile.vision-mission') }}" wire:navigate class="px-4 py-2.5 bg-slate-50 rounded-xl text-[9px] font-black uppercase tracking-widest text-slate-600 hover:bg-red-50 hover:text-red-600 transition-all">Visi & Misi</a>
                    <a href="{{ route('profile.history') }}" wire:navigate class="px-4 py-2.5 bg-slate-50 rounded-xl text-[9px] font-black uppercase tracking-widest text-slate-600 hover:bg-red-50 hover:text-red-600 transition-all">Sejarah</a>
                    <a href="{{ route('profile.organization') }}" class="px-4 py-2.5 bg-slate-50 rounded-xl text-[9px] font-black uppercase tracking-widest text-slate-600 hover:bg-red-50 hover:text-red-600 transition-all">Tim Kami</a>
                </div>
            </div>

            <a @click="mobileMenuOpen = false" href="{{ route('documents.index') }}" wire:navigate class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Dokumen</a>
            <a @click="mobileMenuOpen = false" href="{{ route('news.index') }}" wire:navigate class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Warta</a>
            <a @click="mobileMenuOpen = false" href="{{ route('gallery.index') }}" wire:navigate class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Galeri</a>
        </nav>
    </div>
</header>
