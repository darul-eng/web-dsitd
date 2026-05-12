<div>
    <div class="bg-white min-h-screen">
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header --}}
        <section class="relative pt-24 pb-12 overflow-hidden mesh-gradient">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-warta" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="black" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-warta)" />
                </svg>
            </div>
            <div class="container mx-auto px-6 relative z-10">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-red-500/20 border border-red-500/30 mb-4 backdrop-blur-xl">
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-white">Warta & Berita</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white tracking-tighter leading-tight">
                    Warta Transformasi Digital.
                </h1>
                <p class="max-w-2xl text-base text-slate-300/80 font-medium leading-relaxed mt-2">
                    Informasi terkini seputar perkembangan, kegiatan, dan inovasi teknologi di lingkungan Universitas Hasanuddin.
                </p>
            </div>
        </section>

        {{-- Filter Section --}}
        <section class="py-10 bg-slate-50 border-y border-slate-100">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="lg:col-span-2">
                        <label for="news-search" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-3">Cari Warta</label>
                        <input
                            id="news-search"
                            type="text"
                            wire:model.live.debounce.400ms="search"
                            placeholder="Cari judul atau isi berita..."
                            class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-medium text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-300 transition"
                        >
                    </div>
                    <div>
                        <label for="news-category" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-3">Kategori</label>
                        <select
                            id="news-category"
                            wire:model.live="category"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-300 transition"
                        >
                            <option value="all">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-between gap-4">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">
                        Menampilkan {{ $news->count() }} dari {{ $news->total() }} berita
                    </p>
                </div>
            </div>
        </section>

        {{-- News Grid --}}
        <section class="py-16">
            <div class="container mx-auto px-6">
                @if($news->isEmpty())
                    <div class="rounded-3xl border border-slate-100 bg-white p-16 text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Berita tidak ditemukan</h2>
                        <p class="mt-3 text-sm text-slate-500">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        @foreach($news as $item)
                            <article class="group flex flex-col">
                                <div class="relative aspect-video rounded-3xl overflow-hidden mb-5">
                                    @if($item->cover_image)
                                        <img src="{{ asset('storage/' . $item->cover_image) }}"
                                             alt="{{ $item->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                             loading="lazy">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                    @if($item->category)
                                        <div class="absolute top-4 left-4">
                                            <span class="px-3 py-1 bg-white/90 backdrop-blur text-[9px] font-black text-slate-900 rounded-full uppercase tracking-widest">{{ $item->category->name }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-3 mb-3">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                        {{ $item->published_at?->format('d M Y') }}
                                    </span>
                                    <div class="w-1 h-1 bg-red-600 rounded-full"></div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                        {{ $item->author?->name ?? 'Admin' }}
                                    </span>
                                </div>

                                <h3 class="text-xl font-black text-slate-900 tracking-tight group-hover:text-red-600 transition-colors leading-tight mb-3 flex-grow">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-xs text-slate-500 font-medium leading-relaxed mb-5">
                                    {{ Str::limit(strip_tags($item->content), 120) }}
                                </p>

                                <a href="{{ route('news.show', $item->slug) }}"
                                   class="inline-flex items-center gap-2 text-[10px] font-black text-slate-900 uppercase tracking-widest hover:text-red-600 transition-colors mt-auto">
                                    Baca Selengkapnya
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                                </a>
                            </article>
                        @endforeach
                    </div>
                    <div class="mt-12">
                        {{ $news->links() }}
                    </div>
                @endif
            </div>
        </section>

        @include('livewire.public.partials.public-footer')
    </div>
</div>
