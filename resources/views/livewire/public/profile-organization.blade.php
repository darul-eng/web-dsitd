<div>
    @section('title', 'Tim Kami')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        .card-shimmer {
            position: relative;
            overflow: hidden;
        }
        .card-shimmer::before {
            content: "";
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            transform: scale(0);
            transition: transform 0.6s ease-out;
            pointer-events: none;
        }
        .card-shimmer:hover::before { transform: scale(1); }
        .filter-btn.active {
            background-color: #8b0000;
            color: white;
            box-shadow: 0 4px 14px 0 rgba(139,0,0,0.3);
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="bg-white min-h-screen">
        {{-- Navbar --}}
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header Section --}}
        <section class="relative pt-20 sm:pt-24 pb-6 sm:pb-14 overflow-hidden mesh-gradient">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-org" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-org)" />
                </svg>
            </div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent pointer-events-none z-10"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">
                    <div class="flex-1">
                        <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 sm:mb-6">
                            <a href="{{ route('home') }}" wire:navigate class="hover:text-white transition-colors">Home</a>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <span class="hover:text-white transition-colors">Profil</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <span class="text-white">Tim Kami</span>
                        </nav>
                        <h1 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white tracking-tighter leading-tight sm:leading-[0.95] mb-2 sm:mb-4">
                            Direktorat Sistem Informasi<br/>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-rose-400 to-orange-400">Transformasi Digital.</span>
                        </h1>
                        <p class="max-w-xl text-xs sm:text-sm lg:text-base text-slate-300/80 font-medium leading-relaxed mb-6">
                            Menggerakkan ekosistem digital Universitas Hasanuddin melalui kolaborasi lintas fungsi yang lincah dan inovatif.
                        </p>
                        {{-- Search --}}
                        <div class="flex items-center bg-white/10 backdrop-blur-md p-1.5 rounded-xl border border-white/10 w-full md:w-72">
                            <svg class="w-4 h-4 text-white/50 ml-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" id="searchInput" placeholder="Cari tim IT UNHAS..."
                                class="bg-transparent border-none focus:ring-0 text-sm text-white placeholder:text-white/50 w-full px-3 py-1.5 outline-none">
                        </div>
                    </div>
                    <div class="hidden lg:flex flex-col items-end gap-4">
                        <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-6 text-right min-w-[120px] sm:min-w-[160px]">
                            <div class="text-3xl sm:text-4xl font-black text-white tracking-tighter leading-none">{{ $members->count() }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Anggota Tim</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Strategy & Coordination -->
            <section class="mb-6 sm:mb-12">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-1.5 h-6 bg-[#8b0000] rounded-full"></div>
                    <h2 class="text-xl font-bold text-slate-800">Pimpinan</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $coordinators = $members->whereIn('position_group', ['direktur', 'pimpinan', 'kasubdit', 'pengelola']);
                    @endphp

                    @foreach($coordinators as $coord)
                        <div class="card-shimmer bg-white p-4 sm:p-6 rounded-xl sm:rounded-[1.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 group">
                            <div class="relative w-24 h-24 mb-6 group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 {{ $coord->position_group == 'direktur' ? 'bg-[#8b0000]' : 'bg-slate-800' }} rounded-3xl rotate-6 group-hover:rotate-12 transition-transform opacity-10">
                                </div>
                                <img src="{{ $this->memberImage($coord) }}"
                                    alt="{{ $coord->fullname }}" class="relative z-10 w-full h-full rounded-3xl object-cover shadow-md">
                            </div>
                            <h3 class="text-2xl font-bold text-slate-800">{{ $coord->fullname }}</h3>
                            <p class="{{ $coord->position_group == 'direktur' ? 'text-red-700' : 'text-slate-600' }} font-semibold text-sm mb-4">{{ $coord->position }}</p>
                            <p class="text-slate-500 text-sm leading-relaxed mb-6">{{ $coord->nip ?? '' }}</p>
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

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5" id="memberGrid">
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
