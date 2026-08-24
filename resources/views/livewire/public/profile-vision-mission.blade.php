<div>
    @section('title', 'Visi & Misi LTDKA')

    <div class="bg-white min-h-screen relative overflow-hidden text-slate-900">
        {{-- Navbar --}}
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header Section --}}
        <section class="relative pt-20 sm:pt-24 pb-6 sm:pb-14 overflow-hidden mesh-gradient">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-vision" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-vision)" />
                </svg>
            </div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent pointer-events-none z-10"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 sm:mb-6">
                    <a href="{{ route('home') }}" wire:navigate class="hover:text-white transition-colors">Home</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <a href="{{ route('profile.vision-mission') }}" wire:navigate class="hover:text-white transition-colors">Profil</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-white">Visi & Misi</span>
                </nav>
                <h1 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white tracking-tighter leading-tight sm:leading-[0.95] mb-2 sm:mb-4">
                    Visi &<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-rose-400 to-orange-400">Misi Kami.</span>
                </h1>
                <p class="max-w-xl text-xs sm:text-sm lg:text-base text-slate-300/80 font-medium leading-relaxed">
                    Mengakselerasi masa depan digital Universitas Hasanuddin melalui inovasi dan integrasi teknologi yang berkelanjutan.
                </p>
            </div>
        </section>

        <main class="relative z-10 py-5 sm:py-12">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Stable 2-Column Grid --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10">

                    {{-- Column: Vision --}}
                    <div>
                        <div class="lg:sticky lg:top-28">
                            <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-5">Visi Utama</h2>
                            <div class="bg-white border border-slate-100 shadow-[0_20px_50px_rgba(0,0,0,0.05)] p-7 md:p-9 rounded-[2rem] relative">
                                <p class="text-lg md:text-xl font-bold text-slate-800 leading-tight italic">
                                    "Menjadikan Universitas Hasanuddin sebagai kampus yang didukung sepenuhnya oleh Teknologi Informasi Dan Komunikasi sehingga bisa membawa UNHAS menjadi universitas terdepan dalam pelayanan dan pemanfaatan Teknologi Informasi Dan Komunikasi dalam manajemen universitas dan pelaksanaan tri dharma perguruan tinggi, baik dalam skala nasional maupun internasional."
                                </p>
                            </div>

                            <div class="mt-6 flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <div class="w-2 h-10 bg-red-600 rounded-full"></div>
                                <p class="text-sm font-bold text-slate-600 italic">"Solusi Digital, Transformasi Nyata."</p>
                            </div>
                        </div>
                    </div>

                    {{-- Column: Mission --}}
                    <div>
                        <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-5">Misi Strategis</h2>

                        <div class="space-y-3">
                            @php
                                $missions = [
                                    [
                                        'title' => 'Integrasi Sistem',
                                        'desc' => 'Menyediakan SistemTeknologi Informasi dan Komunikasi yang terintegrasi.'
                                    ],
                                    [
                                        'title' => 'Aksesibilitas Global',
                                        'desc' => 'Menyediakan informasi dan aplikasi universitas bisa diakses dari mana saja, kapan saja serta dengan ragam perangkat akses yang senantiasa berkembang.'
                                    ],
                                    [
                                        'title' => 'Kepemimpinan Layanan',
                                        'desc' => 'Universitas terdepan dalam pelayanan dan pemanfaatan Teknologi Informasi Dan Komunikasi.'
                                    ],
                                    [
                                        'title' => 'Outcome Berkelanjutan',
                                        'desc' => 'Mengembangankan dan implementasi Teknologi informasi di Unhas harus memberikan outcome transparansi, efektivitas, efisiensi, akuntabilitas dan reliabilitas bagi keseluruhan penyelenggaraan layanan manajemen universitas.'
                                    ]
                                ];
                            @endphp

                            @foreach($missions as $index => $m)
                                <div class="p-6 rounded-2xl border border-slate-100 hover:border-red-100 hover:bg-red-50/30 transition-all duration-300 group">
                                    <div class="flex items-start gap-5">
                                        <div class="text-2xl font-black text-slate-200 group-hover:text-red-600 transition-colors shrink-0">0{{ $index + 1 }}</div>
                                        <div>
                                            <h3 class="text-base font-bold text-slate-800 mb-2">{{ $m['title'] }}</h3>
                                            <p class="text-slate-500 font-medium leading-relaxed text-sm">{{ $m['desc'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </main>

        {{-- Footer --}}
        @include('livewire.public.partials.public-footer')
    </div>
</div>
