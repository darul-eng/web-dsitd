<div>
    <div class="bg-white min-h-screen flex flex-col">
        @include('livewire.public.partials.profile-navbar')

        {{-- Hero Header --}}
        <section class="relative pt-24 pb-12 overflow-hidden mesh-gradient">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs><pattern id="grid-service-show" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="black" stroke-width="1"/></pattern></defs>
                    <rect width="100%" height="100%" fill="url(#grid-service-show)" />
                </svg>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="flex items-start justify-between gap-8">
                    <div class="max-w-3xl flex-1">
                        <h1 class="text-4xl md:text-6xl font-black text-white tracking-tighter leading-[0.95]">{{ $service->title }}</h1>
                        @if($service->meta_description)
                            <p class="mt-6 text-slate-300/90 text-sm md:text-base leading-relaxed">{{ $service->meta_description }}</p>
                        @endif
                    </div>

                    @if($service->category)
                        <span class="inline-flex px-4 py-2 rounded-full bg-red-500/20 border border-red-400/40 text-[10px] font-black text-white uppercase tracking-widest flex-shrink-0">
                            {{ $service->category->name }}
                        </span>
                    @endif
                </div>
            </div>
        </section>

        {{-- Content --}}
        <section class="py-16 flex-grow flex flex-col">
            <div class="container mx-auto px-6 flex flex-col flex-grow">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 flex-grow">
                    <article class="lg:col-span-8 rounded-[2rem] border border-slate-100 bg-white p-8 md:p-12 shadow-sm">
                        <div class="prose prose-slate max-w-none prose-headings:font-black prose-headings:tracking-tight prose-p:text-slate-600 prose-p:leading-relaxed">
                            {!! $service->content !!}
                        </div>

                        @if($service->external_link)
                            <div class="mt-10">
                                <a href="{{ $service->external_link }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-4 rounded-xl bg-red-600 text-white text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-colors">
                                    Buka Akses Layanan
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                                </a>
                            </div>
                        @endif
                    </article>

                    <aside class="lg:col-span-4 flex flex-col justify-end">
                        <div class="rounded-[2rem] border border-slate-100 bg-slate-50 p-8">
                            <h3 class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-4">Butuh Pendampingan?</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Tim DSITD siap membantu implementasi layanan untuk unit kerja Anda.</p>
                            <a href="https://helpdesk.unhas.ac.id/" target="_blank" class="mt-6 inline-flex items-center gap-2 text-[10px] font-black text-red-600 uppercase tracking-widest hover:text-red-700 transition-colors">
                                Hubungi IT Helpdesk
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </div>
</div>
