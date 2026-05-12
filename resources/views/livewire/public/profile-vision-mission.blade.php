<div>
    @section('title', 'Visi & Misi DSITD')

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        .plus-jakarta {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        :root {
            --unhas-red: #8b0000;
        }

        .unhas-text-gradient {
            background: linear-gradient(135deg, #8b0000 0%, #ff0000 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .vision-card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
        }

        .mesh-gradient {
            background: radial-gradient(circle at 100% 0%, #8b0000 0%, #1e293b 100%);
        }

        .mission-step {
            transition: all 0.3s ease;
        }

        .mission-step:hover {
            border-color: #fee2e2;
            background: #fffafa;
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
                    <defs><pattern id="grid-vision" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="black" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-vision)" />
                </svg>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-red-500/20 text-red-500 border border-red-500/30 mb-4 backdrop-blur-xl">
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-white">Fondasi Strategis & Visi</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white tracking-tighter leading-tight">
                    Visi & <br /> <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-rose-400 to-orange-400">Misi Kami.</span>
                </h1>

                <p class="max-w-2xl text-base text-slate-300/80 font-medium leading-relaxed">
                    Mengakselerasi masa depan digital Universitas Hasanuddin melalui inovasi dan integrasi teknologi yang berkelanjutan.
                </p>
            </div>
        </section>

        <main class="relative z-10 py-10 md:py-12">
            <div class="max-w-6xl mx-auto px-6">
                
                {{-- Stable 2-Column Grid --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                    
                    {{-- Column: Vision --}}
                    <div>
                        <div class="lg:sticky lg:top-32">
                            <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-6">Visi Utama</h2>
                            <div class="vision-card p-8 md:p-10 rounded-[2rem] relative">
                                <p class="text-xl md:text-2xl font-bold text-slate-800 leading-tight italic">
                                    “Menjadikan Universitas Hasanuddin sebagai kampus yang didukung sepenuhnya oleh Teknologi Informasi Dan Komunikasi sehingga bisa membawa UNHAS menjadi universitas terdepan dalam pelayanan dan pemanfaatan Teknologi Informasi Dan Komunikasi dalam manajemen universitas dan pelaksanaan tri dharma perguruan tinggi, baik dalam skala nasional maupun internasional.”
                                </p>
                            </div>

                            <div class="mt-8 flex items-center gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-100">
                                <div class="w-2 h-10 bg-red-600 rounded-full"></div>
                                <p class="text-sm font-bold text-slate-600 italic">“Solusi Digital, Transformasi Nyata.”</p>
                            </div>
                        </div>
                    </div>

                    {{-- Column: Mission --}}
                    <div>
                        <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-6">Misi Strategis</h2>
                        
                        <div class="space-y-4">
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
                                <div class="mission-step p-8 rounded-3xl border border-slate-100 group">
                                    <div class="flex items-start gap-6">
                                        <div class="text-3xl font-black text-slate-200 group-hover:text-red-600 transition-colors">0{{ $index + 1 }}</div>
                                        <div>
                                            <h3 class="text-xl font-bold text-slate-800 mb-3">{{ $m['title'] }}</h3>
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
