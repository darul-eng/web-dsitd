<div class="space-y-6 font-inter">
    <!-- Header -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">Tautan Terkait</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Kelola link eksternal & internal</p>
        </div>
        <button wire:click="create" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition-all shadow-md shadow-red-600/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Tambah Tautan</span>
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- List Section (Left) -->
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden text-[11px] font-bold">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 text-slate-400 uppercase tracking-widest border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-3">Nama Tautan</th>
                            <th class="px-5 py-3 text-center">Kategori</th>
                            <th class="px-5 py-3 text-center">Order</th>
                            <th class="px-5 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($links as $link)
                        <tr class="hover:bg-slate-50/50 transition-all group">
                            <td class="px-5 py-3">
                                <div class="flex flex-col">
                                    <span class="text-slate-800 font-extrabold group-hover:text-red-600 transition-colors uppercase tracking-tight">{{ $link->title }}</span>
                                    <a href="{{ $link->url }}" target="_blank" class="text-[10px] text-slate-400 hover:text-red-500 transition-colors truncate max-w-[200px]">{{ $link->url }}</a>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-center">
                                <span class="inline-flex items-center px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md text-[9px] uppercase tracking-widest border border-slate-200">{{ $link->category }}</span>
                            </td>
                            <td class="px-5 py-3 text-center">
                                <span class="text-slate-500 tabular-nums">#{{ $link->order }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <button wire:click="edit({{ $link->id }})" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button x-on:click="Swal.fire({
                                                title: 'Hapus Tautan?',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3857b2',
                                                confirmButtonText: 'Hapus'
                                            }).then((r) => r.isConfirmed && $wire.delete({{ $link->id }}))"
                                            class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <p class="text-[10px] font-bold text-slate-300 tracking-[0.2em] italic uppercase">Belum ada tautan terdaftar</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form Section (Right) -->
        <div class="space-y-4">
            @if($showForm)
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-red-600"></div>
                <h2 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 italic">{{ $editingId ? 'Edit Tautan' : 'Tambah Tautan Baru' }}</h2>
                
                <form wire:submit="save" class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Judul Tautan</label>
                        <input wire:model="title" type="text" class="w-full px-3 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg focus:border-red-500 transition-all outline-none" placeholder="Mis: Website Unhas">
                        @error('title') <p class="text-[10px] text-rose-500 italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">URL Tujuan</label>
                        <input wire:model="url" type="text" class="w-full px-3 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg focus:border-red-500 transition-all outline-none" placeholder="https://unhas.ac.id">
                        @error('url') <p class="text-[10px] text-rose-500 italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Kategori</label>
                            <select wire:model="category" class="w-full px-3 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg outline-none">
                                <option value="external">External</option>
                                <option value="internal">Internal</option>
                                <option value="footer">Footer Only</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Urutan</label>
                            <input wire:model="order" type="number" class="w-full px-3 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg outline-none">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4">
                        <button type="button" wire:click="$set('showForm', false)" class="text-[10px] font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase">Batal</button>
                        <button type="submit" class="px-6 py-2 bg-slate-900 hover:bg-black text-white text-[10px] font-bold rounded-lg transition-all shadow-md shadow-slate-900/10 uppercase tracking-widest">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save" class="flex items-center gap-2">
                                <svg class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                ...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            @else
            <div class="bg-slate-50 p-6 rounded-2xl border border-dashed border-slate-200 flex flex-col items-center justify-center text-center">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                </div>
                <p class="text-[10px] font-bold text-slate-400 tracking-wider">Pilih tautan untuk mengedit atau tambah baru.</p>
            </div>
            @endif
        </div>
    </div>
</div>
