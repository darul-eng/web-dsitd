<div>
    @section('title', 'Tim Kami')

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        .plus-jakarta {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        :root {
            --unhas-red: #8b0000;
            --unhas-gold: #ffd700;
        }

        .card-shimmer {
            position: relative;
            overflow: hidden;
        }

        .card-shimmer::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
            transform: scale(0);
            transition: transform 0.6s ease-out;
            pointer-events: none;
        }

        .card-shimmer:hover::before {
            transform: scale(1);
        }

        .filter-btn.active {
            background-color: var(--unhas-red);
            color: white;
            box-shadow: 0 4px 14px 0 rgba(139, 0, 0, 0.3);
        }

        .unhas-gradient-text {
            background: linear-gradient(135deg, #8b0000 0%, #cc0000 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <div class="plus-jakarta bg-white min-h-screen">
        {{-- Navbar --}}
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header Section --}}
        <section class="relative pt-24 pb-12 overflow-hidden mesh-gradient">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-org" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="black" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-org)" />
                </svg>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-red-500/20 text-red-500 border border-red-500/30 mb-4 backdrop-blur-xl">
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-white">Smart Campus Initiative</span>
                </div>
                
                <h1 class="text-3xl md:text-4xl font-black text-white tracking-tighter leading-tight">
                    Direktorat Sistem Informasi<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-rose-400 to-orange-400">Transformasi Digital.</span>
                </h1>

                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <p class="max-w-2xl text-base text-slate-300/80 font-medium leading-relaxed">
                        Menggerakkan ekosistem digital Universitas Hasanuddin melalui kolaborasi lintas fungsi yang lincah dan inovatif.
                    </p>
                    <div class="flex items-center bg-white/10 backdrop-blur-md p-1.5 rounded-xl border border-white/10 w-full md:w-auto">
                        <i class="fas fa-search text-white/50 ml-3"></i>
                        <input type="text" id="searchInput" placeholder="Cari tim IT UNHAS..."
                            class="bg-transparent border-none focus:ring-0 text-sm text-white placeholder:text-white/50 w-full md:w-56 px-3 py-1.5 outline-none">
                    </div>
                </div>
            </div>
        </section>

        <main class="container mx-auto px-6 py-10 md:py-12">

            <!-- Strategy & Coordination -->
            <section class="mb-12">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-1.5 h-6 bg-[#8b0000] rounded-full"></div>
                    <h2 class="text-xl font-bold text-slate-800">Pimpinan</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $coordinators = $members->whereIn('position_group', ['direktur', 'pimpinan', 'kasubdit', 'pengelola']);
                    @endphp

                    @foreach($coordinators as $coord)
                        <div class="card-shimmer bg-white p-6 rounded-[1.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 group">
                            <div class="relative w-24 h-24 mb-6 group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 {{ $coord->position_group == 'direktur' ? 'bg-[#8b0000]' : 'bg-slate-800' }} rounded-3xl rotate-6 group-hover:rotate-12 transition-transform opacity-10">
                                </div>
                                <img src="{{ $this->memberImage($coord) }}"
                                    alt="{{ $coord->fullname }}" class="relative z-10 w-full h-full rounded-3xl object-cover shadow-md">
                            </div>
                            <h3 class="text-2xl font-bold text-slate-800">{{ $coord->fullname }}</h3>
                            <p class="{{ $coord->position_group == 'direktur' ? 'text-red-700' : 'text-slate-600' }} font-semibold text-sm mb-4">{{ $coord->position }}</p>
                            <p class="text-slate-500 text-sm leading-relaxed mb-6">{{ $coord->nip ?? 'Anggota Strategis DSITD UNHAS' }}</p>
                            <div class="flex space-x-3">
                                @if($coord->email)
                                    <a href="mailto:{{ $coord->email }}" class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-red-700 hover:text-white transition-all">
                                        <i class="far fa-envelope"></i>
                                    </a>
                                @endif
                                <a href="#" class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-slate-800 hover:text-white transition-all">
                                    <i class="fas fa-id-badge"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Squad Grid Section -->
            <section>
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                    <h2 class="text-xl font-bold text-slate-800 flex items-center">
                        <span class="w-6 h-1 bg-[#8b0000] mr-3 rounded-full"></span>
                        Tim Transformasi Digital
                    </h2>
                    <div class="flex items-center overflow-x-auto pb-4 md:pb-0 no-scrollbar -mx-6 px-6 md:mx-0 md:px-0 gap-2">
                        @php
                            $groups = $members->whereNotIn('position_group', ['direktur', 'pimpinan', 'kasubdit', 'pengelola'])->pluck('position_group')->unique();
                        @endphp
                        <button class="filter-btn active text-[10px] font-bold px-4 py-2 rounded-full transition-all uppercase tracking-wider whitespace-nowrap">Semua</button>
                        @foreach($groups as $group)
                            <button class="filter-btn bg-white text-slate-500 text-[10px] font-bold px-4 py-2 rounded-full border border-slate-100 transition-all uppercase tracking-wider whitespace-nowrap">
                                {{ str_replace('-', ' ', $group) }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="memberGrid">
                    @foreach($members->whereNotIn('position_group', ['direktur', 'pimpinan', 'kasubdit', 'pengelola']) as $member)
                        @php
                            $bgClass = 'bg-red-50';
                            $textClass = 'text-red-700';
                            $badgeClass = 'bg-red-100';
                            
                            if (Str::contains($member->position_group, ['jaringan', 'infra', 'network'])) {
                                $bgClass = 'bg-amber-50';
                                $textClass = 'text-amber-700';
                                $badgeClass = 'bg-amber-100';
                            } elseif (Str::contains($member->position_group, ['security', 'keamanan'])) {
                                $bgClass = 'bg-slate-900';
                                $textClass = 'text-white';
                                $badgeClass = 'bg-slate-800';
                            }
                        @endphp
                        <div class="group bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:border-red-200 transition-all cursor-pointer"
                            data-squad="{{ str_replace('-', ' ', $member->position_group) }}">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-14 h-14 {{ $bgClass }} rounded-2xl flex items-center justify-center {{ $textClass }} font-bold text-xl overflow-hidden">
                                    @if($member->image)
                                        <img src="{{ $this->memberImage($member) }}" alt="{{ $member->fullname }}" class="w-full h-full object-cover">
                                    @else
                                        {{ collect(explode(' ', $member->fullname))->take(2)->map(fn($n) => substr($n, 0, 1))->join('') }}
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 line-clamp-1">{{ $member->fullname }}</h4>
                                    <span class="text-[9px] {{ $badgeClass }} {{ $textClass }} px-2 py-0.5 rounded-full font-bold uppercase tracking-widest">
                                        {{ str_replace('-', ' ', $member->position_group) }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4 line-clamp-2">{{ $member->position }}</p>
                            <div class="flex justify-between items-center pt-2 border-t border-slate-50">
                                <span class="text-[10px] font-semibold text-slate-400">{{ $member->nip ?? 'DSITD UNHAS' }}</span>
                                <i class="fas fa-arrow-right text-red-700 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>

        {{-- Footer --}}
        @include('livewire.public.partials.public-footer')
    </div>

    <script>
        document.addEventListener('livewire:navigated', () => {
            initFiltering();
        });

        document.addEventListener('DOMContentLoaded', () => {
            initFiltering();
        });

        function initFiltering() {
            const searchInput = document.getElementById('searchInput');
            const cards = document.querySelectorAll('#memberGrid > div');
            const filterBtns = document.querySelectorAll('.filter-btn');

            if (!searchInput || cards.length === 0) return;

            // Pencarian Interaktif
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase();
                cards.forEach(card => {
                    const name = card.querySelector('h4').textContent.toLowerCase();
                    const squad = card.getAttribute('data-squad').toLowerCase();
                    const position = card.querySelector('p').textContent.toLowerCase();
                    
                    if (name.includes(query) || squad.includes(query) || position.includes(query)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });

            // Filter Sederhana
            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    const filter = btn.textContent.trim().toLowerCase();
                    cards.forEach(card => {
                        const cardSquad = card.getAttribute('data-squad').toLowerCase();
                        if (filter === 'semua' || cardSquad === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        }
    </script>
</div>
