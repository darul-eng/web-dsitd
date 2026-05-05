<div>
    <div class="bg-white min-h-screen">
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header --}}
        <section class="relative pt-24 pb-12 overflow-hidden mesh-gradient">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-services" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="black" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-services)" />
                </svg>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-red-500/20 text-red-500 border border-red-500/30 mb-4 backdrop-blur-xl">
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-white">Katalog Layanan Digital</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white tracking-tighter leading-tight">
                    Semua Layanan Digital.
                </h1>
                <p class="max-w-2xl text-base text-slate-300/80 font-medium leading-relaxed mt-2">
                    Temukan layanan teknologi informasi yang tersedia untuk sivitas akademika Universitas Hasanuddin.
                </p>
            </div>
        </section>

        {{-- Filter Section --}}
        <section class="py-14 md:py-16 bg-slate-50 border-y border-slate-100">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="lg:col-span-2">
                        <label for="service-search" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-3">Cari Layanan</label>
                        <input
                            id="service-search"
                            type="text"
                            wire:model.live.debounce.400ms="search"
                            placeholder="Contoh: VPN, email, hosting, jaringan"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-medium text-slate-700 placeholder:text-slate-400"
                        >
                    </div>

                    <div>
                        <label for="service-category" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-3">Kategori</label>
                        <select
                            id="service-category"
                            wire:model.live="category"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-semibold text-slate-700"
                        >
                            <option value="all">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-between gap-4">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">
                        Menampilkan {{ $services->count() }} dari {{ $services->total() }} layanan
                    </p>
                    <a href="https://helpdesk.unhas.ac.id/" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white border border-slate-200 text-[10px] font-black text-slate-700 hover:text-red-600 hover:border-red-200 transition-colors uppercase tracking-widest">
                        Butuh Bantuan?
                    </a>
                </div>
            </div>
        </section>

        {{-- Services Grid --}}
        <section class="py-16">
            <div class="container mx-auto px-6">
                @if($services->isEmpty())
                    <div class="rounded-3xl border border-slate-100 bg-white p-10 text-center">
                        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Layanan tidak ditemukan</h2>
                        <p class="mt-3 text-sm text-slate-500">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($services as $service)
                            <article class="group rounded-[2rem] border border-slate-100 bg-white p-8 hover:shadow-xl hover:shadow-slate-200/60 transition-all duration-300 h-full flex flex-col">
                                @if($service->category)
                                    <span class="inline-flex w-fit px-3 py-1 rounded-full bg-red-50 text-red-600 text-[9px] font-black uppercase tracking-widest mb-4">
                                        {{ $service->category->name }}
                                    </span>
                                @endif

                                <h3 class="text-2xl font-black text-slate-900 tracking-tight leading-tight">{{ $service->title }}</h3>
                                <p class="mt-4 text-sm text-slate-500 font-medium leading-relaxed flex-grow">
                                    {{ Str::limit(strip_tags($service->content), 160) }}
                                </p>

                                <div class="mt-8 flex items-center justify-between">
                                    <a href="{{ route('services.show', $service->slug) }}" wire:navigate class="inline-flex items-center gap-2 text-[10px] font-black text-slate-900 uppercase tracking-widest group-hover:text-red-600 transition-colors">
                                        Detail Layanan
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                                    </a>

                                    @if($service->external_link)
                                        <a href="{{ $service->external_link }}" target="_blank" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-red-600 transition-colors">
                                            Kunjungi
                                        </a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-10">
                        {{ $services->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>
