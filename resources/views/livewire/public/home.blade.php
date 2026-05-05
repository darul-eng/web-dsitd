<div x-data="{ scrolled: false, profileOpen: false, mobileMenuOpen: false, mobileProfileOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
    <!-- Navigation Overlay -->
    <header :class="scrolled ? 'glass h-16' : 'bg-transparent h-24'"
            class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out px-6 md:px-12 flex items-center justify-between">
        <div class="flex items-center gap-12">
            <a href="/" wire:navigate class="flex items-center gap-3 group">
                <!-- Smart Logo Switching -->
                <img :src="scrolled ? '{{ asset('img/logo-dark.png') }}' : '{{ asset('img/logo.png') }}'"
                    alt="Logo DSITD UNHAS"
                    class="h-8 md:h-10 transition-all duration-500 group-hover:scale-105"
                    loading="lazy">

                <div class="flex flex-col">
                    <span :class="scrolled ? 'text-slate-900' : 'text-white'"
                        class="text-sm font-black tracking-tighter leading-none transition-colors duration-500">DSITD</span>
                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest leading-none mt-0.5">UNHAS</span>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('services.index') }}" wire:navigate :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Layanan</a>
                <div class="relative" @click.outside="profileOpen = false">
                    <button @click="profileOpen = !profileOpen"
                        :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'"
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
                <a href="{{ route('documents.index') }}" wire:navigate :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Dokumen</a>
                <a href="{{ route('news.index') }}" wire:navigate :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Warta</a>
                <a href="{{ route('gallery.index') }}" wire:navigate :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Galeri</a>
                <a href="#kontak" :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Kontak</a>
            </nav>
        </div>

        <div class="flex items-center gap-4">
            <div :class="scrolled ? 'bg-slate-100/50 border-slate-200/50' : 'bg-white/5 border-white/10'" 
                class="hidden lg:flex items-center gap-2 px-3 py-1.5 border rounded-full backdrop-blur-md transition-colors duration-500">
                <div class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75"
                        :class="scrolled ? '{{ ($systemOperational ?? true) ? 'bg-emerald-500' : 'bg-rose-500' }}' : '{{ ($systemOperational ?? true) ? 'bg-emerald-400' : 'bg-rose-400' }}'"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2"
                        :class="scrolled ? '{{ ($systemOperational ?? true) ? 'bg-emerald-600' : 'bg-rose-600' }}' : '{{ ($systemOperational ?? true) ? 'bg-emerald-500' : 'bg-rose-500' }}'"></span>
                </div>
                <span class="text-[9px] font-black uppercase tracking-tighter transition-colors duration-500"
                    :class="scrolled ? '{{ ($systemOperational ?? true) ? 'text-emerald-600' : 'text-rose-600' }}' : '{{ ($systemOperational ?? true) ? 'text-emerald-400' : 'text-rose-400' }}'">
                    {{ ($systemOperational ?? true) ? 'System Operational' : 'Under Maintenance' }}
                </span>
            </div>
            <a href="https://helpdesk.unhas.ac.id/" target="_blank" class="hidden sm:inline-flex px-5 py-2 bg-red-600 border border-red-500 text-white text-[10px] font-black rounded-lg hover:bg-red-700 transition-all uppercase tracking-widest shadow-xl shadow-red-600/20">Tanya IT Helpdesk</a>
            
            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" 
                :class="scrolled ? 'text-slate-900' : 'text-white'"
                class="flex md:hidden p-2 rounded-xl transition-colors hover:bg-white/10">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenuOpen" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute top-20 left-6 right-6 bg-white rounded-[2rem] shadow-2xl border border-slate-100 p-8 md:hidden z-50">
            <nav class="flex flex-col gap-6">
                <a @click="mobileMenuOpen = false" href="{{ route('services.index') }}" wire:navigate class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Layanan</a>
                
                <div class="space-y-3">
                    <button @click="mobileProfileOpen = !mobileProfileOpen" 
                        class="flex items-center justify-between w-full text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">
                        Profile
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
                <a @click="mobileMenuOpen = false" href="#kontak" class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Kontak</a>
                
                <a href="https://helpdesk.unhas.ac.id/" target="_blank" class="w-full py-4 bg-red-600 text-white text-center text-xs font-black rounded-xl uppercase tracking-widest shadow-xl shadow-red-600/20 mt-4">Tanya IT Helpdesk</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex flex-col items-center justify-center pt-24 overflow-hidden mesh-gradient">
        <!-- Background SVG Pattern -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="black" stroke-width="1"/></pattern></defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="container mx-auto px-6 text-center z-10">
            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-gradient-to-r from-red-500/20 to-rose-500/20 text-red-500 border border-red-500/30 mb-10 backdrop-blur-xl">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-600"></span>
                </span>
                <span class="text-[11px] font-black uppercase tracking-[0.2em] text-white">Modern Digital Infrastructure 2.0</span>
            </div>

            <h1 class="text-4xl sm:text-6xl md:text-8xl lg:text-9xl font-black text-white tracking-tighter leading-[0.9] mb-10">
                Transformasi Digital<br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-rose-400 to-orange-400 filter drop-shadow-[0_0_15px_rgba(239,68,68,0.3)]">Tanpa Batas.</span>
            </h1>

            <p class="max-w-2xl mx-auto text-base md:text-xl text-slate-300/80 font-medium leading-relaxed mb-14">
                Pusat Teknologi Informasi dan Komunikasi yang mengelola infrastruktur jaringan, pengembangan aplikasi, dan transformasi data untuk ekosistem pendidikan masa depan.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
                <a href="{{ route('services.index') }}" wire:navigate class="group relative px-12 py-5 bg-red-600 text-white text-xs font-black rounded-2xl hover:bg-red-700 transition-all shadow-[0_20px_50px_rgba(239,68,68,0.4)] uppercase tracking-widest overflow-hidden">
                    <span class="relative z-10">Eksplorasi Layanan</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </a>
                <a href="{{ route('profile.vision-mission') }}" wire:navigate class="px-12 py-5 bg-white/5 text-white text-xs font-black rounded-2xl hover:bg-white/10 transition-all border border-white/10 backdrop-blur-md uppercase tracking-widest">Dokumentasi Profil</a>
            </div>
        </div>

        <!-- Stats Section: Floating Cards -->
        <div class="mt-20 w-full max-w-6xl px-6 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <!-- Stat Card 1 -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-red-500 to-orange-500 rounded-[2rem] opacity-20 group-hover:opacity-100 transition duration-500 blur"></div>
                    <div class="relative flex items-center gap-6 bg-slate-900/40 backdrop-blur-3xl border border-white/10 p-8 rounded-[2rem] hover:bg-slate-900/60 transition-all duration-500">
                        <div class="flex-shrink-0 w-14 h-14 bg-red-500/10 rounded-2xl flex items-center justify-center text-red-500 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-4xl font-black text-white tracking-tighter leading-none mb-1">{{ $uptimeRate }}%</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Uptime Jaringan</span>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-[2rem] opacity-20 group-hover:opacity-100 transition duration-500 blur"></div>
                    <div class="relative flex items-center gap-6 bg-slate-900/40 backdrop-blur-3xl border border-white/10 p-8 rounded-[2rem] hover:bg-slate-900/60 transition-all duration-500">
                        <div class="flex-shrink-0 w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-500 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-4xl font-black text-white tracking-tighter leading-none mb-1">120+</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Aplikasi Terintegrasi</span>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-[2rem] opacity-20 group-hover:opacity-100 transition duration-500 blur"></div>
                    <div class="relative flex items-center gap-6 bg-slate-900/40 backdrop-blur-3xl border border-white/10 p-8 rounded-[2rem] hover:bg-slate-900/60 transition-all duration-500">
                        <div class="flex-shrink-0 w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-4xl font-black text-white tracking-tighter leading-none mb-1">45K+</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Pengguna Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- 
    <!-- Services Grid -->
    <section id="layanan" class="py-32 bg-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-end justify-between mb-20 gap-6">
                <div class="max-w-xl">
                    <h2 class="text-xs font-black text-red-600 uppercase tracking-widest mb-4">Core Infrastructure</h2>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Layanan Unggulan Untuk Aktivitas Digital.</h1>
                </div>
                <p class="max-w-md text-sm text-slate-500 font-medium leading-relaxed">
                    Halaman ini menampilkan layanan prioritas agar Anda cepat menemukan yang paling dibutuhkan. Jelajahi katalog untuk melihat seluruh layanan aktif.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-slate-50 border border-slate-100">
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest">{{ $totalServices }} layanan aktif</span>
                    @if($hasMoreServices)
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">8 ditampilkan di beranda</span>
                    @endif
                </div>

                <a href="{{ route('services.index') }}" wire:navigate class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-900 text-white text-[10px] font-black rounded-xl hover:bg-slate-800 transition-all uppercase tracking-widest">
                    Lihat Semua Layanan
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                @foreach($services as $index => $service)
                <div class="{{ in_array($index, [3, 4]) ? 'md:col-span-6' : 'md:col-span-4' }} group">
                    <div class="h-full glass p-8 rounded-[2rem] hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500 border border-slate-100 relative overflow-hidden">
                        <h3 class="text-xl font-black text-slate-900 tracking-tight mb-4">{{ $service->title }}</h3>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed mb-8">
                            {{ Str::limit(strip_tags($service->content), 120) }}
                        </p>
                        <a href="{{ route('services.show', $service->slug ?? '#') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-red-600 uppercase tracking-widest group/link">
                            Pelajari Selengkapnya
                            <svg class="w-3 h-3 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            @if($hasMoreServices)
                <div class="mt-10 text-center">
                    <a href="{{ route('services.index') }}" wire:navigate class="inline-flex items-center gap-2 text-[11px] font-black text-red-600 uppercase tracking-widest hover:text-red-700 transition-colors">
                        Telusuri {{ $totalServices - $services->count() }} layanan lainnya
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                    </a>
                </div>
            @endif
        </div>
    </section>
    --}}

    {{-- 
    <!-- News & Blog -->
    <section id="berita" class="py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-6">
                <div class="max-w-xl">
                    <h2 class="text-xs font-black text-red-600 uppercase tracking-widest mb-4">Update & Inovasi</h2>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Warta Transformasi Digital.</h1>
                </div>
                <a href="{{ route('news.index') }}" wire:navigate class="inline-flex items-center gap-2 text-[10px] font-black text-red-600 uppercase tracking-widest hover:gap-3 transition-all">
                    Lihat Seluruh Warta
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestNews as $news)
                    <article class="group flex flex-col">
                        <div class="relative aspect-[16/10] rounded-[2rem] overflow-hidden mb-6">
                            <img src="{{ asset('storage/' . $news->cover_image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-[8px] font-black text-slate-500 uppercase tracking-widest">{{ $news->category->name ?? 'Update' }}</span>
                            <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">{{ $news->published_at?->format('d M Y') }}</span>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 tracking-tight leading-snug group-hover:text-red-600 transition-colors">
                            <a href="{{ route('news.show', $news->slug) }}" wire:navigate>{{ $news->title }}</a>
                        </h3>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <livewire:public.gallery-showcase />

    <!-- Public Documents Section -->
    <section id="dokumen" class="py-32 bg-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                <div class="lg:col-span-5">
                    <h2 class="text-xs font-black text-red-600 uppercase tracking-widest mb-4">Resource Center</h2>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter mb-8">Akses Dokumen & Panduan Publik.</h1>
                    <p class="text-sm text-slate-500 leading-relaxed mb-10">Unduh berbagai dokumen resmi, regulasi TIK, dan panduan penggunaan layanan digital Universitas Hasanuddin dalam satu pintu.</p>
                    <a href="{{ route('documents.index') }}" wire:navigate class="inline-flex items-center gap-2 px-8 py-4 bg-slate-900 text-white text-[10px] font-black rounded-xl hover:bg-red-600 transition-all uppercase tracking-widest">
                        Buka Pusat Dokumen
                    </a>
                </div>
                <div class="lg:col-span-7">
                    <div class="space-y-4">
                        @foreach($featuredDocuments as $doc)
                            <div class="group bg-white border border-slate-100 p-6 rounded-[1.5rem] hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500 flex items-center justify-between">
                                <div class="flex items-center gap-5">
                                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-slate-800 tracking-tight">{{ $doc->title }}</h4>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ strtoupper($doc->file_type) }} • {{ number_format($doc->file_size / 1024 / 1024, 2) }} MB</span>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    --}}

    <!-- Visual Trust / Stats -->
    <section class="py-32 bg-slate-50 border-y border-slate-100 relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-2xl h-full max-h-2xl bg-red-600/5 filter blur-[120px] rounded-full pointer-events-none"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-xs font-black text-red-600 uppercase tracking-widest mb-4 flex items-center gap-3">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-red-600"></span>
                        </span>
                        Digital Transparency
                    </h2>
                    <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter leading-snug mb-8">Keandalan Infrastruktur adalah Prioritas Kami.</h1>
                    <div class="space-y-8">
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center shrink-0 shadow-sm border border-emerald-100">
                                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                            </div>
                            <div class="pt-1">
                                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight flex items-center gap-2">
                                    24/7 Monitoring Center
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                </h4>
                                <p class="text-xs text-slate-500 font-medium mt-2 leading-relaxed">Sistem kami dipantau secara real-time untuk menjamin ketersediaan layanan tanpa interupsi di seluruh ekosistem universitas.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center shrink-0 shadow-sm border border-blue-100">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09m8.19.893c2.827-2.73 4.69-6.439 4.69-10.538V12m-6.57 9.503A12.062 12.062 0 0112 21M9 11l3 3L22 4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            </div>
                            <div class="pt-1">
                                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight flex items-center gap-2">
                                    Cyber Security First
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                </h4>
                                <p class="text-xs text-slate-500 font-medium mt-2 leading-relaxed">Perlindungan data sensitif universitas dengan standar keamanan tingkat tinggi dan protokol enkripsi termutakhir.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats with Counter -->
                    <div x-data="{ count1: 0, count2: 0 }" 
                         x-init="
                            let observer = new IntersectionObserver((entries) => {
                                if(entries[0].isIntersecting) {
                                    let c1 = 0; let c2 = 0;
                                    let i1 = setInterval(() => { c1++; count1 = c1; if(c1>=10) clearInterval(i1); }, 100);
                                    let i2 = setInterval(() => { c2+=3.33; if(c2>=99.9) { c2=99.9; clearInterval(i2); } count2 = c2.toFixed(1); }, 30);
                                    observer.disconnect();
                                }
                            }, { threshold: 0.5 });
                            observer.observe($el);
                         "
                         class="mt-12 grid grid-cols-2 gap-6 w-full max-w-[480px]">
                        <!-- Stat 1 -->
                        <div class="p-6 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 flex flex-col items-center text-center relative group hover:-translate-y-1 transition-all duration-300">
                            <span class="relative block text-4xl md:text-5xl font-black text-slate-900 tracking-tighter mb-2"><span x-text="count1">0</span><span class="text-red-600 text-2xl md:text-3xl ml-1">Gbps</span></span>
                            <span class="relative text-[9px] md:text-[10px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                <span class="relative flex h-1.5 w-1.5">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-red-600"></span>
                                </span>
                                Backbone Speed
                            </span>
                        </div>
                        <!-- Stat 2 -->
                        <div class="p-6 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 flex flex-col items-center text-center relative group hover:-translate-y-1 transition-all duration-300">
                            <span class="relative block text-4xl md:text-5xl font-black text-slate-900 tracking-tighter mb-2"><span x-text="count2">0.0</span><span class="text-red-600 text-2xl md:text-3xl ml-1">%</span></span>
                            <span class="relative text-[9px] md:text-[10px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                <span class="relative flex h-1.5 w-1.5">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-red-600"></span>
                                </span>
                                SLA Guarantee
                            </span>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left" class="relative">
                    <!-- Soft Glow behind the globe -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-gradient-to-tr from-red-600/10 via-transparent to-blue-600/10 filter blur-[80px] rounded-full pointer-events-none"></div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <!-- 3D Network Globe Animation with floating effect -->
                        <div class="animate-bounce-slow w-full max-w-[420px] aspect-square relative" wire:ignore>
                            <div id="network-globe-container" class="w-full h-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section class="py-24 bg-slate-50 px-6 border-t border-slate-100">
        <div class="container mx-auto">
            <div data-aos="zoom-in" class="bg-slate-900 rounded-[3rem] p-12 md:p-24 text-center relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_50%_120%,rgba(225,29,72,0.15),transparent_50%)]"></div>
                <div class="relative z-10 max-w-3xl mx-auto">
                    <h1 class="text-4xl md:text-6xl font-black text-white tracking-tighter leading-none mb-8">Siap Memulai Transformasi?</h1>
                    <p class="text-slate-400 font-medium md:text-lg mb-12">Konsultasikan kebutuhan infrastruktur dan pengembangan platform digital unit kerja Anda bersama tim ahli kami.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                        <a href="mailto:it@unhas.ac.id" class="px-10 py-5 bg-red-600 text-white text-xs font-black rounded-xl hover:bg-red-700 transition-all shadow-2xl shadow-red-600/40 uppercase tracking-widest">Hubungi Kami</a>
                        <a href="{{ route('services.index') }}" wire:navigate class="text-white text-xs font-black uppercase tracking-widest border-b-2 border-white/20 hover:border-white transition-all pb-1">Lihat Dokumentasi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script data-navigate-once>
        function initGlobeNetwork() {
            const container = document.getElementById('network-globe-container');
            if (!container || container.dataset.initialized) return;
            container.dataset.initialized = 'true';

            const loadScript = (src) => new Promise(resolve => {
                const script = document.createElement('script');
                script.src = src;
                script.onload = resolve;
                document.head.appendChild(script);
            });

            const startScene = () => {
                const scene = new THREE.Scene();

                const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
                camera.position.set(0, 8, 28);

                const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
                renderer.setSize(container.clientWidth, container.clientHeight);
                renderer.setPixelRatio(window.devicePixelRatio);
                container.appendChild(renderer.domElement);

                const controls = new THREE.OrbitControls(camera, renderer.domElement);
                controls.enableDamping = true;
                controls.dampingFactor = 0.05;
                controls.minDistance = 20;
                controls.maxDistance = 100;
                controls.enablePan = false;

                const R = 10;
                const textureLoader = new THREE.TextureLoader();
                const earthTexture = textureLoader.load('https://unpkg.com/three-globe/example/img/earth-blue-marble.jpg');

                const globeGeometry = new THREE.SphereGeometry(R, 64, 64);
                const globeMaterial = new THREE.MeshPhongMaterial({
                    map: earthTexture,
                    color: 0xffffff,
                    emissive: 0x111111,
                    specular: 0x222222,
                    shininess: 15
                });
                const globe = new THREE.Mesh(globeGeometry, globeMaterial);
                globe.rotation.y = 1.8;
                scene.add(globe);

                const wireframeGeometry = new THREE.SphereGeometry(R + 0.1, 32, 32);
                const wireframeMaterial = new THREE.MeshBasicMaterial({
                    color: 0x004466,
                    wireframe: true,
                    transparent: true,
                    opacity: 0.3
                });
                const wireframe = new THREE.Mesh(wireframeGeometry, wireframeMaterial);
                globe.add(wireframe);

                const nodes = [];
                function latLongToVector3(lat, lon, radius) {
                    const phi = (90 - lat) * (Math.PI / 180);
                    const theta = (lon + 180) * (Math.PI / 180);
                    const x = -(radius * Math.sin(phi) * Math.cos(theta));
                    const z = (radius * Math.sin(phi) * Math.sin(theta));
                    const y = (radius * Math.cos(phi));
                    return new THREE.Vector3(x, y, z);
                }

                function getRandomSpherePoint(radius) {
                    const u = Math.random();
                    const v = Math.random();
                    const theta = u * 2.0 * Math.PI;
                    const phi = Math.acos(2.0 * v - 1.0);
                    const x = radius * Math.sin(phi) * Math.cos(theta);
                    const y = radius * Math.sin(phi) * Math.sin(theta);
                    const z = radius * Math.cos(phi);
                    return new THREE.Vector3(x, y, z);
                }

                const indoCities = [
                    { lat: -6.2088, lon: 106.8456 },
                    { lat: -7.2504, lon: 112.7688 },
                    { lat: -5.1476, lon: 119.4327 },
                    { lat: 3.5952, lon: 98.6722 },
                    { lat: -8.6500, lon: 115.2167 },
                    { lat: -1.2653, lon: 116.8312 },
                    { lat: -2.5337, lon: 140.7181 }
                ];

                indoCities.forEach(city => {
                    nodes.push(latLongToVector3(city.lat, city.lon, R + 0.15));
                });

                for (let i = 0; i < 73; i++) {
                    nodes.push(getRandomSpherePoint(R + 0.15));
                }

                const dataPackets = [];
                const pathCount = 80;

                function createRandomCurve() {
                    const startNode = nodes[Math.floor(Math.random() * nodes.length)];
                    let endNode = nodes[Math.floor(Math.random() * nodes.length)];
                    while (startNode === endNode) {
                        endNode = nodes[Math.floor(Math.random() * nodes.length)];
                    }
                    const midPoint = startNode.clone().lerp(endNode, 0.5);
                    const dist = startNode.distanceTo(endNode);
                    midPoint.normalize().multiplyScalar(R + dist * 0.45);
                    return new THREE.QuadraticBezierCurve3(startNode, midPoint, endNode);
                }

                const tailLength = 0.35;
                const tailSegments = 40;

                for (let i = 0; i < pathCount; i++) {
                    const curve = createRandomCurve();
                    const colors = [0x00ffff, 0xff00ff, 0x00ffaa, 0xffcc00];
                    const pColor = colors[Math.floor(Math.random() * colors.length)];
                    const colorObj = new THREE.Color(pColor);

                    const headGeometry = new THREE.SphereGeometry(0.1, 8, 8);
                    const headMaterial = new THREE.MeshBasicMaterial({ color: pColor });
                    const headMesh = new THREE.Mesh(headGeometry, headMaterial);
                    globe.add(headMesh);

                    const tailGeometry = new THREE.BufferGeometry();
                    const tailPositions = new Float32Array(tailSegments * 3);
                    const tailColors = new Float32Array(tailSegments * 3);

                    for (let j = 0; j < tailSegments; j++) {
                        const alpha = 1.0 - (j / (tailSegments - 1));
                        const mixedColor = colorObj.clone().lerp(new THREE.Color(0x000000), 1 - alpha);
                        tailColors[j * 3] = mixedColor.r;
                        tailColors[j * 3 + 1] = mixedColor.g;
                        tailColors[j * 3 + 2] = mixedColor.b;
                    }

                    tailGeometry.setAttribute('position', new THREE.BufferAttribute(tailPositions, 3));
                    tailGeometry.setAttribute('color', new THREE.BufferAttribute(tailColors, 3));

                    const tailMaterial = new THREE.LineBasicMaterial({
                        vertexColors: true,
                        transparent: true,
                        opacity: 1,
                        blending: THREE.AdditiveBlending,
                        depthWrite: false
                    });
                    const tailLine = new THREE.Line(tailGeometry, tailMaterial);
                    globe.add(tailLine);

                    dataPackets.push({
                        curve: curve,
                        head: headMesh,
                        tail: tailLine,
                        progress: -Math.random(),
                        speed: 0.004 + Math.random() * 0.006
                    });
                }



                const ambientLight = new THREE.AmbientLight(0xffffff, 0.7);
                scene.add(ambientLight);

                const pointLight1 = new THREE.PointLight(0x00ffff, 0.8, 100);
                pointLight1.position.set(20, 20, 20);
                scene.add(pointLight1);

                const pointLight2 = new THREE.PointLight(0xff00ff, 0.8, 100);
                pointLight2.position.set(-20, -20, -20);
                scene.add(pointLight2);

                let animationFrameId;

                function animate() {
                    animationFrameId = requestAnimationFrame(animate);

                    globe.rotation.y += 0.001;

                    dataPackets.forEach(packet => {
                        packet.progress += packet.speed;

                        if (packet.progress >= 1 + tailLength) {
                            packet.progress = 0;
                            packet.curve = createRandomCurve();
                        }

                        if (packet.progress > 0) {
                            packet.head.visible = true;
                            packet.tail.visible = true;

                            let headProg = Math.min(1, packet.progress);
                            const headPoint = packet.curve.getPoint(headProg);
                            packet.head.position.copy(headPoint);

                            if (packet.progress > 1) packet.head.visible = false;

                            const positions = packet.tail.geometry.attributes.position.array;
                            for (let i = 0; i < tailSegments; i++) {
                                let p = packet.progress - (i / tailSegments) * tailLength;
                                p = Math.max(0, Math.min(1, p));
                                const point = packet.curve.getPoint(p);

                                positions[i * 3] = point.x;
                                positions[i * 3 + 1] = point.y;
                                positions[i * 3 + 2] = point.z;
                            }
                            packet.tail.geometry.attributes.position.needsUpdate = true;
                        } else {
                            packet.head.visible = false;
                            packet.tail.visible = false;
                        }
                    });

                    controls.update();
                    renderer.render(scene, camera);
                }

                animate();

                const resizeHandler = () => {
                    if(!container) return;
                    camera.aspect = container.clientWidth / container.clientHeight;
                    camera.updateProjectionMatrix();
                    renderer.setSize(container.clientWidth, container.clientHeight);
                };
                window.addEventListener('resize', resizeHandler, false);
                
                document.addEventListener('livewire:navigating', () => {
                    cancelAnimationFrame(animationFrameId);
                    window.removeEventListener('resize', resizeHandler);
                }, {once: true});
            };

            const init = async () => {
                if (!window.THREE) {
                    await loadScript('https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js');
                }
                if (!window.THREE.OrbitControls) {
                    await loadScript('https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js');
                }
                startScene();
            };

            init();
        }

        document.addEventListener('livewire:navigated', () => {
            initGlobeNetwork();
        });
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initGlobeNetwork);
        } else {
            initGlobeNetwork();
        }
    </script>
    @include('livewire.public.partials.public-footer')
</div>
