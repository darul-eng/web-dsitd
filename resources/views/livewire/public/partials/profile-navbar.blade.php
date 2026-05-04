<header x-data="{ profileOpen: false, mobileMenuOpen: false, mobileProfileOpen: false }" class="fixed top-0 left-0 right-0 z-50 glass h-16 px-6 md:px-12 flex items-center justify-between border-b border-white/40">
    <div class="flex items-center gap-10">
        <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-3 group">
            <img src="{{ asset('img/logo-dark.png') }}" alt="Logo DSITD UNHAS" class="h-8 md:h-10 transition-all duration-500 group-hover:scale-105" loading="lazy">

            <div class="flex flex-col">
                <span class="text-sm font-black tracking-tighter leading-none text-slate-900">DSITD</span>
                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest leading-none mt-0.5">UNHAS</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-8">
            <a href="{{ route('home') }}#layanan" class="text-[11px] font-bold text-slate-500 hover:text-red-600 transition-all uppercase tracking-widest">Layanan</a>

            <div class="relative" @click.outside="profileOpen = false">
                <button @click="profileOpen = !profileOpen" class="inline-flex items-center gap-1 text-[11px] font-bold text-red-600 transition-all uppercase tracking-widest">
                    Profile
                    <svg class="w-3 h-3 transition-transform" :class="profileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="profileOpen" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute top-8 left-0 min-w-[220px] rounded-2xl bg-white border border-slate-200 shadow-xl p-2 z-50">
                    <a href="{{ route('profile.vision-mission') }}" wire:navigate class="block px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-700 hover:bg-slate-100">Visi & Misi</a>
                    <a href="{{ route('profile.history') }}" wire:navigate class="block px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-700 hover:bg-slate-100">Sejarah</a>
                    <a href="{{ route('profile.organization') }}" class="block px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-700 hover:bg-slate-100">Tim Kami</a>
                </div>
            </div>

            <a href="{{ route('home') }}#dokumen" class="text-[11px] font-bold text-slate-500 hover:text-red-600 transition-all uppercase tracking-widest">Dokumen</a>
            <a href="{{ route('home') }}#berita" class="text-[11px] font-bold text-slate-500 hover:text-red-600 transition-all uppercase tracking-widest">Warta</a>
            <a href="{{ route('home') }}#kontak" class="text-[11px] font-bold text-slate-500 hover:text-red-600 transition-all uppercase tracking-widest">Kontak</a>
        </nav>
    </div>

    <div class="flex items-center gap-4">
        <div class="hidden lg:flex items-center gap-2 px-3 py-1.5 bg-slate-100/50 border border-slate-200/50 rounded-full backdrop-blur-md">
            <div class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ ($systemOperational ?? true) ? 'bg-emerald-500' : 'bg-rose-500' }} opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 {{ ($systemOperational ?? true) ? 'bg-emerald-600' : 'bg-rose-600' }}"></span>
            </div>
            <span class="text-[9px] font-black {{ ($systemOperational ?? true) ? 'text-emerald-600' : 'text-rose-600' }} uppercase tracking-tighter">
                {{ ($systemOperational ?? true) ? 'System Operational' : 'Under Maintenance' }}
            </span>
        </div>
        <a href="https://helpdesk.unhas.ac.id/" target="_blank" class="hidden sm:inline-flex px-5 py-2 bg-red-600 border border-red-500 text-white text-[10px] font-black rounded-lg hover:bg-red-700 transition-all uppercase tracking-widest shadow-xl shadow-red-600/20">Tanya IT Helpdesk</a>
        
        <!-- Mobile Menu Toggle -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="flex md:hidden p-2 rounded-xl text-slate-900 transition-colors hover:bg-slate-100">
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
            <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
    </div>

    <!-- Mobile Menu Overlay -->
    <div x-show="mobileMenuOpen" x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute top-20 left-6 right-6 bg-white rounded-[2rem] shadow-2xl border border-slate-100 p-8 md:hidden z-50">
        <nav class="flex flex-col gap-6">
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#layanan" class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Layanan</a>
            
            <div class="space-y-3">
                <button @click="mobileProfileOpen = !mobileProfileOpen" 
                    class="flex items-center justify-between w-full text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">
                    Profile
                    <svg class="w-3 h-3 transition-transform" :class="mobileProfileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div x-show="mobileProfileOpen" x-cloak 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="grid grid-cols-1 gap-2 mt-2">
                    <a href="{{ route('profile.vision-mission') }}" wire:navigate class="px-4 py-2.5 bg-slate-50 rounded-xl text-[9px] font-black uppercase tracking-widest text-slate-600 hover:bg-red-50 hover:text-red-600 transition-all">Visi & Misi</a>
                    <a href="{{ route('profile.history') }}" wire:navigate class="px-4 py-2.5 bg-slate-50 rounded-xl text-[9px] font-black uppercase tracking-widest text-slate-600 hover:bg-red-50 hover:text-red-600 transition-all">Sejarah</a>
                    <a href="{{ route('profile.organization') }}" class="px-4 py-2.5 bg-slate-50 rounded-xl text-[9px] font-black uppercase tracking-widest text-slate-600 hover:bg-red-50 hover:text-red-600 transition-all">Tim Kami</a>
                </div>
            </div>

            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#dokumen" class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Dokumen</a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#berita" class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Warta</a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#kontak" class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Kontak</a>
            
            <a href="https://helpdesk.unhas.ac.id/" target="_blank" class="w-full py-4 bg-red-600 text-white text-center text-xs font-black rounded-xl uppercase tracking-widest shadow-xl shadow-red-600/20 mt-4">Tanya IT Helpdesk</a>
        </nav>
    </div>
</header>
