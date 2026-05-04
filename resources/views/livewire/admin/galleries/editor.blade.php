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
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm" x-data="{ localImages: [], imagesError: '' }">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Koleksi Foto Album</h3>
                        <p class="text-[10px] text-slate-400 font-bold mt-1">Unggah sekaligus beberapa foto kegiatan (Maks 2MB/foto)</p>
                    </div>
                    <div class="relative">
                        <input type="file" wire:model="images" multiple accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10"
                               x-on:change="
                                   localImages = [];
                                   imagesError = '';
                                   let valid = true;
                                   for(let i=0; i<$event.target.files.length; i++) {
                                       if ($event.target.files[i].size > 2 * 1024 * 1024) {
                                           imagesError = 'File \'' + $event.target.files[i].name + '\' terlalu besar (Maks 2MB).';
                                           valid = false;
                                           break;
                                       }
                                       localImages.push(URL.createObjectURL($event.target.files[i]));
                                   }
                                   if (!valid) {
                                       $event.target.value = '';
                                       localImages = [];
                                   }
                               ">
                        <button type="button" class="px-4 py-2 bg-slate-900 text-white text-[10px] font-bold rounded-lg hover:bg-black transition-all uppercase tracking-widest">+ Tambah Foto</button>
                    </div>
                </div>

                <div wire:loading wire:target="images" class="mb-4 w-full">
                    <span class="text-[10px] font-bold text-red-600 animate-pulse uppercase tracking-widest">Memproses unggahan foto...</span>
                </div>

                <template x-if="imagesError">
                    <p class="text-[10px] font-bold text-rose-500 mb-4 italic" x-text="imagesError"></p>
                </template>
                @error('images.*') <p class="text-[10px] font-bold text-rose-500 mb-4 italic">{{ $message }}</p> @enderror

                <!-- Existing & New Images Preview -->
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                    @if($galleryModel)
                        @foreach($galleryModel->images as $img)
                        <div wire:key="existing-img-{{ $img->id }}" class="aspect-square rounded-2xl overflow-hidden relative group border border-slate-100 shadow-sm">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <button type="button" wire:click="removeImage({{ $img->id }})" class="p-2 bg-red-600 text-white rounded-lg shadow-xl hover:scale-110 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    @endif

                    <!-- Alpine Local Previews (Instant) -->
                    <template x-for="(url, index) in localImages" :key="'local-'+index">
                        <div class="aspect-square rounded-2xl overflow-hidden relative group border-2 border-red-500/20 shadow-xl opacity-60">
                            <img :src="url" class="w-full h-full object-cover z-10 relative">
                            <div class="absolute top-2 right-2 px-1.5 py-0.5 bg-red-600 text-[8px] font-black text-white rounded uppercase z-20">Baru</div>
                        </div>
                    </template>

                    <!-- Livewire Server Previews (Hidden if local previews exist) -->
                    @if($images)
                        @foreach($images as $index => $img)
                        @if(is_object($img) && method_exists($img, 'temporaryUrl'))
                        <div x-show="localImages.length === 0" wire:key="new-img-{{ $index }}" class="aspect-square rounded-2xl overflow-hidden relative group border-2 border-red-500/20 shadow-xl opacity-60">
                            <img src="{{ $img->temporaryUrl() }}" onerror="this.style.display='none'" class="w-full h-full object-cover z-10 relative">
                            <div class="absolute top-2 right-2 px-1.5 py-0.5 bg-red-600 text-[8px] font-black text-white rounded uppercase z-20">Baru</div>
                        </div>
                        @endif
                        @endforeach
                    @endif

                    @if((!$galleryModel || $galleryModel->images->isEmpty()) && empty($images))
                    <div x-show="localImages.length === 0" class="col-span-full py-12 flex flex-col items-center justify-center bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl text-slate-300">
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
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm text-center" x-data="{ localCover: null, coverError: '' }">
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Cover Foto Album</h3>
                <p class="text-[9px] text-slate-400 font-bold mb-6">Format: JPG/PNG (Maks 1MB)</p>
                <div class="relative aspect-video rounded-2xl border-2 border-dashed border-slate-100 group hover:border-red-200 transition-all overflow-hidden bg-slate-50">
                    <!-- Loading Overlay -->
                    <div wire:loading wire:target="cover_image" class="absolute inset-0 bg-slate-50/80 z-20 flex flex-col items-center justify-center">
                        <svg class="animate-spin h-6 w-6 text-red-600 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span class="text-[9px] font-bold text-slate-600 uppercase tracking-widest">Memproses...</span>
                    </div>

                    <!-- Alpine Local Preview -->
                    <template x-if="localCover">
                        <img :src="localCover" class="absolute inset-0 w-full h-full object-cover z-10">
                    </template>

                    <!-- Livewire Server Preview (Hidden if local preview exists) -->
                    <div x-show="!localCover" class="absolute inset-0 w-full h-full">
                        @if ($cover_image && is_object($cover_image) && method_exists($cover_image, 'temporaryUrl'))
                            <img src="{{ $cover_image->temporaryUrl() }}" onerror="this.style.display='none'" class="absolute inset-0 w-full h-full object-cover z-10">
                        @elseif ($galleryModel && $galleryModel->cover_image)
                            <img src="{{ asset('storage/' . $galleryModel->cover_image) }}" class="absolute inset-0 w-full h-full object-cover z-10">
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300 mb-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                <p class="text-[9px] font-black text-slate-300 uppercase tracking-tight">Pilih Foto Sampul</p>
                            </div>
                        @endif
                    </div>
                    
                    <input type="file" wire:model="cover_image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-30"
                           x-on:change="
                               coverError = '';
                               if($event.target.files.length > 0) {
                                   let file = $event.target.files[0];
                                   if (file.size > 1024 * 1024) {
                                       coverError = 'Ukuran gambar cover melebihi batas maksimal 1MB!';
                                       $event.target.value = '';
                                       localCover = null;
                                   } else {
                                       localCover = URL.createObjectURL(file);
                                   }
                               } else {
                                   localCover = null;
                               }
                           ">
                </div>
                <template x-if="coverError">
                    <p class="mt-2 text-[10px] font-bold text-rose-500 italic" x-text="coverError"></p>
                </template>
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
