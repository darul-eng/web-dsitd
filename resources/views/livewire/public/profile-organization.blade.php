<div>
    @section('title', 'Tim Kami')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/profile-modal.css') }}" rel="stylesheet">

    <style>
        .filter-btn.active {
            background-color: #213369;
            color: white;
            box-shadow: 0 4px 14px 0 rgba(33,51,105,0.3);
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="bg-white min-h-screen" x-data="{ showModal: false, activeHotspot: null }">
        {{-- Navbar --}}
        @include('livewire.public.partials.profile-navbar', ['forceLight' => true])

        <main class="container mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-12 sm:pt-24">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-8 sm:mb-12">
                <div class="flex-1">
                    <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 sm:mb-6">
                        <a href="{{ route('home') }}" wire:navigate class="hover:text-red-600 transition-colors">Home</a>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="hover:text-red-600 transition-colors">Profil</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="text-slate-700">Tim Kami</span>
                    </nav>
                    <h1 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter leading-tight sm:leading-[0.95] mb-6">
                        Direktorat Sistem Informasi<br/>
                        <span class="text-red-600">Transformasi Digital.</span>
                    </h1>
                    {{-- Search --}}
                    <div class="flex items-center bg-slate-50 p-1.5 rounded-xl border border-slate-200 w-full md:w-72">
                        <svg class="w-4 h-4 text-slate-400 ml-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" id="searchInput" placeholder="Cari tim IT UNHAS..."
                            class="bg-transparent border-none focus:ring-0 text-sm text-slate-700 placeholder:text-slate-400 w-full px-3 py-1.5 outline-none">
                    </div>
                </div>
                <div class="hidden lg:flex flex-col items-end gap-4">
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 sm:p-6 text-right min-w-[120px] sm:min-w-[160px]">
                        <div class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tighter leading-none">{{ $members->count() }}</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Anggota Tim</div>
                    </div>
                </div>
            </div>

            <!-- Strategy & Coordination -->
            <section class="mb-6 sm:mb-12">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-1.5 h-6 bg-[#213369] rounded-full"></div>
                    <h2 class="text-xl font-bold text-slate-800">Pimpinan</h2>
                </div>
                @php
                    $leadershipKeywords = ['Direktur', 'Kasubdit', 'Kepala', 'Sekretaris', 'Ketua'];
                    $coordinators = $members->filter(fn ($m) => Str::contains($m->position, $leadershipKeywords, true));

                    // Drop a custom backdrop graphic at public/img/leader-bg.png to replace
                    // this fallback vignette (member photos should be transparent PNGs so
                    // the backdrop shows through around the head/shoulders).
                    $leaderBackdrop = file_exists(public_path('img/leader-bg.png'))
                        ? "background-image: url('" . asset('img/leader-bg.png') . "'); background-size: cover; background-position: center;"
                        : 'background: radial-gradient(ellipse at 50% 20%, #7d8697 0%, #3b4258 45%, #10152a 100%);';

                    // Fixed row grouping requested for the leadership grid: row 1 is the
                    // Ketua/Sekretaris pair, row 2 is the four Kepala Pusat, row 3 is the
                    // Kepala Bagian/Subbagian trio. Anyone not matching a listed position
                    // still shows up, appended in a trailing row, so nobody gets dropped.
                    $rowPositions = [
                        [
                            'Ketua Lembaga Transformasi Digital dan Kecerdasan Artifisial',
                            'Sekretaris Lembaga Transformasi Digital dan Kecerdasan Artifisial',
                        ],
                        [
                            'Kepala Pusat Kecerdasan Artifisial (Unhas AI Center)',
                            'Kepala Pusat Infrastruktur Digital',
                            'Kepala Pusat Data dan Sistem Informasi',
                            'Kepala Pusat Pembelajaran dan Pengembangan Talenta Digital',
                        ],
                        [
                            'Kepala Bagian Tata Usaha',
                            'Kepala Subbagian Infrastruktur Teknologi Informasi',
                            'Kepala Subbagian Integrasi Sistem Informasi',
                        ],
                    ];

                    $assigned = collect();
                    $rows = collect($rowPositions)->map(function ($positions) use ($coordinators, &$assigned) {
                        $row = collect($positions)
                            ->map(fn ($position) => $coordinators->first(fn ($m) => Str::contains($m->position, $position, true)))
                            ->filter();
                        $assigned = $assigned->merge($row);
                        return $row;
                    });

                    $leftover = $coordinators->reject(fn ($m) => $assigned->contains($m));
                    if ($leftover->isNotEmpty()) {
                        $rows->push($leftover);
                    }
                @endphp

                @foreach($rows as $row)
                    @continue($row->isEmpty())
                    <div class="flex flex-wrap justify-center gap-x-5 gap-y-10 sm:gap-x-6 sm:gap-y-12 {{ $loop->first ? '' : 'mt-10 sm:mt-12' }}">
                        @foreach($row as $coord)
                            @php
                                $coordData = [
                                    'image' => $this->memberImage($coord),
                                    'name' => $coord->fullname,
                                    'role' => $coord->position,
                                    'nip' => $coord->nip,
                                    'email' => $coord->email,
                                    'phone' => $coord->phone,
                                ];
                            @endphp
                            {{-- Pop-out card: the card panel starts lower than the wrapper so the
                                transparent-cutout photo's head/shoulders can overflow above it. --}}
                            <div class="relative aspect-[4/4.5] w-[calc(50%-0.625rem)] sm:w-[calc(33.3333%-1rem)] lg:w-[calc(25%-1.125rem)] cursor-pointer group"
                                @click="activeHotspot = {{ Illuminate\Support\Js::from($coordData) }}; showModal = true">

                                {{-- Card panel: full width of the card, static — no resize/scale effect on hover.
                                    Fixed height anchored to the bottom (not derived from a top offset), so it stays
                                    a constant size regardless of the wrapper's height. --}}
                                <div class="absolute inset-x-0 bottom-0 h-[230px] rounded-2xl overflow-hidden shadow-sm group-hover:shadow-2xl transition-shadow duration-500 z-0"
                                    style="{{ $leaderBackdrop }}">
                                </div>

                                {{-- Member photo: 84% of the card width, unclipped, positioned to overflow (pop out of) the
                                    panel above, behind the name. Height follows the photo's own aspect ratio (aspect-[3/4])
                                    instead of being stretched to the wrapper's full height, so no empty letterboxed gap
                                    appears above the photo. On hover its actual width grows to 90% of the card width. --}}
                                <img src="{{ $this->memberImage($coord) }}" alt="{{ $coord->fullname }}"
                                    class="absolute inset-x-[8%] bottom-0 w-[84%] aspect-[3/4] object-cover z-10 drop-shadow-2xl group-hover:inset-x-[5%] group-hover:w-[90%] transition-all duration-500">

                                {{-- Caption gradient + text overlay: sits above the photo so the name stays readable, full width, static. --}}
                                <div class="absolute inset-x-0 bottom-0 h-[230px] rounded-2xl overflow-hidden pointer-events-none z-20">
                                    <div class="absolute inset-x-0 bottom-0 h-1/2"
                                        style="background: linear-gradient(to top, #b91c1c 0%, rgba(33,51,105,.88) 40%, rgba(33,51,105,0) 100%);">
                                    </div>
                                    <div class="absolute inset-x-0 bottom-0 p-3 sm:p-4">
                                        <h3 class="text-white font-bold text-sm sm:text-base leading-tight drop-shadow-sm">{{ $coord->fullname }}</h3>
                                        <p class="text-white/90 font-semibold text-[11px] sm:text-xs mt-1">{{ $coord->position }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </section>

            <!-- Squad Grid Section -->
            <section>
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                    <h2 class="text-xl font-bold text-slate-800 flex items-center">
                        <span class="w-6 h-1 bg-[#213369] mr-3 rounded-full"></span>
                        Tim Transformasi Digital
                    </h2>
                    <div class="flex items-center overflow-x-auto pb-4 md:pb-0 no-scrollbar -mx-6 px-6 md:mx-0 md:px-0 gap-2">
                        @php
                            $squad = $members->reject(fn ($m) => Str::contains($m->position, $leadershipKeywords, true));
                            $positions = $squad->pluck('position')->unique();
                        @endphp
                        <button class="filter-btn active text-[10px] font-bold px-4 py-2 rounded-full transition-all uppercase tracking-wider whitespace-nowrap">Semua</button>
                        @foreach($positions as $pos)
                            <button class="filter-btn bg-white text-slate-500 text-[10px] font-bold px-4 py-2 rounded-full border border-slate-100 transition-all uppercase tracking-wider whitespace-nowrap">
                                {{ $pos }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5" id="memberGrid">
                    @foreach($squad as $member)
                        @php
                            $bgClass = 'bg-red-50';
                            $textClass = 'text-red-700';
                            $badgeClass = 'bg-red-100';

                            if (Str::contains($member->position, ['Jaringan', 'Infra', 'Network'], true)) {
                                $bgClass = 'bg-amber-50';
                                $textClass = 'text-amber-700';
                                $badgeClass = 'bg-amber-100';
                            } elseif (Str::contains($member->position, ['Security', 'Keamanan'], true)) {
                                $bgClass = 'bg-slate-900';
                                $textClass = 'text-white';
                                $badgeClass = 'bg-slate-800';
                            }
                        @endphp
                        <div class="group bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:border-red-200 transition-all cursor-pointer"
                            data-squad="{{ $member->position }}">
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
                                        {{ $member->position }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-4 pt-2 border-t border-slate-50">
                                <span class="text-[10px] font-semibold text-slate-400">{{ $member->nip ?? 'LTDKA UNHAS' }}</span>
                                <i class="fas fa-arrow-right text-red-700 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>

        {{-- Footer --}}
        @include('livewire.public.partials.public-footer')

        {{-- Pimpinan profile detail modal --}}
        @include('livewire.public.partials.profile-modal')
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
