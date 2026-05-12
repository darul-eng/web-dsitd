<div>
    @section('title', 'Sejarah DSITD')

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        .plus-jakarta {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .text-gradient {
            background: linear-gradient(135deg, #8b0000 0%, #ff0000 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .timeline-line {
            background: linear-gradient(to bottom, #fee2e2 0%, #ef4444 50%, #fee2e2 100%);
        }
    </style>

    <div class="plus-jakarta bg-white min-h-screen relative overflow-hidden text-slate-900">
        {{-- Navbar --}}
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header Section --}}
        <section class="relative pt-24 pb-12 overflow-hidden mesh-gradient">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-history" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="black" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-history)" />
                </svg>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-red-500/20 text-red-500 border border-red-500/30 mb-4 backdrop-blur-xl">
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-white">Historical Journey</span>
                </div>
                
                <h1 class="text-3xl md:text-4xl font-black text-white tracking-tighter leading-tight">
                    Jejak <br /> <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-rose-400 to-orange-400">Sejarah Kami.</span>
                </h1>

                <p class="max-w-2xl text-base text-slate-300/80 font-medium leading-relaxed">
                    Melihat kembali langkah-langkah inovasi yang telah membentuk DSITD menjadi tulang punggung digital Universitas Hasanuddin.
                </p>
            </div>
        </section>

        <main class="relative z-10">
            <div class="max-w-5xl mx-auto px-6">
                
                {{-- Futuristic Timeline/Section Layout --}}
                <div class="relative space-y-16">
                    
                    {{-- Connectivity Line --}}
                    <div class="absolute left-6 md:left-6 top-6 bottom-6 w-px bg-gradient-to-b from-red-600/50 via-slate-200 to-red-600/50 hidden md:block"></div>

                    {{-- Section 1: Latar Belakang --}}
                    <section class="group relative">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="shrink-0 relative z-10">
                                <div class="w-12 h-12 bg-red-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-red-600/20 group-hover:rotate-6 transition-transform">
                                    <i class="fas fa-landmark text-lg"></i>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <h2 class="text-xs font-black text-red-600 uppercase tracking-[0.3em]">Latar Belakang</h2>
                                <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight">Amanat Strategis Abad 21</h3>
                                <p class="text-slate-600 font-medium leading-relaxed">
                                    Sebagaimana telah diamanatkan dalam Renstra Unhas 2006-2010, Universitas Hasanuddin memiliki tanggung jawab besar untuk menjadi institusi pendidikan tinggi yang unggul dan mampu membaharui masyarakat Indonesia memasuki era pengetahuan abad 21 (knowledge society).
                                </p>
                                <div class="p-6 bg-slate-50 border border-slate-100 rounded-3xl">
                                    <p class="text-sm text-slate-500 italic leading-relaxed">
                                        "Salah satu ciri utama abad 21 ini adalah berkembangnya Teknologi Informasi dan Komunikasi (ICT) yang sangat mempengaruhi tingkat kemajuan, kemakmuran, dan daya saing suatu bangsa."
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Section 2: ICT-Based Campus --}}
                    <section class="group relative">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="shrink-0 md:order-2 relative z-10">
                                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-slate-900/20 group-hover:-rotate-6 transition-transform">
                                    <i class="fas fa-network-wired text-lg"></i>
                                </div>
                            </div>
                            <div class="space-y-4 md:text-right md:flex-1">
                                <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">Visi Digital</h2>
                                <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight">Unhas ICT-Based Campus</h3>
                                <p class="text-slate-600 font-medium leading-relaxed">
                                    Unhas meyakini bahwa hanya melalui TIK yang tepat, visi dan misi dapat segera direalisasikan. Pengembangan Unhas sebagai ICT-Based Campus merupakan suatu keniscayaan untuk memberdayakan dan mencerdaskan masyarakat ke tingkat kemajuan yang lebih tinggi.
                                </p>
                                <p class="text-sm text-slate-500 leading-relaxed">
                                    Tujuan pengembangan TIK diarahkan untuk mendukung tercapainya visi dan meningkatkan peran civitas akademika dalam membaharui masyarakat, sekaligus menguasai TIK sebagai kompetensi inti.
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- Section 3: Maritime Culture --}}
                    <section class="group relative">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="shrink-0 relative z-10">
                                <div class="w-12 h-12 bg-red-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-red-600/20 group-hover:rotate-6 transition-transform">
                                    <i class="fas fa-anchor text-lg"></i>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <h2 class="text-xs font-black text-red-600 uppercase tracking-[0.3em]">Fokus Pengembangan</h2>
                                <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight">Pusat Budaya Bahari</h3>
                                <p class="text-slate-600 font-medium leading-relaxed">
                                    Proses pengembangan TIK sepenuhnya diarahkan pada pencapaian visi Unhas sebagai pusat pengembangan budaya bahari. Layanan TIK yang memadai akan meningkatkan peran civitas akademika untuk menghasilkan ilmu pengetahuan, teknologi, dan seni yang dibutuhkan industri.
                                </p>
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-700 rounded-full text-[10px] font-black uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 bg-red-600 rounded-full animate-pulse"></span>
                                    Mission: Knowledge Server
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Section 4: Layanan Terintegrasi --}}
                    <section class="group relative">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="shrink-0 md:order-2 relative z-10">
                                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-slate-900/20 group-hover:-rotate-6 transition-transform">
                                    <i class="fas fa-microchip text-lg"></i>
                                </div>
                            </div>
                            <div class="space-y-4 md:text-right md:flex-1">
                                <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">Fungsi Sistem</h2>
                                <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight">Layanan Terintegrasi</h3>
                                <p class="text-slate-600 font-medium leading-relaxed">
                                    Fungsi utama dari sistem ICT-Based Campus di Unhas adalah menyediakan layanan informasi, komputasi, dan komunikasi secara terintegrasi pada semua anggota civitas akademika Unhas dan masyarakat luar yang memadai untuk membangun komunitas pengetahuan yang adaptif, kreatif dan mampu merajut realitas.
                                </p>
                                <div class="flex flex-wrap justify-center md:justify-end gap-3 mt-4">
                                    <span class="px-4 py-1.5 bg-slate-900 text-white rounded-full text-[10px] font-bold uppercase tracking-widest">Pendidikan</span>
                                    <span class="px-4 py-1.5 bg-slate-900 text-white rounded-full text-[10px] font-bold uppercase tracking-widest">Penelitian</span>
                                    <span class="px-4 py-1.5 bg-slate-900 text-white rounded-full text-[10px] font-bold uppercase tracking-widest">Pengabdian</span>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </main>

        {{-- Footer --}}
        @include('livewire.public.partials.public-footer')
    </div>
</div>
