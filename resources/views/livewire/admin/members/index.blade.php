<div class="space-y-6 font-inter">
    <!-- Header -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight text-center md:text-left">Struktur Organisasi & SDM</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1 text-center md:text-left">Kelola pimpinan, staf, dan pengelola</p>
        </div>

        <div class="flex items-center gap-2 w-full md:w-auto">
            <div class="relative flex-grow md:w-64">
                <input wire:model.live="search" type="text" placeholder="Cari nama/NIP..."
                       class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold outline-none focus:border-red-500 transition-all">
                <div class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
            </div>

            <a href="{{ route('admin.members.create') }}"
               class="inline-flex items-center gap-2 px-6 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition-all shadow-md shadow-red-600/20 shrink-0 uppercase tracking-widest">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Baru</span>
            </a>
        </div>
    </div>

    <!-- Group Filters -->
    <div class="flex flex-wrap items-center gap-2 px-1">
        <button wire:click="$set('group', '')"
                class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border transition-all {{ $group === '' ? 'bg-slate-900 text-white border-slate-900 shadow-lg shadow-slate-900/10' : 'bg-white text-slate-400 border-slate-200 hover:border-slate-400' }}">
            Semua
        </button>
        @foreach([
            'direktur' => 'Direktur',
            'kasubdit' => 'Kasubdit',
            'kepala-seksi' => 'Kepala Seksi',
            'tim-jaringan' => 'Tim Jaringan',
            'tim-helpdesk' => 'Tim Helpdesk',
            'tim-programmer' => 'Tim Programmer',
        ] as $cat => $label)
            <button wire:click="$set('group', '{{ $cat }}')"
                    class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border transition-all {{ $group === $cat ? 'bg-red-600 text-white border-red-600 shadow-lg shadow-red-600/10' : 'bg-white text-slate-400 border-slate-200 hover:border-red-200 hover:text-red-500' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <!-- Grid View -->
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-6">
        @forelse($members as $item)
        <div class="group bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-500 relative">
            <div class="absolute top-3 right-3 z-10 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col gap-1">
                <a href="{{ route('admin.members.edit', $item->uuid) }}" class="p-1.5 bg-white/90 backdrop-blur shadow-sm rounded-lg text-slate-600 hover:text-red-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>
                <button x-on:click="Swal.fire({
                            title: 'Hapus Personnel?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#e11d48',
                            confirmButtonText: 'Hapus'
                        }).then((r) => r.isConfirmed && $wire.delete('{{ $item->uuid }}'))"
                        class="p-1.5 bg-white/90 backdrop-blur shadow-sm rounded-lg text-slate-600 hover:text-red-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </button>
            </div>

            <div class="aspect-[3/4] overflow-hidden bg-slate-100 relative group-hover:after:content-[''] group-hover:after:absolute group-hover:after:inset-0 group-hover:after:bg-gradient-to-t group-hover:after:from-red-600/20 group-hover:after:to-transparent">
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                @endif

                <div class="absolute bottom-0 left-0 w-full p-4 z-10 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                    <div class="bg-white/90 backdrop-blur p-2 rounded-xl border border-white/20 shadow-xl">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-0.5">Kontak Langsung</p>
                        <p class="text-[10px] font-bold text-slate-700 truncate">{{ $item->email ?: 'Email tidak ada' }}</p>
                    </div>
                </div>
            </div>

            <div class="p-4 text-center">
                <span class="inline-block px-2 py-0.5 bg-slate-100 text-[8px] font-black text-slate-500 uppercase tracking-[0.2em] rounded mb-2 border border-slate-200">#{{ $item->order }} • {{ $item->position_group }}</span>
                <h3 class="font-extrabold text-slate-900 text-xs truncate leading-tight transition-colors group-hover:text-red-600">{{ $item->fullname }}</h3>
                <p class="text-[10px] text-slate-400 font-bold mt-1 italic tracking-tight uppercase">{{ $item->position }}</p>
            </div>

            <button wire:click="toggleStatus('{{ $item->uuid }}')"
                    class="absolute bottom-0 left-0 w-full h-1 {{ $item->is_active ? 'bg-green-500' : 'bg-slate-300' }} transition-colors"></button>
        </div>
        @empty
        <div class="col-span-full py-20 text-center bg-white border border-slate-200 border-dashed rounded-3xl">
            <p class="text-sm font-bold text-slate-400 tracking-tight uppercase italic underline decoration-red-500 decoration-2 underline-offset-4">Tidak ada personnel ditemukan</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $members->links() }}
    </div>
</div>
