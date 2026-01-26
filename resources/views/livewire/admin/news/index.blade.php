<div class="space-y-3">
    <!-- Header & Action Row -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-white/50 p-2 rounded-2xl border border-slate-100/50">
        <div class="flex items-center gap-4 px-2">
            <h1 class="text-xl font-bold text-slate-800 tracking-tight whitespace-nowrap">Manajemen Berita</h1>
            <div class="hidden xl:block h-6 w-px bg-slate-200"></div>
            <p class="hidden xl:block text-xs text-slate-400 font-medium">Kelola konten informasi direktorat</p>
        </div>

        <div class="flex flex-wrap items-center justify-end gap-2 flex-grow lg:flex-grow-0">
            <!-- Search Box -->
            <div class="relative flex-shrink-0 w-60">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary-500 transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input wire:model.live="search" type="text" placeholder="Cari berita..." class="block w-full pl-11 pr-4 py-1.5 border border-slate-200 rounded-xl text-xs outline-none focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all bg-white shadow-sm placeholder:text-slate-400 font-medium tracking-tight">
            </div>

            <!-- Category -->
            <div class="flex-shrink-0 w-48">
                <select wire:model.live="category" class="block w-full py-1.5 border border-slate-200 rounded-xl text-xs outline-none focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all bg-white shadow-sm text-slate-600 font-medium cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div class="flex-shrink-0 w-32">
                <select wire:model.live="status" class="block w-full py-1.5 border border-slate-200 rounded-xl text-xs outline-none focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all bg-white shadow-sm text-slate-600 font-medium cursor-pointer">
                    <option value="">Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
            </div>

            <!-- Add Button -->
            <a href="{{ route('admin.news.create') }}" class="flex-shrink-0 group inline-flex items-center justify-center px-4 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold rounded-xl transition-all shadow-md shadow-primary-600/20 whitespace-nowrap">
                <svg class="w-3.5 h-3.5 mr-1.5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Baru
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50/50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-50">
                    <tr>
                        <th class="px-6 py-4">Informasi Berita</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center w-24">Views</th>
                        <th class="px-6 py-4 text-right w-28">Opsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($newsItems as $item)
                    <tr class="hover:bg-slate-50/30 transition-colors group">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-200 shadow-sm">
                                    @if($item->cover_image)
                                    <img src="{{ asset('storage/' . $item->cover_image) }}" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-slate-800 line-clamp-1 group-hover:text-primary-600 transition-colors text-sm">{{ $item->title }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-primary-600 font-extrabold text-[9px] uppercase tracking-wider bg-primary-50 px-1.5 py-0.5 rounded">{{ $item->category->name }}</span>
                                        <span class="text-slate-300">•</span>
                                        <span class="text-slate-400 text-[10px] font-medium italic">oleh {{ $item->author->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-center">
                            @if($item->status === 'published')
                            <span class="inline-flex px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded-md text-[10px] font-bold border border-emerald-100">Published</span>
                            @elseif($item->status === 'draft')
                            <span class="inline-flex px-2 py-0.5 bg-amber-50 text-amber-600 rounded-md text-[10px] font-bold border border-amber-100">Draft</span>
                            @else
                            <span class="inline-flex px-2 py-0.5 bg-slate-100 text-slate-500 rounded-md text-[10px] font-bold border border-slate-200">Archived</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-center">
                            <span class="text-xs font-bold text-slate-600">{{ number_format($item->views_count) }}</span>
                            <p class="text-[9px] text-slate-400 uppercase font-bold tracking-tighter">Views</p>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex justify-end gap-1">
                                <a href="{{ route('admin.news.edit', $item->uuid) }}" class="p-2 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition-all group/btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button
                                    x-on:click="
                                        Swal.fire({
                                            title: 'Hapus Berita?',
                                            text: 'Data yang dihapus tidak dapat dikembalikan!',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Ya, Hapus!',
                                            cancelButtonText: 'Batal',
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $wire.delete('{{ $item->uuid }}')
                                            }
                                        })
                                    "
                                    class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all group/btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center text-slate-200 mb-4 border border-slate-100">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <h5 class="text-slate-800 font-bold text-lg">Data Berita Kosong</h5>
                                <p class="text-slate-500 text-sm max-w-xs mx-auto mt-2">Belum ada berita yang sesuai dengan kriteria pencarian atau filter Anda saat ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($newsItems->hasPages())
        <div class="px-6 py-4 bg-slate-50/30 border-t border-slate-50">
            {{ $newsItems->links() }}
        </div>
        @endif
    </div>
</div>