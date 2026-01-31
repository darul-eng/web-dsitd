<div x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
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
                <a href="#profil" :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Profil</a>
                <a href="#dokumen" :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Dokumen</a>
                <a href="#berita" :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Warta</a>
                <a href="#kontak" :class="scrolled ? 'text-slate-500 hover:text-red-600' : 'text-slate-300 hover:text-white'" class="text-[11px] font-bold transition-all uppercase tracking-widest">Kontak</a>
            </nav>
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 px-3 py-1.5 bg-white/5 border border-white/10 rounded-full backdrop-blur-md">
                <div class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $systemOperational ? 'bg-emerald-400' : 'bg-rose-400' }} opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 {{ $systemOperational ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                </div>
                <span class="text-[9px] font-black {{ $systemOperational ? 'text-emerald-400' : 'text-rose-400' }} uppercase tracking-tighter">
                    {{ $systemOperational ? 'System Operational' : 'Under Maintenance' }}
                </span>
            </div>
            <a href="https://helpdesk.unhas.ac.id/" target="_blank" class="hidden sm:inline-flex px-5 py-2 bg-red-600 border border-red-500 text-white text-[10px] font-black rounded-lg hover:bg-red-700 transition-all uppercase tracking-widest shadow-xl shadow-red-600/20">Tanya IT Helpdesk</a>
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

            <h1 class="text-6xl md:text-9xl font-black text-white tracking-tighter leading-[0.9] mb-10">
                Transformasi Digital<br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-rose-400 to-orange-400 filter drop-shadow-[0_0_15px_rgba(239,68,68,0.3)]">Tanpa Batas.</span>
            </h1>

            <p class="max-w-2xl mx-auto text-lg md:text-xl text-slate-300/80 font-medium leading-relaxed mb-14">
                Pusat Teknologi Informasi dan Komunikasi yang mengelola infrastruktur jaringan, pengembangan aplikasi, dan transformasi data untuk ekosistem pendidikan masa depan.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
                <a href="#layanan" class="group relative px-12 py-5 bg-red-600 text-white text-xs font-black rounded-2xl hover:bg-red-700 transition-all shadow-[0_20px_50px_rgba(239,68,68,0.4)] uppercase tracking-widest overflow-hidden">
                    <span class="relative z-10">Eksplorasi Layanan</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </a>
                <a href="#profil" class="px-12 py-5 bg-white/5 text-white text-xs font-black rounded-2xl hover:bg-white/10 transition-all border border-white/10 backdrop-blur-md uppercase tracking-widest">Dokumentasi Profil</a>
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
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Ekosistem Digital Terintegrasi.</h1>
                </div>
                <p class="max-w-md text-sm text-slate-500 font-medium leading-relaxed">
                    Kami menyediakan pondasi teknologi yang stabil untuk mendukung kegiatan akademik, riset, dan administrasi di lingkungan universitas.
                </p>
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

    <!-- Public Documents Section -->
    <section id="dokumen" class="py-32 bg-slate-50 border-y border-slate-100 relative overflow-hidden">
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
    <section class="py-24 bg-white px-6">
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

    <!-- Footer -->
    <footer id="kontak" class="bg-white border-t border-slate-100 pt-24 pb-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-16 mb-24">
                <div class="md:col-span-4">
                    <a href="/" class="flex items-center gap-3 mb-8">
                        <img src="{{ asset('img/logo-dark.png') }}" alt="Logo DSITD UNHAS" class="h-10" loading="lazy">
                        <div class="flex flex-col">
                            <span class="text-base font-black tracking-tighter leading-none">DSITD</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mt-1">Universitas Hasanuddin</span>
                        </div>
                    </a>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed mb-8 max-w-xs">
                        Direktorat Sistem Teknologi Informasi dan Digitalisasi adalah unit pengelola TIK di lingkungan Universitas Hasanuddin.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-8">Layanan</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">Email UNHAS</a></li>
                        <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">Web Hosting</a></li>
                        <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">SIAKAD</a></li>
                        <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">VPN Access</a></li>
                    </ul>
                </div>

                <div class="md:col-span-2">
                    <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-8">Tautan</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">Pusat Bantuan</a></li>
                        <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">Status Layanan</a></li>
                        <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="md:col-span-4">
                    <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-8">Lokasi Kami</h4>
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 italic text-xs text-slate-600 font-medium leading-loose">
                        Lantai 1, Gedung Perpustakaan Pusat,<br/>
                        Kampus UNHAS Tamalanrea,<br/>
                        Jl. Perintis Kemerdekaan KM.10,<br/>
                        Makassar, Sulawesi Selatan.
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-t border-slate-100 pt-12">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">© 2024 DSITD Universitas Hasanuddin. All rights reserved.</p>
                <div class="flex items-center gap-8">
                    <a href="#" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">Term of Service</a>
                    <a href="#" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">Digital Guidelines</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS Library for Scroll Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100,
                easing: 'ease-out-expo'
            });
        });

        // Fallback for initial load
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-expo'
        });
    </script>
</div>
