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
                <a href="#layanan" :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Layanan</a>
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
                <a href="#dokumen" :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Dokumen</a>
                <a href="#berita" :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Warta</a>
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
                <a @click="mobileMenuOpen = false" href="#layanan" class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Layanan</a>
                
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

                <a @click="mobileMenuOpen = false" href="#dokumen" class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Dokumen</a>
                <a @click="mobileMenuOpen = false" href="#berita" class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Warta</a>
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
                <a href="#layanan" class="group relative px-12 py-5 bg-red-600 text-white text-xs font-black rounded-2xl hover:bg-red-700 transition-all shadow-[0_20px_50px_rgba(239,68,68,0.4)] uppercase tracking-widest overflow-hidden">
                    <span class="relative z-10">Eksplorasi Layanan</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </a>
                <a href="{{ route('profile.vision-mission') }}" wire:navigate class="px-12 py-5 bg-white/5 text-white text-xs font-black rounded-2xl hover:bg-white/10 transition-all border border-white/10 backdrop-blur-md uppercase tracking-widest">Dokumentasi Profil</a>
            </div>
        </div>

        <div class="mt-24 w-full max-w-5xl px-6 relative" data-aos="zoom-in-up" data-aos-delay="400">
             <div class="glass p-2 rounded-[2.5rem] shadow-2xl shadow-slate-200/50">
                <div class="bg-slate-900 rounded-[2rem] p-6 md:p-12 text-white relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-red-600 filter blur-[100px] opacity-20 transition-all group-hover:opacity-40"></div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                        <div class="flex flex-col">
                            <span class="text-4xl font-black tracking-tighter">{{ $uptimeRate }}%</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-2">Uptime Jaringan</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-4xl font-black tracking-tighter">120+</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-2">Aplikasi Terintegrasi</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-4xl font-black tracking-tighter">45K+</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-2">Pengguna Aktif</span>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </section>

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

    <!-- Visual Trust / Stats -->
    <section class="py-32 bg-slate-50 border-y border-slate-100 relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-2xl h-full max-h-2xl bg-red-600/5 filter blur-[120px] rounded-full pointer-events-none"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-xs font-black text-red-600 uppercase tracking-widest mb-4">Digital Transparency</h2>
                    <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter leading-tight mb-8">Keandalan Infrastruktur adalah Prioritas Kami.</h1>
                    <div class="space-y-8">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">24/7 Monitoring Center</h4>
                                <p class="text-xs text-slate-500 font-medium mt-1">Sistem kami dipantau secara real-time untuk menjamin ketersediaan layanan.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09m8.19.893c2.827-2.73 4.69-6.439 4.69-10.538V12m-6.57 9.503A12.062 12.062 0 0112 21M9 11l3 3L22 4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Cyber Security First</h4>
                                <p class="text-xs text-slate-500 font-medium mt-1">Perlindungan data sensitif universitas dengan standar keamanan tingkat tinggi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left" class="relative">
                    <div class="glass p-4 rounded-[3rem] shadow-2xl">
                        <div class="bg-white rounded-[2.5rem] p-10 relative overflow-hidden border border-slate-50">
                            <!-- Lottie Network Animation -->
                            <lottie-player src="{{ asset('lottie/network.json') }}" background="transparent" speed="1" style="width: 100%; height: auto;" loop autoplay></lottie-player>
                            <div class="mt-8 grid grid-cols-2 gap-4">
                                <div class="p-4 bg-slate-50 rounded-2xl">
                                    <span class="block text-2xl font-black text-slate-900 tracking-tighter">10Gbps</span>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-1">Backbone Speed</span>
                                </div>
                                <div class="p-4 bg-slate-50 rounded-2xl">
                                    <span class="block text-2xl font-black text-slate-900 tracking-tighter">99.9%</span>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-1">SLA Guarantee</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- News & Blog -->
    <section id="berita" class="py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-end justify-between mb-20 gap-6">
                <div class="max-w-xl">
                    <h2 class="text-xs font-black text-red-600 uppercase tracking-widest mb-4">Latest Insights</h2>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Warta Transformasi.</h1>
                </div>
                <button class="px-8 py-3 bg-slate-50 text-slate-900 text-xs font-black rounded-lg hover:bg-slate-100 transition-all border border-slate-200 uppercase tracking-widest">Lihat Semua Berita</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($latestNews as $news)
                <div data-aos="fade-up" class="group">
                    <div class="relative aspect-video rounded-3xl overflow-hidden mb-6">
                        @if($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur text-[9px] font-black text-slate-900 rounded-full uppercase tracking-widest">{{ $news->category->name ?? 'Update' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $news->created_at->format('d M Y') }}</span>
                        <div class="w-1 h-1 bg-red-600 rounded-full"></div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $news->author->name ?? 'Admin' }}</span>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight group-hover:text-red-600 transition-colors cursor-pointer mb-3 leading-tight">{{ $news->title }}</h3>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed mb-6">{{ Str::limit(strip_tags($news->content), 100) }}</p>
                    <a href="{{ route('news.show', $news->slug) }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-900 uppercase tracking-widest hover:text-red-600 transition-colors">
                        Baca Selengkapnya
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <livewire:public.gallery-showcase />

    <!-- Public Documents Section -->
    <section id="dokumen" class="py-32 bg-white relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-6">
                <div class="max-w-xl">
                    <h2 class="text-xs font-black text-red-600 uppercase tracking-widest mb-4">Resource Center</h2>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Dokumen Publik & Panduan.</h1>
                </div>
                <a href="#" class="text-[10px] font-black text-slate-400 hover:text-red-600 transition-colors uppercase tracking-[0.2em] border-b border-slate-200 pb-1">Lihat Semua Dokumen</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($publicDocuments as $doc)
                <div data-aos="fade-up" class="group">
                    <div class="bg-white border border-slate-100 p-8 rounded-[2rem] hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500 flex items-center justify-between">
                        <div class="flex items-center gap-6">
                            <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100 group-hover:bg-red-50 group-hover:border-red-100 transition-colors">
                                <svg class="w-7 h-7 text-slate-400 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-[8px] font-bold text-red-600 uppercase tracking-widest">{{ $doc->category->name ?? 'Umum' }}</span>
                                <h3 class="text-lg font-bold text-slate-900 tracking-tight mt-1">{{ $doc->title }}</h3>
                                <div class="flex items-center gap-4 mt-2">
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $doc->file_type ?? 'PDF' }}</span>
                                    <div class="w-1 h-1 bg-slate-200 rounded-full"></div>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ number_format($doc->file_size / 1024, 1) }} KB</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $doc->file_path) }}" download class="w-12 h-12 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-300 group-hover:scale-110">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
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
                        <a href="#layanan" class="text-white text-xs font-black uppercase tracking-widest border-b-2 border-white/20 hover:border-white transition-all pb-1">Lihat Dokumentasi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('livewire.public.partials.public-footer')
</div>
