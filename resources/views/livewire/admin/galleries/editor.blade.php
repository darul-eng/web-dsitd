<div class="max-w-[1200px] mx-auto font-inter">
    <!-- Header -->
    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4 mb-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1.5 h-full bg-red-600"></div>
        <div class="flex flex-col gap-1">
            <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-red-600">Dashboard</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                <a href="{{ route('admin.galleries.index') }}" class="hover:text-red-600">Galeri</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                <span class="text-slate-900">{{ $galleryModel ? 'Edit' : 'Baru' }}</span>
            </nav>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $galleryModel ? 'Sunting Album' : 'Buat Album Baru' }}</h1>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.galleries.index') }}" class="px-6 py-2.5 text-[11px] font-bold text-slate-500 hover:text-slate-900 transition-all uppercase tracking-widest bg-slate-50 rounded-xl border border-slate-200">Batal</a>
            <button type="submit" form="gallery-form" class="px-8 py-2.5 bg-red-600 text-white text-[11px] font-bold rounded-xl hover:bg-red-700 transition-all shadow-lg shadow-red-600/20 uppercase tracking-widest">
                <span wire:loading.remove wire:target="save">Simpan Album</span>
                <span wire:loading wire:target="save">Mengunggah...</span>
            </button>
        </div>
    </div>

    <form wire:submit="save" id="gallery-form" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Info Section -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Judul Album Dokumentasi</label>
                    <input wire:model="title" type="text" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-lg font-black text-slate-900 placeholder-slate-300 outline-none focus:border-red-500 transition-all" placeholder="Mis: Kunjungan Rektorat 2024...">
                    @error('title') <p class="text-[10px] font-bold text-rose-500 mt-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Deskripsi / Keterangan</label>
                    <textarea wire:model="description" rows="4" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium text-slate-600 outline-none focus:border-red-500 transition-all" placeholder="Tuliskan detail kegiatan..."></textarea>
                </div>
            </div>

            <!-- Image Upload Section -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Koleksi Foto Album</h3>
                        <p class="text-[10px] text-slate-400 font-bold mt-1">Unggah sekaligus beberapa foto kegiatan</p>
                    </div>
                    <div class="relative">
                        <input type="file" wire:model="images" multiple class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        <button type="button" class="px-4 py-2 bg-slate-900 text-white text-[10px] font-bold rounded-lg hover:bg-black transition-all uppercase tracking-widest">+ Tambah Foto</button>
                    </div>
                </div>

                @error('images.*') <p class="text-[10px] font-bold text-rose-500 mb-4 italic">{{ $message }}</p> @enderror

                <!-- Existing & New Images Preview -->
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                    @if($galleryModel)
                        @foreach($galleryModel->images as $img)
                        <div class="aspect-square rounded-2xl overflow-hidden relative group border border-slate-100 shadow-sm">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <button type="button" wire:click="removeImage({{ $img->id }})" class="p-2 bg-red-600 text-white rounded-lg shadow-xl hover:scale-110 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    @endif

                    @if($images)
                        @foreach($images as $index => $img)
                        <div class="aspect-square rounded-2xl overflow-hidden relative group border-2 border-red-500/20 shadow-xl opacity-60">
                            <img src="{{ $img->temporaryUrl() }}" class="w-full h-full object-cover">
                            <div class="absolute top-2 right-2 px-1.5 py-0.5 bg-red-600 text-[8px] font-black text-white rounded uppercase">Baru</div>
                        </div>
                        @endforeach
                    @endif

                    @if((!$galleryModel || $galleryModel->images->isEmpty()) && !$images)
                    <div class="col-span-full py-12 flex flex-col items-center justify-center bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl text-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mb-4"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        <p class="text-[10px] font-bold uppercase tracking-widest">Belum ada foto yang diunggah</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Options -->
        <div class="space-y-6">
            <!-- Cover Image -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm text-center">
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6">Cover Foto Album</h3>
                <div class="relative aspect-video rounded-2xl border-2 border-dashed border-slate-100 group hover:border-red-200 transition-all overflow-hidden bg-slate-50">
                    @if ($cover_image)
                        <img src="{{ $cover_image->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover">
                    @elseif ($galleryModel && $galleryModel->cover_image)
                        <img src="{{ asset('storage/' . $galleryModel->cover_image) }}" class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300 mb-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-tight">Pilih Foto Sampul</p>
                        </div>
                    @endif
                    <input type="file" wire:model="cover_image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                </div>
                @error('cover_image') <p class="mt-2 text-[10px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
            </div>

            <!-- Categories & Status -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
               <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kategori Album</label>
                        <button type="button" wire:click="$toggle('showAddCategory')" class="text-[9px] font-bold text-red-600 hover:text-red-700 uppercase tracking-tight">
                            {{ $showAddCategory ? 'Batal' : '+ Baru' }}
                        </button>
                    </div>
                    @if($showAddCategory)
                        <div class="flex items-center gap-1.5 min-w-0">
                            <input wire:model="new_category_name" type="text" class="flex-grow min-w-0 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold outline-none focus:border-red-500" placeholder="Kategori baru...">
                            <button type="button" wire:click="addCategory" class="shrink-0 px-3 py-2 bg-red-600 text-white rounded-lg text-[10px] font-bold">OK</button>
                        </div>
                    @else
                        <select wire:model="gallery_category_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:border-red-500 cursor-pointer">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <span class="text-[11px] font-black text-slate-600 uppercase tracking-widest">Publikasikan</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="is_published" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>
