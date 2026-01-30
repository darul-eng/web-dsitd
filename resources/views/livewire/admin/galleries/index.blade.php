<div class="space-y-6 font-inter">
    <!-- Header -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">Galeri Foto & Multimedia</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Kelola album kegiatan dan dokumentasi</p>
        </div>
        <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition-all shadow-md shadow-red-600/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Buat Album Baru</span>
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
        <div class="relative max-w-md">
            <input wire:model.live="search" type="text" placeholder="Cari album..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold outline-none focus:border-red-500">
            <div class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($galleries as $gallery)
        <div class="group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden relative">
            <!-- Cover Image -->
            <div class="aspect-video overflow-hidden bg-slate-100 relative">
                @if($gallery->cover_image)
                    <img src="{{ asset('storage/' . $gallery->cover_image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-200 bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    </div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                
                <!-- Badge -->
                <div class="absolute top-4 left-4 flex gap-2">
                    <span class="px-3 py-1 bg-red-600 text-[9px] font-black text-white uppercase tracking-widest rounded-full shadow-lg">
                        {{ $gallery->category->name ?? 'Uncategorized' }}
                    </span>
                    @if(!$gallery->is_published)
                        <span class="px-3 py-1 bg-slate-900 text-[9px] font-black text-white uppercase tracking-widest rounded-full shadow-lg">
                            Draft
                        </span>
                    @endif
                </div>

                <!-- Photos Count -->
                <div class="absolute bottom-4 left-4 flex items-center gap-1.5 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span class="text-[10px] font-black uppercase tracking-widest">{{ $gallery->images_count ?? $gallery->images()->count() }} Foto</span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <h3 class="text-sm font-extrabold text-slate-800 leading-snug group-hover:text-red-600 transition-colors uppercase tracking-tight line-clamp-2 min-h-[2.8rem]">
                    {{ $gallery->title }}
                </h3>
                
                <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-5">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $gallery->created_at->format('d M Y') }}</span>
                    </div>

                    <div class="flex items-center gap-1">
                        <a href="{{ route('admin.galleries.edit', $gallery->uuid) }}" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>
                        <button wire:click="toggleStatus('{{ $gallery->uuid }}')" class="p-2 {{ $gallery->is_published ? 'text-green-500 hover:bg-green-50' : 'text-slate-300 hover:bg-slate-50' }} rounded-xl transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                        <button x-on:click="Swal.fire({
                                    title: 'Hapus Album?',
                                    text: 'Semua foto di dalamnya akan terhapus juga.',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#e11d48',
                                    confirmButtonText: 'Ya, Hapus'
                                }).then((r) => r.isConfirmed && $wire.delete('{{ $gallery->uuid }}'))"
                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="col-span-full py-20 text-center bg-white border-2 border-dashed border-slate-100 rounded-3xl">
                <p class="text-sm font-bold text-slate-300 italic uppercase tracking-widest">Belum ada album dokumentasi...</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pt-6">
        {{ $galleries->links() }}
    </div>
</div>
