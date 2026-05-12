<div>
    <div class="bg-white min-h-screen flex flex-col">
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header --}}
        <section class="relative pt-24 pb-8 overflow-hidden mesh-gradient">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-news-show" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="black" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-news-show)" />
                </svg>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col gap-3">
                    @if($news->category)
                        <span class="inline-flex w-fit px-3 py-1 rounded-full bg-red-500/20 border border-red-400/40 text-[9px] font-black text-white uppercase tracking-widest">
                            {{ $news->category->name }}
                        </span>
                    @endif

                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-white tracking-tighter leading-tight max-w-4xl">
                        {{ $news->title }}
                    </h1>

                    <div class="flex items-center gap-4 mt-1">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-white/10 flex items-center justify-center border border-white/20">
                                <svg class="w-3.5 h-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">{{ $news->author->name ?? 'Admin' }}</span>
                        </div>
                        <div class="w-1 h-1 bg-red-500 rounded-full"></div>
                        <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">
                            {{ $news->published_at?->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </section>

        {{-- Content --}}
        <section class="py-5 sm:py-12 flex-grow flex flex-col">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col flex-grow">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 flex-grow">
                    <article class="lg:col-span-8 flex flex-col">
                        @if($news->cover_image)
                            <div class="rounded-xl sm:rounded-[2rem] overflow-hidden mb-4 sm:mb-8 shadow-2xl shadow-slate-200/50">
                                <img src="{{ asset('storage/' . $news->cover_image) }}" alt="{{ $news->title }}" class="w-full object-cover">
                            </div>
                        @endif

                        <div class="prose prose-lg prose-slate max-w-none prose-headings:font-black prose-headings:tracking-tight prose-p:text-slate-600 prose-p:leading-relaxed prose-img:rounded-3xl">
                            {!! $news->content !!}
                        </div>

                        <div class="mt-6 sm:mt-10 pt-4 sm:pt-6 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('news.index') }}" wire:navigate class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 hover:text-red-600 transition-colors uppercase tracking-widest">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 16l-4-4m0 0l4-4m-4 4h18" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                                Kembali ke Warta
                            </a>

                            <div class="flex items-center gap-3">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bagikan:</span>
                                <div class="flex gap-2">
                                    <button class="w-8 h-8 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-slate-900 hover:text-white transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></button>
                                    <button class="w-8 h-8 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-[#1877F2] hover:text-white transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></button>
                                </div>
                            </div>
                        </div>
                    </article>

                    <aside class="lg:col-span-4 flex flex-col gap-6">
                        {{-- Meta Info Card --}}
                        <div class="rounded-[1.5rem] border border-slate-100 bg-slate-50 p-6">
                            <h3 class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-5 pb-2 border-b border-slate-200">Informasi Publikasi</h3>

                            <div class="space-y-5">
                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-white flex items-center justify-center border border-slate-100 text-slate-400 shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <span class="block text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Tanggal Terbit</span>
                                        <span class="text-xs font-bold text-slate-700">{{ $news->published_at?->format('l, d F Y') }}</span>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-white flex items-center justify-center border border-slate-100 text-slate-400 shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </div>
                                    <div>
                                        <span class="block text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Dilihat</span>
                                        <span class="text-xs font-bold text-slate-700">{{ number_format($news->views_count ?? 0) }} Kali</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Newsletter / Stay Updated --}}
                        <div class="rounded-[1.5rem] bg-slate-900 p-6 text-white relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-red-600/20 filter blur-3xl -mr-16 -mt-16 group-hover:bg-red-600/30 transition-all"></div>
                            <h3 class="text-base font-black tracking-tight mb-3 relative z-10">Tetap Terhubung</h3>
                            <p class="text-xs text-slate-400 leading-relaxed mb-6 relative z-10">Dapatkan informasi terbaru seputar transformasi digital di Unhas langsung ke unit kerja Anda.</p>
                            <a href="mailto:it@unhas.ac.id" class="inline-flex w-full items-center justify-center py-3 bg-white text-slate-900 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-red-600 hover:text-white transition-all relative z-10">Hubungi Kami</a>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        @include('livewire.public.partials.public-footer')
    </div>
</div>
