<div>
    <div class="bg-white min-h-screen">
        @include('livewire.public.partials.profile-navbar', ['forceLight' => true])

        {{-- Filter Section --}}
        <section class="pt-24 pb-4 sm:pt-28 sm:pb-8 bg-white border-b border-slate-100">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">
                    <a href="{{ route('home') }}" wire:navigate class="hover:text-red-600 transition-colors">Home</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-slate-700">Layanan</span>
                </nav>
                <div class="flex items-center justify-between gap-4 mb-4 sm:mb-6">
                    <h1 class="text-lg sm:text-2xl md:text-3xl font-black text-slate-900 tracking-tighter">
                        Semua Layanan <span class="text-red-600">Digital.</span>
                    </h1>
                    <div class="hidden sm:block text-right shrink-0">
                        <div class="text-2xl font-black text-slate-900 tracking-tighter leading-none">{{ $services->total() }}</div>
                        <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Layanan Aktif</div>
                    </div>
                </div>
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
