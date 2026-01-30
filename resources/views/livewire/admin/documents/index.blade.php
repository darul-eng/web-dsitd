<div class="space-y-6 font-inter">
    <!-- Header -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">Pusat Dokumen & Unduhan</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Kelola file publik dan formulir</p>
        </div>
        <div class="flex items-center gap-2">
            @if($showForm)
                <button wire:click="$set('showForm', false)" class="px-4 py-2 text-[11px] font-bold text-slate-500 hover:text-slate-900 bg-white border border-slate-200 rounded-full transition-all hover:bg-slate-50 uppercase tracking-tight">
                    Batal
                </button>
                <button type="submit" form="document-form" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-full transition-all shadow-md shadow-red-600/20 uppercase tracking-widest">
                    <span wire:loading.remove wire:target="save">Unggah Dokumen</span>
                    <span wire:loading wire:target="save" class="flex items-center gap-2">
                        <svg class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        ...
                    </span>
                </button>
            @else
                <button wire:click="create" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition-all shadow-md shadow-red-600/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    <span>Unggah Dokumen</span>
                </button>
            @endif
        </div>
    </div>

    @if($showForm)
    <!-- Form Panel -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-red-600"></div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-sm font-bold text-slate-800 uppercase tracking-widest">{{ $editingId ? 'Edit' : 'Unggah' }} Dokumen</h2>
            <button wire:click="$set('showForm', false)" class="text-slate-400 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form wire:submit="save" id="document-form" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-5">
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Judul Dokumen</label>
                    <input wire:model="title" type="text" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl focus:border-red-500 outline-none" placeholder="Mis: Formulir Pendaftaran...">
                    @error('title') <p class="text-[10px] font-bold text-rose-500 mt-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Keterangan Singkat</label>
                    <textarea wire:model="description" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl focus:border-red-500 outline-none min-h-[80px]" placeholder="Deskripsi isi file..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kategori</label>
                            <button type="button" wire:click="$toggle('showAddCategory')" class="text-[9px] font-bold text-red-600 hover:text-red-700 transition-colors uppercase tracking-tight">
                                {{ $showAddCategory ? 'Batal' : '+ Kategori Baru' }}
                            </button>
                        </div>
                        
                        @if($showAddCategory)
                            <div class="flex items-stretch gap-1.5">
                                <input wire:model="new_category_name" type="text" 
                                    class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl outline-none focus:border-red-500 transition-all font-bold" 
                                    placeholder="Nama kategori..."
                                    wire:keydown.enter.prevent="addCategory">
                                <button type="button" wire:click="addCategory" class="shrink-0 px-3 bg-red-600 text-white rounded-xl text-[10px] font-bold hover:bg-red-700 transition-all">OK</button>
                            </div>
                        @else
                            <select wire:model="category_id" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl focus:border-red-500 outline-none">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        @endif
                        @error('category_id') <p class="text-[10px] font-bold text-rose-500 mt-1 italic">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1.5">Akses File</label>
                        <select wire:model="is_public" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl focus:border-red-500 outline-none">
                            <option value="1">Publik (Dapat diakses semua orang)</option>
                            <option value="0">Internal (Hanya Civitas Akademika)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">File Dokumen (PDF, Docx, Max 10MB)</label>
                <div class="relative h-40 rounded-2xl overflow-hidden bg-slate-50 border-2 border-dashed border-slate-200 group transition-all hover:border-red-300 flex flex-col items-center justify-center">
                    @if ($file)
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500 mx-auto mb-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                            <p class="text-[11px] font-bold text-slate-700 truncate max-w-[200px] px-4">{{ $file->getClientOriginalName() }} ready!</p>
                        </div>
                    @else
                        <div class="text-center p-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300 mx-auto mb-3"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter italic">Klik untuk pilih file</p>
                        </div>
                    @endif
                    <input type="file" wire:model="file" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                </div>
                @error('file') <p class="text-[10px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
            </div>
        </form>
    </div>

    @else
    <!-- Search & List Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex flex-col md:flex-row gap-4">
            <div class="relative flex-grow">
                <input wire:model.live="search" type="text" placeholder="Cari dokumen..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold outline-none focus:border-red-500">
                <div class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
            </div>
            <select wire:model.live="category" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold outline-none cursor-pointer">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/50">
                    <tr class="border-b border-slate-200">
                        <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama File</th>
                        <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Tipe/Ukuran</th>
                        <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Downloads</th>
                        <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($documents as $doc)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg {{ $doc->file_type === 'pdf' ? 'bg-rose-50 text-red-600' : 'bg-blue-50 text-blue-600' }} flex items-center justify-center border border-current/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-800 tracking-tight leading-snug group-hover:text-red-600 transition-colors uppercase truncate max-w-[300px]">{{ $doc->title }}</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-tight">{{ $doc->category->name }}</span>
                                        @if(!$doc->is_public)
                                            <span class="text-[8px] px-1.5 py-0.5 bg-slate-900 text-white rounded font-black uppercase tracking-tighter">Internal</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-black font-mono text-slate-700 uppercase">{{ $doc->file_type }}</span>
                                <span class="text-[9px] font-bold text-slate-400">{{ round($doc->file_size / 1024, 1) }} KB</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <span class="text-xs font-extrabold text-slate-700">{{ number_format($doc->downloads_count) }}</span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-1">
                                <button wire:click="edit({{ $doc->id }})" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </button>
                                <button x-on:click="Swal.fire({
                                            title: 'Hapus Dokumen?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#e11d48',
                                            confirmButtonText: 'Hapus'
                                        }).then((r) => r.isConfirmed && $wire.delete({{ $doc->id }}))"
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center italic font-bold text-slate-300 text-sm">Belum ada dokumen diunggah...</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($documents->hasPages())
        <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-200">
            {{ $documents->links() }}
        </div>
        @endif
    </div>
    @endif
</div>
