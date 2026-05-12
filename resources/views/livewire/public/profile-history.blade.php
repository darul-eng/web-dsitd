<div>
    @section('title', 'Sejarah DSITD')

    <style>
        .timeline-line {
            background: linear-gradient(to bottom, #fee2e2 0%, #ef4444 50%, #fee2e2 100%);
        }
    </style>

    <div class="bg-white min-h-screen relative overflow-hidden text-slate-900">
        @include('livewire.public.partials.profile-navbar')

        <section class="relative pt-20 sm:pt-24 pb-6 sm:pb-14 overflow-hidden mesh-gradient">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-history" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-history)" />
                </svg>
            </div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent pointer-events-none z-10"></div>
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 sm:mb-6">
                    <a href="{{ route('home') }}" wire:navigate class="hover:text-white transition-colors">Home</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <a href="{{ route('profile.history') }}" wire:navigate class="hover:text-white transition-colors">Profil</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-white">Sejarah</span>
                </nav>
                <h1 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white tracking-tighter leading-tight sm:leading-[0.95] mb-2 sm:mb-4">
                    Jejak<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-rose-400 to-orange-400">Sejarah Kami.</span>
                </h1>
                <p class="max-w-xl text-xs sm:text-sm lg:text-base text-slate-300/80 font-medium leading-relaxed">
                    Melihat kembali langkah-langkah inovasi yang telah membentuk DSITD menjadi tulang punggung digital Universitas Hasanuddin.
                </p>
            </div>
        </section>

        <main class="relative z-10 py-5 sm:py-12">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative space-y-5 sm:space-y-10">
                    <div class="absolute left-6 top-6 bottom-6 w-px bg-gradient-to-b from-red-600/50 via-slate-200 to-red-600/50 hidden md:block"></div>

                    <section class="group relative">
                        <div class="flex flex-col md:flex-row gap-4 sm:gap-6 items-start">
                            <div class="shrink-0 relative z-10">
                                <div class="w-12 h-12 bg-red-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-red-600/20 group-hover:rotate-6 transition-transform">
                                    <i class="fas fa-landmark text-lg"></i>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <h2 class="text-xs font-black text-red-600 uppercase tracking-[0.3em]">Latar Belakang</h2>
                                <h3 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-tight">Amanat Strategis Abad 21</h3>
                                <p class="text-sm text-slate-600 font-medium leading-relaxed">Sebagaimana telah diamanatkan dalam Renstra Unhas 2006-2010, Universitas Hasanuddin memiliki tanggung jawab besar untuk menjadi institusi pendidikan tinggi yang unggul dan mampu membaharui masyarakat Indonesia memasuki era pengetahuan abad 21 (knowledge society).</p>
                                <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl">
                                    <p class="text-sm text-slate-500 italic leading-relaxed">"Salah satu ciri utama abad 21 ini adalah berkembangnya Teknologi Informasi dan Komunikasi (ICT) yang sangat mempengaruhi tingkat kemajuan, kemakmuran, dan daya saing suatu bangsa."</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="group relative">
                        <div class="flex flex-col md:flex-row gap-4 sm:gap-6 items-start">
                            <div class="shrink-0 md:order-2 relative z-10">
                                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-slate-900/20 group-hover:-rotate-6 transition-transform">
                                    <i class="fas fa-network-wired text-lg"></i>
                                </div>
                            </div>
                            <div class="space-y-3 md:text-right md:flex-1">
                                <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">Visi Digital</h2>
                                <h3 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-tight">Unhas ICT-Based Campus</h3>
                                <p class="text-sm text-slate-600 font-medium leading-relaxed">Unhas meyakini bahwa hanya melalui TIK yang tepat, visi dan misi dapat segera direalisasikan. Pengembangan Unhas sebagai ICT-Based Campus merupakan suatu keniscayaan untuk memberdayakan dan mencerdaskan masyarakat ke tingkat kemajuan yang lebih tinggi.</p>
                                <p class="text-sm text-slate-500 leading-relaxed">Tujuan pengembangan TIK diarahkan untuk mendukung tercapainya visi dan meningkatkan peran civitas akademika dalam membaharui masyarakat, sekaligus menguasai TIK sebagai kompetensi inti.</p>
                            </div>
                        </div>
                    </section>

                    <section class="group relative">
                        <div class="flex flex-col md:flex-row gap-4 sm:gap-6 items-start">
                            <div class="shrink-0 relative z-10">
                                <div class="w-12 h-12 bg-red-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-red-600/20 group-hover:rotate-6 transition-transform">
                                    <i class="fas fa-anchor text-lg"></i>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <h2 class="text-xs font-black text-red-600 uppercase tracking-[0.3em]">Fokus Pengembangan</h2>
                                <h3 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-tight">Pusat Budaya Bahari</h3>
                                <p class="text-sm text-slate-600 font-medium leading-relaxed">Proses pengembangan TIK sepenuhnya diarahkan pada pencapaian visi Unhas sebagai pusat pengembangan budaya bahari. Layanan TIK yang memadai akan meningkatkan peran civitas akademika untuk menghasilkan ilmu pengetahuan, teknologi, dan seni yang dibutuhkan industri.</p>
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-700 rounded-full text-[10px] font-black uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 bg-red-600 rounded-full animate-pulse"></span>
                                    Mission: Knowledge Server
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="group relative">
                        <div class="flex flex-col md:flex-row gap-4 sm:gap-6 items-start">
                            <div class="shrink-0 md:order-2 relative z-10">
                                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-slate-900/20 group-hover:-rotate-6 transition-transform">
                                    <i class="fas fa-microchip text-lg"></i>
                                </div>
                            </div>
                            <div class="space-y-3 md:text-right md:flex-1">
                                <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">Fungsi Sistem</h2>
                                <h3 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-tight">Layanan Terintegrasi</h3>
                                <p class="text-sm text-slate-600 font-medium leading-relaxed">Fungsi utama dari sistem ICT-Based Campus di Unhas adalah menyediakan layanan informasi, komputasi, dan komunikasi secara terintegrasi pada semua anggota civitas akademika Unhas dan masyarakat luar yang memadai untuk membangun komunitas pengetahuan yang adaptif, kreatif dan mampu merajut realitas.</p>
                                <div class="flex flex-wrap justify-center md:justify-end gap-2 mt-2">
                                    <span class="px-3 py-1.5 bg-slate-900 text-white rounded-full text-[10px] font-bold uppercase tracking-widest">Pendidikan</span>
                                    <span class="px-3 py-1.5 bg-slate-900 text-white rounded-full text-[10px] font-bold uppercase tracking-widest">Penelitian</span>
                                    <span class="px-3 py-1.5 bg-slate-900 text-white rounded-full text-[10px] font-bold uppercase tracking-widest">Pengabdian</span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        @include('livewire.public.partials.public-footer')
    </div>
</div>
