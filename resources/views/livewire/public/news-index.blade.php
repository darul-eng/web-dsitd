<div>
    <div class="bg-white min-h-screen">
        @include('livewire.public.partials.profile-navbar', ['forceLight' => true])

        {{-- Filter Section --}}
        <section class="pt-20 pb-4 sm:pt-24 sm:pb-8 bg-white border-b border-slate-100">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">
                    <a href="{{ route('home') }}" wire:navigate class="hover:text-red-600 transition-colors">Home</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-slate-700">Warta</span>
                </nav>
                <div class="flex items-center justify-between gap-4 mb-4 sm:mb-6">
                    <h1 class="text-lg sm:text-2xl md:text-3xl font-black text-slate-900 tracking-tighter">
                        Warta Transformasi <span class="text-red-600">Digital.</span>
                    </h1>
                    <div class="hidden sm:block text-right shrink-0">
                        <div class="text-2xl font-black text-slate-900 tracking-tighter leading-none">{{ $news->total() }}</div>
                        <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Artikel Tersedia</div>
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
                            placeholder="Cari judul atau isi berita..."
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 pl-10 lg:pl-11 pr-4 py-2.5 sm:py-3.5 text-xs sm:text-sm font-medium text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-300 focus:bg-white transition">
                    </div>

                    {{-- Search Icon Button (Mobile only) --}}
                    <button @click="searchOpen = true" 
                            type="button"
                            class="lg:hidden shrink-0 flex items-center justify-center w-[40px] h-[40px] sm:w-[46px] sm:h-[46px] rounded-2xl border border-slate-200 bg-slate-50 text-slate-500 hover:bg-slate-100 transition"
                            :class="searchOpen ? 'hidden' : 'flex'">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>

                    {{-- Category Select --}}
                    <div class="lg:w-1/3 lg:block"
                         :class="searchOpen ? 'hidden' : 'flex-grow block'">
                        <select wire:model.live="category"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2.5 sm:py-3.5 text-xs sm:text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-300 focus:bg-white transition">
                            <option value="all">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-3 sm:mt-5 flex items-center gap-3">
                    <span class="w-2 h-2 bg-red-600 rounded-full shrink-0"></span>
                    <p class="text-sm font-semibold text-slate-600">
                        Menampilkan <span class="font-black text-red-600">{{ $news->count() }}</span> dari <span class="font-black text-slate-900">{{ $news->total() }}</span> berita
                    </p>
                </div>
            </div>
        </section>

        {{-- News Grid --}}
        <section class="py-5 sm:py-12 bg-slate-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                @if($news->isEmpty())
                    <div class="rounded-3xl border border-slate-100 bg-white p-12 text-center">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">Berita tidak ditemukan</h2>
                        <p class="mt-2 text-sm text-slate-500">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-5">
                        @foreach($news as $item)
                            <article class="group flex flex-col bg-white rounded-[1.5rem] border border-slate-100 overflow-hidden hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-300">
                                <div class="relative aspect-video overflow-hidden">
                                    @if($item->cover_image)
                                        <img src="{{ asset('storage/' . $item->cover_image) }}" alt="{{ $item->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                    @if($item->category)
                                        <div class="absolute top-3 left-3">
                                            <span class="px-3 py-1 bg-white/90 backdrop-blur text-[9px] font-black text-slate-900 rounded-full uppercase tracking-widest">{{ $item->category->name }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-3 sm:p-5 flex flex-col flex-grow">
                                    <div class="flex items-center gap-3 mb-3">
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $item->published_at?->format('d M Y') }}</span>
                                        <div class="w-1 h-1 bg-red-600 rounded-full"></div>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $item->author?->name ?? 'Admin' }}</span>
                                    </div>
                                    <h3 class="text-base font-black text-slate-900 tracking-tight group-hover:text-red-600 transition-colors leading-tight mb-2 flex-grow">{{ $item->title }}</h3>
                                    <p class="text-xs text-slate-500 font-medium leading-relaxed mb-4">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                                    <a href="{{ route('news.show', $item->slug) }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-900 uppercase tracking-widest hover:text-red-600 transition-colors mt-auto">
                                        Baca Selengkapnya
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="mt-4 sm:mt-8">{{ $news->links() }}</div>
                @endif
            </div>
        </section>

        @include('livewire.public.partials.public-footer')
    </div>
</div>
