<div>
    <div class="bg-white min-h-screen">
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header --}}
        <section class="relative pt-20 sm:pt-24 pb-6 sm:pb-14 overflow-hidden mesh-gradient">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-docs" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-docs)" />
                </svg>
            </div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-slate-50 to-transparent pointer-events-none z-10"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">
                    <div class="flex-1">
                        <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 sm:mb-6">
                            <a href="{{ route('home') }}" wire:navigate class="hover:text-white transition-colors">Home</a>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <span class="text-white">Dokumen</span>
                        </nav>
                        <h1 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white tracking-tighter leading-tight sm:leading-[0.95] mb-2 sm:mb-4">
                            Dokumen Publik<br/>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-rose-400 to-orange-400">& Panduan.</span>
                        </h1>
                        <p class="max-w-xl text-xs sm:text-sm lg:text-base text-slate-300/80 font-medium leading-relaxed">
                            Akses dan unduh dokumen resmi, panduan teknis, dan regulasi yang diterbitkan oleh TransDiKA Universitas Hasanuddin.
                        </p>
                    </div>
                    <div class="hidden lg:flex flex-col items-end gap-4">
                        <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-6 text-right min-w-[120px] sm:min-w-[160px]">
                            <div class="text-3xl sm:text-4xl font-black text-white tracking-tighter leading-none">{{ $documents->total() }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Dokumen Tersedia</div>
                        </div>
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
                            placeholder="Cari judul atau deskripsi dokumen..."
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
                        Menampilkan <span class="font-black text-red-600">{{ $documents->count() }}</span> dari <span class="font-black text-slate-900">{{ $documents->total() }}</span> dokumen
                    </p>
                </div>
            </div>
        </section>

        {{-- Documents List --}}
        <section class="py-5 sm:py-12 bg-slate-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                @if($documents->isEmpty())
                    <div class="rounded-3xl border border-slate-100 bg-white p-12 text-center">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">Dokumen tidak ditemukan</h2>
                        <p class="mt-2 text-sm text-slate-500">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 sm:gap-4">
                        @foreach($documents as $doc)
                            <div class="group bg-white border border-slate-100 p-3 sm:p-5 rounded-xl sm:rounded-[1.5rem] hover:shadow-xl hover:shadow-slate-200/50 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-between">
                                <div class="flex items-center gap-4 min-w-0">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100 group-hover:bg-red-50 group-hover:border-red-100 transition-colors">
                                        <svg class="w-6 h-6 text-slate-400 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    </div>
                                    <div class="min-w-0">
                                        @if($doc->category)
                                            <span class="text-[8px] font-bold text-red-600 uppercase tracking-widest">{{ $doc->category->name }}</span>
                                        @endif
                                        <h3 class="text-sm font-bold text-slate-900 tracking-tight mt-0.5 truncate">{{ $doc->title }}</h3>
                                        @if($doc->description)
                                            <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $doc->description }}</p>
                                        @endif
                                        <div class="flex items-center gap-3 mt-1.5">
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ strtoupper($doc->file_type ?? 'FILE') }}</span>
                                            <div class="w-1 h-1 bg-slate-200 rounded-full"></div>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $doc->file_size ? number_format($doc->file_size / 1024, 1) . ' KB' : '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $doc->file_path) }}" download
                                   class="ml-3 w-11 h-11 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-300 shrink-0 group-hover:scale-110">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 sm:mt-8">{{ $documents->links() }}</div>
                @endif
            </div>
        </section>

        @include('livewire.public.partials.public-footer')
    </div>
</div>
