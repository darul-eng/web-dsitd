<div class="max-w-5xl mx-auto space-y-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">{{ $news ? 'Edit Berita' : 'Tambah Berita Baru' }}</h1>
            <p class="text-sm text-slate-500">Lengkapi detail berita di bawah ini.</p>
        </div>
        <a href="{{ route('admin.news.index') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">Batal & Kembali</a>
    </div>

    <form wire:submit="save" class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <!-- Title -->
                <div class="space-y-1 mt-1">
                    <div class="flex items-center gap-3">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Judul Berita</label>
                        <button 
                            type="button" 
                            wire:click="generateAI"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center px-2 py-1 rounded-lg bg-primary-600 text-[10px] font-bold text-white hover:bg-primary-700 transition-all shadow-sm shadow-primary-600/20"
                        >
                            <span wire:loading.remove wire:target="generateAI" class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                ✨ Generate AI
                            </span>
                            <span wire:loading wire:target="generateAI" class="flex items-center gap-1">
                                <svg class="animate-spin h-3 w-3 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sedang Menulis...
                            </span>
                        </button>
                    </div>
                    <input wire:model="title" type="text" class="block w-full px-4 py-2 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all bg-slate-50/50 font-bold" placeholder="Masukkan judul menarik...">
                    @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Content with TinyMCE Editor -->
                <div
                    wire:ignore
                    x-data="{
                        content: @entangle('content'),
                        init() {
                            tinymce.init({
                                target: this.$refs.tinymce,
                                height: 500,
                                menubar: false,
                                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                skin: 'oxide',
                                content_css: 'default',
                                images_file_types: 'jpg,svg,webp,png',
                                file_picker_types: 'image',
                                setup: (editor) => {
                                    // Set initial content when editor is ready
                                    editor.on('init', () => {
                                        if (this.content) {
                                            editor.setContent(this.content);
                                        }
                                    });

                                    // Update Alpine/Livewire when content changes
                                    editor.on('change blur', () => {
                                        this.content = editor.getContent();
                                    });

                                    // Listen for AI generated content
                                    window.addEventListener('content-updated', event => {
                                        editor.setContent(event.detail.content);
                                    });
                                },
                                // TinyMCE Image adjustments
                                image_advtab: true,
                                image_dimensions: true,
                                object_resizing: true,
                                promotion: false,
                                branding: false,
                                license_key: 'gpl',
                            });
                        }
                    }"
                    class="space-y-1 mt-1">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Isi Berita</label>
                    <p class="text-[10px] text-slate-400 mb-2">Gunakan editor di bawah untuk menulis konten. Anda bisa drag & drop gambar langsung ke editor dan mengatur ukurannya.</p>
                    <textarea x-ref="tinymce" class="block w-full"></textarea>
                    @error('content') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>


        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-4">
            <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <!-- Status -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Status Publikasi</label>
                    <select wire:model="status" class="block w-full px-4 py-2 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all bg-slate-50/50">
                        <option value="draft">Simpan sebagai Draft</option>
                        <option value="published">Terbitkan Langsung</option>
                        <option value="archived">Arsipkan</option>
                    </select>
                </div>

                <!-- Category -->
                <div>
                    <div class="flex items-center justify-between mt-1">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Kategori</label>
                        <button type="button" wire:click="$toggle('showAddCategory')" class="text-[10px] font-bold text-primary-600 hover:text-primary-700 transition-colors">
                            {{ $showAddCategory ? 'Batal' : '+ Kategori Baru' }}
                        </button>
                    </div>

                    @if($showAddCategory)
                    <div class="flex gap-2">
                        <input wire:model="new_category_name" type="text" 
                            class="flex-1 px-4 py-2 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all bg-slate-50/50" 
                            placeholder="Nama kategori baru..."
                            wire:keydown.enter="addCategory"
                        >
                        <button type="button" wire:click="addCategory" class="px-3 py-2 bg-primary-600 text-white rounded-xl text-xs font-bold hover:bg-primary-700 transition-all">
                            Simpan
                        </button>
                    </div>
                    @error('new_category_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    @else
                    <select wire:model="category_id" class="block w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:ring-primary-500 focus:border-primary-500 transition-all bg-slate-50/50">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    @endif
                </div>

                <!-- Cover Image -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Gambar Sampul</label>
                    <p class="text-[10px] text-slate-400 mb-2">Gambar utama yang akan muncul di daftar berita dan header detail berita.</p>
                    <div class="mt-2 flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-2xl p-3 transition-all hover:border-primary-300">
                        @if ($cover_image)
                        <img src="{{ $cover_image->temporaryUrl() }}" class="w-full h-28 object-cover rounded-xl mb-3">
                        @elseif ($news && $news->cover_image)
                        <img src="{{ asset('storage/' . $news->cover_image) }}" class="w-full h-28 object-cover rounded-xl mb-3">
                        @endif

                        <input type="file" wire:model="cover_image" class="hidden" id="cover-upload">
                        <label for="cover-upload" class="cursor-pointer text-xs font-bold text-primary-600 hover:text-primary-700">
                            {{ $cover_image || ($news && $news->cover_image) ? 'Ganti Gambar' : 'Pilih Gambar' }}
                        </label>
                        <p class="text-[10px] text-slate-400 mt-1">PNG, JPG up to 2MB</p>
                    </div>
                    @error('cover_image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <hr class="border-slate-50">

                <button type="submit" class="w-full py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-primary-600/30 flex items-center justify-center gap-2 mt-1">
                    <span wire:loading.remove>Simpan Berita</span>
                    <span wire:loading class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>