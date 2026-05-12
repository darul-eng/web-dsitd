<div class="fixed bottom-8 right-8 z-[60]" x-data="{ isOpen: $wire.entangle('isOpen') }">
    <!-- Floating Action Button -->
    <button @click="isOpen = !isOpen" 
            class="w-16 h-16 rounded-full bg-slate-900 border border-slate-800 text-white shadow-[0_20px_50px_rgba(0,0,0,0.3)] flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 group overflow-hidden">
        <!-- Background Animation -->
        <div class="absolute inset-0 bg-gradient-to-tr from-red-600 to-rose-400 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        
        <!-- Icons -->
        <div class="relative z-10">
            <svg x-show="!isOpen" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0 rotate-90" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <svg x-show="isOpen" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0 -rotate-90" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <!-- Indicator -->
        <div class="absolute top-4 right-4 w-2.5 h-2.5 bg-emerald-500 rounded-full border-2 border-slate-900 z-20 shadow-sm animate-pulse"></div>
    </button>

    <!-- Chat Window -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-10 scale-95"
         class="absolute bottom-20 right-0 w-[calc(100vw-2rem)] sm:w-[330px] h-[480px] max-h-[70vh] glass rounded-[1.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.3)] border border-white/20 overflow-hidden flex flex-col backdrop-blur-3xl">
        
        <!-- Header -->
        <div class="px-6 py-5 bg-slate-900 text-white relative overflow-hidden shrink-0 border-b border-white/10">
            <div class="absolute top-0 right-0 w-32 h-32 bg-red-600 filter blur-[60px] opacity-20"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-1">
                    <div>
                        <h3 class="font-black tracking-tight text-base text-white leading-tight">DSITD AI Assistant</h3>
                        <p class="text-[9px] font-bold text-emerald-400 uppercase tracking-widest mt-0.5">Online & Powered by n8n</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 overflow-y-auto p-5 space-y-4 flex flex-col scroll-smooth">
            <!-- Bot Message -->
            <div class="flex gap-3">
                <div class="w-8 h-8 rounded-lg bg-slate-900 flex-shrink-0 flex items-center justify-center text-white">
                    <span class="text-[10px] font-black tracking-tighter">AI</span>
                </div>
                <div class="bg-slate-800/90 border border-white/10 p-3 rounded-2xl rounded-tl-none max-w-[90%] shadow-lg">
                    <p class="text-[11px] text-white leading-relaxed font-medium">Halo! Saya asisten cerdas DSITD. Ada yang bisa saya bantu terkait layanan IT, berita kampus, atau dokumen publik?</p>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white/5 border-t border-white/10 shrink-0">
            <div class="relative">
                <input type="text" 
                       placeholder="Tanyakan sesuatu..." 
                       class="w-full bg-slate-800/90 border border-white/20 rounded-xl px-4 py-3 text-xs text-white placeholder-slate-400 focus:outline-none focus:border-red-500/50 transition-colors pr-12 shadow-inner">
                <button class="absolute right-1.5 top-1.5 w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center text-white hover:bg-red-700 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/></svg>
                </button>
            </div>
            <p class="text-center text-[7px] font-bold text-slate-500 uppercase tracking-widest mt-3">AI may produce inaccurate information.</p>
        </div>
    </div>
</div>
