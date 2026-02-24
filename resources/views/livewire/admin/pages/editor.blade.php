<div class="max-w-[1400px] mx-auto font-inter relative">
    <!-- Compact Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex flex-col gap-1">
            <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-red-600 transition-colors">Dashboard</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                <a href="{{ route('admin.pages.index') }}" class="hover:text-red-600 transition-colors">Halaman</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                <span class="text-slate-900">{{ $pageModel ? 'Sunting' : 'Baru' }}</span>
            </nav>
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">
                {{ $pageModel ? 'Sunting Halaman' : 'Buat Halaman Baru' }}
            </h1>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.pages.index') }}" 
               class="px-4 py-2 text-[11px] font-bold text-slate-500 hover:text-slate-900 bg-white border border-slate-200 rounded-full transition-all hover:bg-slate-50 uppercase tracking-tight">
                Batal
            </a>
            <button type="submit" form="page-form" 
                    class="px-6 py-2 text-[11px] font-bold text-white bg-red-600 rounded-full shadow-md shadow-red-600/20 hover:bg-red-700 transition-all uppercase tracking-tight group">
                <span wire:loading.remove wire:target="save" class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Simpan Halaman
                </span>
                <span wire:loading wire:target="save" class="flex items-center gap-2">
                    <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Menyimpan...
                </span>
            </button>
        </div>
    </div>

    <form wire:submit="save" id="page-form" class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">
        <!-- Main Content Column (75%) -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Title Entry -->
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-red-500"></div>
                <div class="flex items-center justify-between mb-3">
                    <label for="title" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Judul Halaman</label>
                </div>
                <input wire:model="title" type="text" id="title" 
                       class="w-full px-4 py-2.5 text-sm font-bold text-slate-900 bg-slate-50 border border-slate-200 rounded-lg focus:ring-4 focus:ring-red-500/5 focus:border-red-500 transition-all outline-none placeholder:text-slate-400 tracking-tight" 
                       placeholder="Misal: Visi dan Misi...">
                @error('title') <p class="mt-1.5 text-[10px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
            </div>

            <!-- Editor Section -->
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                    <label>Konten Halaman</label>
                </div>
                <div wire:ignore 
                     x-data="{
                        content: @entangle('content'),
                        init() {
                            tinymce.init({
                                target: this.$refs.tinymce,
                                height: 600,
                                menubar: false,
                                sticky_toolbar: true,
                                toolbar_sticky_offset: 80,
                                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                skin: 'oxide',
                                content_css: 'default',
                                content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; color: #1e293b; line-height: 1.6; }',
                                branding: false,
                                promotion: false,
                                setup: (editor) => {
                                    editor.on('init', () => { if (this.content) editor.setContent(this.content); });
                                    editor.on('change blur', () => { this.content = editor.getContent(); });
                                }
                            });
                        }
                     }">
                    <textarea x-ref="tinymce" class="w-full invisible"></textarea>
                </div>
                @error('content') <p class="mt-1.5 text-[10px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Sidebar Metadata (25%) -->
        <div class="space-y-6 lg:sticky lg:top-24">
            <!-- Publishing Control -->
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-4">
                <h3 class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.2em] mb-2">Konfigurasi</h3>
                
                <!-- Status -->
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status Terbit</label>
                    <div class="relative">
                        <select wire:model="is_published" 
                                class="w-full pl-8 pr-4 py-2 text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-lg focus:ring-4 focus:ring-red-500/5 focus:border-red-500 transition-all outline-none appearance-none cursor-pointer">
                            <option value="1">Published</option>
                            <option value="0">Draft / Hidden</option>
                        </select>
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 w-2 h-2 rounded-full {{ $is_published ? 'bg-emerald-500' : 'bg-slate-400' }}"></div>
                    </div>
                </div>

                <!-- Category -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kategori</label>
                        <button type="button" wire:click="$toggle('showAddCategory')" class="text-[9px] font-bold text-red-600 hover:text-red-700 transition-colors uppercase tracking-tight">
                            {{ $showAddCategory ? 'Batal' : '+ Baru' }}
                        </button>
                    </div>
                    @if($showAddCategory)
                        <div class="flex items-stretch gap-1.5">
                            <div class="flex-1 min-w-0">
                                <input wire:model="new_category_name" type="text" 
                                    class="w-full px-3 py-1.5 text-[11px] bg-slate-50 border border-slate-200 rounded-lg outline-none focus:border-red-500 transition-all font-bold" 
                                    placeholder="Nama baru..."
                                    wire:keydown.enter="addCategory">
                            </div>
                            <button type="button" wire:click="addCategory" class="shrink-0 px-2.5 flex items-center justify-center bg-red-600 text-white rounded-lg text-[9px] font-bold shadow-sm hover:bg-red-700 transition-all">
                                OK
                            </button>
                        </div>
                    @else
                        <div class="relative">
                            <select wire:model="category_id" class="w-full px-3 py-2 text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-lg focus:ring-4 focus:ring-red-500/5 focus:border-red-500 transition-all outline-none appearance-none cursor-pointer">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                    @endif
                    @error('category_id') <p class="text-[9px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Featured Image -->
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-3">
                <h3 class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.2em]">Gambar Sampul</h3>
                <div class="relative aspect-video group cursor-pointer border-2 border-dashed border-slate-100 hover:border-red-200 transition-all rounded-xl overflow-hidden bg-slate-50/50 flex flex-col items-center justify-center">
                    @if ($cover_image)
                        <img src="{{ $cover_image->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover">
                    @elseif ($pageModel && $pageModel->cover_image)
                        <img src="{{ asset('storage/' . $pageModel->cover_image) }}" class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="text-center p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-200 mx-auto mb-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            <p class="text-[9px] font-bold text-slate-300 italic uppercase">Upload cover</p>
                        </div>
                    @endif
                    <input type="file" wire:model="cover_image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                </div>
                @error('cover_image') <p class="text-[9px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
            </div>

            <!-- SEO Settings -->
            <div x-data="{ open: false }" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden transition-all duration-300">
                <button type="button" @click="open = !open" class="w-full flex items-center justify-between p-5 hover:bg-slate-50 transition-colors text-left group">
                    <h3 class="text-[10px] font-bold text-slate-400 group-hover:text-slate-600 uppercase tracking-[0.2em] transition-colors">Optimasi SEO</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300 transition-transform duration-300" :class="open ? 'rotate-180 text-red-500' : ''"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="open" x-collapse class="p-5 pt-0 space-y-4">
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Meta Title</label>
                        <input wire:model="meta_title" type="text" class="w-full px-3 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg outline-none focus:border-red-400" placeholder="Meta title...">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Meta Description</label>
                        <textarea wire:model="meta_description" class="w-full px-3 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg outline-none focus:border-red-400 min-h-[80px]" placeholder="Summary for search engines..."></textarea>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Keywords</label>
                        <input wire:model="meta_keywords" type="text" class="w-full px-3 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg outline-none focus:border-red-400" placeholder="e.g. visi, misi, profil">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
