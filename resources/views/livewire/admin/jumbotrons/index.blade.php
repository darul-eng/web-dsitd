<div class="space-y-6 font-inter">
    <!-- Header -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">Jumbotron & Slider Manager</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Kelola banner halaman utama</p>
        </div>
        <button wire:click="create" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition-all shadow-md shadow-red-600/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Tambah Banner</span>
        </button>
    </div>

    @if($showForm)
    <!-- Form Panel -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-red-600"></div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-sm font-bold text-slate-800 uppercase tracking-widest">{{ $editingId ? 'Edit' : 'Tambah' }} Banner</h2>
            <button wire:click="$set('showForm', false)" class="text-slate-400 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form wire:submit="save" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-5">
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Judul Banner</label>
                    <input wire:model="title" type="text" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-red-500/5 focus:border-red-500 transition-all outline-none" placeholder="Masukkan judul menarik...">
                    @error('title') <p class="text-[10px] font-bold text-rose-500 mt-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Deskripsi / Subtitle</label>
                    <textarea wire:model="description" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-red-500/5 focus:border-red-500 transition-all outline-none min-h-[100px]" placeholder="Penjelasan singkat..."></textarea>
                    @error('description') <p class="text-[10px] font-bold text-rose-500 mt-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Urutan</label>
                        <input wire:model="order" type="number" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-red-500/5 focus:border-red-500 transition-all outline-none">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Link URL (Opsional)</label>
                        <input wire:model="link_url" type="text" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-red-500/5 focus:border-red-500 transition-all outline-none" placeholder="https://...">
                    </div>
                </div>

                <div class="flex items-center gap-3 py-2">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="is_active" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                    </label>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-tight">Status Aktif</span>
                </div>
            </div>

            <div class="space-y-5">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Upload Visual Banner</label>
                <div class="relative aspect-video rounded-2xl overflow-hidden bg-slate-100 border-2 border-dashed border-slate-200 group transition-all hover:border-red-300 flex items-center justify-center">
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover">
                    @elseif ($editingId)
                        @php $current = \App\Models\Jumbotron::find($editingId); @endphp
                        <img src="{{ asset('storage/' . $current->image_path) }}" class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="text-center p-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300 mx-auto mb-3"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter italic">Klik atau Seret Gambar ke Sini</p>
                        </div>
                    @endif
                    <input type="file" wire:model="image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                        <span class="px-4 py-2 bg-white/20 backdrop-blur-md text-white text-[10px] font-bold rounded-xl border border-white/20 uppercase tracking-widest">Ganti Visual</span>
                    </div>
                </div>
                @error('image') <p class="text-[10px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
                
                <div class="flex items-center justify-end gap-3 pt-6">
                    <button type="button" wire:click="$set('showForm', false)" class="px-6 py-2.5 text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors uppercase">Batal</button>
                    <button type="submit" class="px-8 py-2.5 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-black transition-all shadow-lg shadow-slate-900/20 uppercase tracking-widest">
                        <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                        <span wire:loading wire:target="save" class="flex items-center gap-2">
                            <svg class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Memproses...
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    @endif

    <!-- Banner Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($items as $item)
        <div class="group bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
            <div class="relative aspect-[16/9] overflow-hidden">
                <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-60"></div>
                
                <!-- Status Badge -->
                <div class="absolute top-4 left-4">
                    <button wire:click="toggleActive({{ $item->id }})" class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $item->is_active ? 'bg-green-500/20 text-green-400 border-green-500/30' : 'bg-slate-500/20 text-slate-400 border-slate-500/30' }} backdrop-blur-md">
                        {{ $item->is_active ? 'Active' : 'Hidden' }}
                    </button>
                </div>

                <!-- Order Badge -->
                <div class="absolute top-4 right-4 w-7 h-7 rounded-lg bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-[11px] font-black text-white">
                    #{{ $item->order }}
                </div>
            </div>

            <div class="p-5">
                <h3 class="font-bold text-slate-800 text-sm mb-1 truncate leading-tight transition-colors group-hover:text-red-600">{{ $item->title }}</h3>
                <p class="text-[11px] text-slate-400 font-medium line-clamp-2 min-h-[32px] mb-4 italic tracking-tight">{{ $item->description ?: 'Tidak ada deskripsi.' }}</p>
                
                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                    <span class="text-[9px] font-bold text-slate-300 uppercase tracking-widest tabular-nums">{{ $item->created_at->format('M d, Y') }}</span>
                    <div class="flex items-center gap-1.5 font-bold">
                        <button wire:click="edit({{ $item->id }})" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </button>
                        <button x-on:click="Swal.fire({
                                    title: 'Hapus Banner?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3857b2',
                                    confirmButtonText: 'Hapus'
                                }).then((r) => r.isConfirmed && $wire.delete({{ $item->id }}))"
                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center bg-white border border-slate-200 border-dashed rounded-3xl">
            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
            </div>
            <p class="text-sm font-bold text-slate-400 tracking-tight uppercase">Belum ada banner terpasang</p>
        </div>
        @endforelse
    </div>
</div>
