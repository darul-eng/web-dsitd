<div class="space-y-4 font-inter">
    <!-- Unified Single-Row Toolbar -->
    <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-sm flex flex-col lg:flex-row items-center gap-4">
        <!-- Title -->
        <div class="px-2 shrink-0 border-r border-slate-100 pr-4 hidden xl:block">
            <h1 class="text-lg font-extrabold text-slate-900 tracking-tight whitespace-nowrap">Manajemen Halaman</h1>
        </div>
        <div class="xl:hidden shrink-0">
            <h1 class="text-lg font-extrabold text-slate-900 tracking-tight whitespace-nowrap pr-2">Halaman</h1>
        </div>

        <!-- Search Box (Flex Grow) -->
        <div class="relative flex-grow w-full group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 group-focus-within:text-red-500 transition-colors"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
            <input wire:model.live="search" type="text" placeholder="Cari halaman..." 
                   class="block w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs outline-none focus:ring-4 focus:ring-red-500/5 focus:border-red-500 transition-all font-medium tracking-tight">
        </div>

        <!-- Filters & Action Group -->
        <div class="flex items-center gap-2 w-full lg:w-auto shrink-0">
            <!-- Category -->
            <div class="relative w-full lg:w-40">
                <select wire:model.live="category" 
                        class="block w-full appearance-none pl-3 pr-8 py-2 bg-slate-50 border border-slate-200 rounded-lg text-[11px] outline-none focus:border-red-500 transition-all text-slate-600 font-bold cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 pr-2 flex items-center pointer-events-none text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>
            </div>

            <!-- Status -->
            <div class="relative w-full lg:w-32">
                <select wire:model.live="status" 
                        class="block w-full appearance-none pl-3 pr-8 py-2 bg-slate-50 border border-slate-200 rounded-lg text-[11px] outline-none focus:border-red-500 transition-all text-slate-600 font-bold cursor-pointer">
                    <option value="">Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-2 flex items-center pointer-events-none text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>
            </div>

            <!-- Add Button -->
            <a href="{{ route('admin.pages.create') }}" 
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-[11px] font-bold rounded-lg transition-all shadow-md shadow-red-600/20 shrink-0 whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Baru</span>
            </a>
        </div>
    </div>

    <!-- Dense Data Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/50">
                    <tr class="border-b border-slate-200">
                        <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Judul Halaman</th>
                        <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Update Terakhir</th>
                        <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pages as $item)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-5 py-2.5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-slate-100 flex-shrink-0 overflow-hidden border border-slate-200">
                                    @if($item->cover_image)
                                    <img src="{{ asset('storage/' . $item->cover_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-slate-800 group-hover:text-red-600 transition-colors text-xs truncate leading-snug">{{ $item->title }}</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-[9px] font-extrabold text-red-600 uppercase tracking-tight">{{ $item->category->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-2.5 text-center">
                            @if($item->is_published)
                            <span class="inline-flex items-center px-2 py-0.5 bg-green-50 text-green-700 rounded-full text-[9px] font-bold border border-green-100">Published</span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 bg-slate-50 text-slate-600 rounded-full text-[9px] font-bold border border-slate-200">Draft</span>
                            @endif
                        </td>
                        <td class="px-5 py-2.5 text-center">
                            <div class="flex flex-col items-center">
                                <span class="text-xs font-extrabold text-slate-700">{{ $item->updated_at->format('d/m/Y') }}</span>
                                <span class="text-[8px] text-slate-400 font-bold uppercase tracking-tighter">{{ $item->updated_by ?? 'System' }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-2.5">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.pages.edit', $item->uuid) }}" 
                                   class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <button x-on:click="Swal.fire({
                                            title: 'Hapus Halaman?',
                                            text: 'Tindakan ini tidak dapat dibatalkan.',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#e11d48',
                                            confirmButtonText: 'Hapus'
                                        }).then((r) => r.isConfirmed && $wire.delete('{{ $item->uuid }}'))"
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <p class="text-sm font-bold text-slate-400 tracking-tight italic">Belum ada halaman...</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pages->hasPages())
        <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-200">
            {{ $pages->links() }}
        </div>
        @endif
    </div>
</div>
