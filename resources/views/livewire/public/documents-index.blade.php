<div>
    <div class="bg-white min-h-screen">
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header --}}
        <section class="relative pt-24 pb-12 overflow-hidden mesh-gradient">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-docs" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="black" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-docs)" />
                </svg>
            </div>
            <div class="container mx-auto px-6 relative z-10">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-red-500/20 border border-red-500/30 mb-4 backdrop-blur-xl">
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-white">Resource Center</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white tracking-tighter leading-tight">
                    Dokumen Publik & Panduan.
                </h1>
                <p class="max-w-2xl text-base text-slate-300/80 font-medium leading-relaxed mt-2">
                    Akses dan unduh dokumen resmi, panduan teknis, dan regulasi yang diterbitkan oleh DSITD Universitas Hasanuddin.
                </p>
            </div>
        </section>

        {{-- Filter Section --}}
        <section class="py-10 bg-slate-50 border-y border-slate-100">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="lg:col-span-2">
                        <label for="doc-search" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-3">Cari Dokumen</label>
                        <input
                            id="doc-search"
                            type="text"
                            wire:model.live.debounce.400ms="search"
                            placeholder="Cari judul atau deskripsi dokumen..."
                            class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-medium text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-300 transition"
                        >
                    </div>
                    <div>
                        <label for="doc-category" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-3">Kategori</label>
                        <select
                            id="doc-category"
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
                        Menampilkan {{ $documents->count() }} dari {{ $documents->total() }} dokumen
                    </p>
                </div>
            </div>
        </section>

        {{-- Documents List --}}
        <section class="py-16">
            <div class="container mx-auto px-6">
                @if($documents->isEmpty())
                    <div class="rounded-3xl border border-slate-100 bg-white p-16 text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Dokumen tidak ditemukan</h2>
                        <p class="mt-3 text-sm text-slate-500">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach($documents as $doc)
                            <div class="group bg-white border border-slate-100 p-7 rounded-[2rem] hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500 flex items-center justify-between">
                                <div class="flex items-center gap-5 min-w-0">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100 group-hover:bg-red-50 group-hover:border-red-100 transition-colors">
                                        <svg class="w-7 h-7 text-slate-400 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        @if($doc->category)
                                            <span class="text-[8px] font-bold text-red-600 uppercase tracking-widest">{{ $doc->category->name }}</span>
                                        @endif
                                        <h3 class="text-base font-bold text-slate-900 tracking-tight mt-0.5 truncate">{{ $doc->title }}</h3>
                                        @if($doc->description)
                                            <p class="text-xs text-slate-500 mt-1 line-clamp-1">{{ $doc->description }}</p>
                                        @endif
                                        <div class="flex items-center gap-3 mt-2">
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ strtoupper($doc->file_type ?? 'FILE') }}</span>
                                            <div class="w-1 h-1 bg-slate-200 rounded-full"></div>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                {{ $doc->file_size ? number_format($doc->file_size / 1024, 1) . ' KB' : '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $doc->file_path) }}"
                                   download
                                   class="ml-4 w-12 h-12 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-300 shrink-0 group-hover:scale-110">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-12">
                        {{ $documents->links() }}
                    </div>
                @endif
            </div>
        </section>

        @include('livewire.public.partials.public-footer')
    </div>
</div>
