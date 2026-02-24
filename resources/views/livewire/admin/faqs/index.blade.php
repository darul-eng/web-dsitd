<div class="space-y-6 font-inter">
    <!-- Header -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">Tanya Jawab (FAQ)</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Kelola pertanyaan umum dan panduan</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition-all shadow-md shadow-red-600/20 uppercase tracking-widest">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Tambah FAQ</span>
        </a>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col md:flex-row gap-4">
        <div class="relative flex-grow">
            <input wire:model.live="search" type="text" placeholder="Cari pertanyaan atau jawaban..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold outline-none focus:border-red-500 transition-all">
            <div class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
        </div>
        <select wire:model.live="category" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold outline-none cursor-pointer transition-all">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- FAQ List -->
    <div class="space-y-4">
        @php $currentCat = null; @endphp
        @forelse($faqs as $faq)
            @if($currentCat != $faq->category->name)
                @php $currentCat = $faq->category->name; @endphp
                <div class="pt-4 pb-2">
                    <h2 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-l-4 border-red-500 pl-3 leading-none">{{ $currentCat }}</h2>
                </div>
            @endif

            <div class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all overflow-hidden">
                <div class="p-5 flex items-start gap-4">
                    <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center shrink-0 border border-red-100 font-black text-xs">Q</div>
                    <div class="flex-grow">
                        <div class="flex items-center justify-between gap-4">
                            <h3 class="text-sm font-extrabold text-slate-800 leading-snug">{{ $faq->question }}</h3>
                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="p-1.5 text-slate-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <button x-on:click="Swal.fire({
                                            title: 'Hapus FAQ?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#e11d48',
                                            confirmButtonText: 'Hapus'
                                        }).then((r) => r.isConfirmed && $wire.delete({{ $faq->id }}))"
                                        class="p-1.5 text-slate-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-3 p-4 bg-slate-50 rounded-xl border border-slate-100 relative">
                            <div class="absolute -top-2 left-4 w-4 h-4 bg-slate-50 border-t border-l border-slate-100 rotate-45"></div>
                            <div class="text-xs text-slate-500 font-medium leading-relaxed prose prose-slate max-w-none">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-3">
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest bg-white border border-slate-100 px-2 py-0.5 rounded">Order #{{ $faq->order }}</span>
                            @if(!$faq->is_published)
                                <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest bg-rose-50 px-2 py-0.5 rounded">Draft</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 text-center italic text-slate-300 font-bold bg-white rounded-3xl border-2 border-dashed border-slate-100">
                Belum ada pertanyaan sering ditanyakan...
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pt-4">
        {{ $faqs->links() }}
    </div>
</div>
