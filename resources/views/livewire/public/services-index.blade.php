<div>
    <div class="bg-white min-h-screen">
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header --}}
        <section class="relative pt-20 sm:pt-24 pb-6 sm:pb-14 overflow-hidden mesh-gradient">
            {{-- BG Grid Pattern --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-services" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-services)" />
                </svg>
            </div>
            {{-- Decorative glow --}}
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
            {{-- Bottom gradient fade --}}
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-slate-50 to-transparent pointer-events-none z-10"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">

                    {{-- Left: Content --}}
                    <div class="flex-1">
                        {{-- Breadcrumb --}}
                        <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 sm:mb-6">
                            <a href="{{ route('home') }}" wire:navigate class="hover:text-white transition-colors">Home</a>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <span class="text-white">Layanan</span>
                        </nav>

                        {{-- Badge --}}

                        {{-- H1 --}}
                        <h1 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white tracking-tighter leading-tight sm:leading-[0.95] mb-2 sm:mb-4">
                            Semua Layanan<br/>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-rose-400 to-orange-400">Digital.</span>
                        </h1>

                        {{-- Subtitle --}}
                        <p class="max-w-xl text-xs sm:text-sm lg:text-base text-slate-300/80 font-medium leading-relaxed">
                            Temukan layanan teknologi informasi yang tersedia untuk sivitas akademika Universitas Hasanuddin.
                        </p>
                    </div>

                    {{-- Right: Decorative Stats --}}
                    <div class="hidden lg:flex flex-col items-end gap-4">
                        {{-- Count card --}}
                        <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-6 text-right min-w-[120px] sm:min-w-[160px]">
                            <div class="text-3xl sm:text-4xl font-black text-white tracking-tighter leading-none">{{ $services->total() }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Layanan Aktif</div>
                        </div>

                </div>
            </div>
        </section>

        {{-- Filter Section --}}
        <section class="py-4 sm:py-8 bg-white border-y border-slate-100">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div x-data="{ searchOpen: false }" class="flex items-center gap-2 sm:gap-5 w-full">
                    {{-- Search Input (Expanded Mobile & Desktop) --}}
                    <div class="relative lg:w-2/3 lg:block transition-all duration-300"
                         :class="searchOpen ? 'w-full block' : 'hidden'">
                        <button @click="searchOpen = false; $wire.set('search', '')" class="absolute left-2 top-1/2 -translate-y-1/2 p-2 text-slate-400 hover:text-red-500 lg:hidden">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        
                        <input type="text" wire:model.live.debounce.400ms="search"
                            placeholder="Contoh: VPN, email, hosting..."
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 pl-10 lg:pl-11 pr-4 py-2.5 sm:py-3.5 text-xs sm:text-sm font-medium text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-300 focus:bg-white transition">
                    </div>

                    {{-- Search Icon Button (Mobile only) --}}
                    <button @click="searchOpen = true" 
                            type="button"
                            class="lg:hidden shrink-0 items-center justify-center w-[40px] h-[40px] sm:w-[46px] sm:h-[46px] rounded-2xl border border-slate-200 bg-slate-50 text-slate-500 hover:bg-slate-100 transition"
                            :class="searchOpen ? 'hidden' : 'flex'">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>

                    {{-- Category Select --}}
                    <div class="lg:w-1/3 lg:block"
                         :class="searchOpen ? 'hidden' : 'flex-grow block'">
                        <select wire:model.live="category"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2.5 sm:py-3.5 text-xs sm:text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-300 focus:bg-white transition">
                            <option value="all">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2 sm:mt-5 flex items-center justify-between gap-3 flex-wrap">
                    <div class="flex items-center gap-3">
                        <span class="w-2 h-2 bg-red-600 rounded-full shrink-0"></span>
                        <p class="text-sm font-semibold text-slate-600">
                            Menampilkan <span class="font-black text-red-600">{{ $services->count() }}</span> dari <span class="font-black text-slate-900">{{ $services->total() }}</span> layanan
                        </p>
                    </div>
                    <a href="https://helpdesk.unhas.ac.id/" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs font-black text-slate-700 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition-colors uppercase tracking-widest">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Butuh Bantuan?
                    </a>
                </div>
            </div>
        </section>

        {{-- Services Grid --}}
        <section class="py-5 sm:py-12 bg-slate-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                @if($services->isEmpty())
                    <div class="rounded-3xl border border-slate-100 bg-white p-12 text-center">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">Layanan tidak ditemukan</h2>
                        <p class="mt-2 text-sm text-slate-500">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-5">
                        @foreach($services as $service)
                            <article class="group rounded-xl sm:rounded-[1.5rem] border border-slate-100 bg-white p-4 sm:p-6 hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-300 h-full flex flex-col">
                                @if($service->category)
                                    <span class="inline-flex w-fit px-3 py-1 rounded-full bg-red-50 text-red-600 text-[9px] font-black uppercase tracking-widest mb-3">
                                        {{ $service->category->name }}
                                    </span>
                                @endif
                                <h3 class="text-xl font-black text-slate-900 tracking-tight leading-tight">{{ $service->title }}</h3>
                                <p class="mt-3 text-sm text-slate-500 font-medium leading-relaxed flex-grow">
                                    {{ Str::limit(strip_tags($service->content), 160) }}
                                </p>
                                <div class="mt-6 flex items-center justify-between border-t border-slate-50 pt-4">
                                    <a href="{{ route('services.show', $service->slug) }}" wire:navigate class="inline-flex items-center gap-2 text-[10px] font-black text-slate-900 uppercase tracking-widest group-hover:text-red-600 transition-colors">
                                        Detail Layanan
                                        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                                    </a>
                                    @if($service->external_link)
                                        <a href="{{ $service->external_link }}" target="_blank" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-red-600 transition-colors">Kunjungi ↗</a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="mt-4 sm:mt-8">{{ $services->links() }}</div>
                @endif
            </div>
        </section>

        @include('livewire.public.partials.public-footer')
    </div>
</div>
