<div class="max-w-[1000px] mx-auto font-inter">
    <!-- Header Area -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 bg-white p-6 rounded-3xl border border-slate-200 shadow-sm relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1.5 h-full bg-red-600"></div>
        <div class="flex flex-col gap-1">
            <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-red-600">Dashboard</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                <a href="{{ route('admin.faqs.index') }}" class="hover:text-red-600">FAQ</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                <span class="text-slate-900">{{ $faqModel ? 'Sunting' : 'Baru' }}</span>
            </nav>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                {{ $faqModel ? 'Sunting FAQ' : 'Tambah FAQ Baru' }}
            </h1>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.faqs.index') }}" class="px-6 py-2.5 text-[11px] font-bold text-slate-500 hover:text-slate-900 transition-colors uppercase tracking-widest bg-slate-50 rounded-xl border border-slate-200">
                Kembali
            </a>
            <button type="submit" form="faq-form" class="px-8 py-2.5 bg-red-600 text-white text-[11px] font-bold rounded-xl hover:bg-red-700 transition-all shadow-lg shadow-red-600/20 uppercase tracking-widest">
                <span wire:loading.remove wire:target="save">Simpan FAQ</span>
                <span wire:loading wire:target="save">Memproses...</span>
            </button>
        </div>
    </div>

    <form wire:submit="save" id="faq-form" class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm space-y-8">
        <div class="space-y-1.5">
            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pertanyaan Lengkap</label>
            <textarea wire:model="question" rows="2" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-base font-bold text-slate-800 outline-none focus:border-red-500 transition-all" placeholder="Tuliskan pertanyaan yang sering diajukan..."></textarea>
            @error('question') <p class="text-[10px] font-bold text-rose-500 mt-1 italic">{{ $message }}</p> @enderror
        </div>

        <div class="space-y-1.5">
            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jawaban / Penjelasan</label>
            <div wire:ignore 
                 x-data="{
                    answer: @entangle('answer'),
                    init() {
                        tinymce.init({
                            target: this.$refs.tinymce,
                            height: 400,
                            menubar: false,
                            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                            skin: 'oxide',
                            content_css: 'default',
                            content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; color: #1e293b; line-height: 1.6; }',
                            branding: false,
                            promotion: false,
                            setup: (editor) => {
                                editor.on('init', () => { if (this.answer) editor.setContent(this.answer); });
                                editor.on('change blur', () => { this.answer = editor.getContent(); });
                            }
                        });
                    }
                 }">
                <textarea x-ref="tinymce" class="w-full invisible"></textarea>
            </div>
            @error('answer') <p class="text-[10px] font-bold text-rose-500 mt-1 italic">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start pt-4 border-t border-slate-100">
            <div class="space-y-1.5">
                <div class="flex items-center justify-between h-5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kategori FAQ</label>
                    <button type="button" wire:click="$toggle('showAddCategory')" class="text-[9px] font-bold text-red-600 hover:text-red-700 uppercase tracking-tight">
                        {{ $showAddCategory ? 'Batal' : '+ Baru' }}
                    </button>
                </div>
                @if($showAddCategory)
                    <div class="flex items-center gap-1.5 min-w-0 h-[46px]">
                        <input wire:model="new_category_name" type="text" class="flex-grow min-w-0 h-full px-4 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold outline-none focus:border-red-500" placeholder="Kategori baru...">
                        <button type="button" wire:click="addCategory" class="shrink-0 h-full px-4 bg-red-600 text-white rounded-xl text-[10px] font-bold">OK</button>
                    </div>
                @else
                    <select wire:model="faq_category_id" class="w-full h-[46px] px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:border-red-500 cursor-pointer">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                @endif
                @error('faq_category_id') <p class="text-[10px] font-bold text-rose-500 mt-1 italic">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <div class="flex items-center h-5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Urutan (Order)</label>
                </div>
                <input wire:model="order" type="number" class="w-full h-[46px] px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:border-red-500">
            </div>
            
            <div class="space-y-1.5">
                <div class="flex items-center h-5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Visibilitas</label>
                </div>
                <select wire:model="is_published" class="w-full h-[46px] px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:border-red-500">
                    <option value="1">Published</option>
                    <option value="0">Draft / Hidden</option>
                </select>
            </div>
        </div>
    </form>
</div>
