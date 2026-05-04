<div class="min-h-screen flex items-center justify-center p-6 bg-slate-50">
    <div class="max-w-md w-full">
        <!-- Logo/Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-32 h-20 bg-white rounded-3xl shadow-xl shadow-slate-200/50 mb-6 group transition-transform hover:scale-105 duration-300 border border-slate-100 p-4">
                <img src="{{ asset('img/logo-dark.png') }}" alt="Logo" class="w-full h-auto object-contain">
            </div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h2>
            <p class="mt-2 text-sm text-slate-500 font-medium">Silakan masuk ke akun admin DSITD Anda</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 p-10 border border-slate-100">
            {{-- Error Alert --}}
            @if (session()->has('error') || $errors->any())
                <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-rose-500 flex items-center justify-center text-white shrink-0 shadow-lg shadow-rose-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-bold text-rose-800 uppercase tracking-widest leading-none mb-1">Gagal Masuk</p>
                        <p class="text-[11px] text-rose-600 font-medium">
                            @if(session()->has('error'))
                                {{ session('error') }}
                            @else
                                Periksa kembali email dan password Anda.
                            @endif
                        </p>
                    </div>
                    <button @click="show = false" class="text-rose-300 hover:text-rose-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            @endif

            <form wire:submit="login" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 ml-1 mb-2">Email Address</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-red-500 transition-colors">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input wire:model="email" id="email" type="email" autocomplete="email" required
                            class="block w-full pl-11 pr-4 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 text-sm placeholder-slate-400 focus:ring-2 focus:ring-red-500 transition-all outline-none"
                            placeholder="admin@unhas.ac.id">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 ml-1 mb-2">Password</label>
                    <div class="relative group" x-data="{ show: false }">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-red-500 transition-colors">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input wire:model="password" id="password" :type="show ? 'text' : 'password'" autocomplete="current-password" required
                            class="block w-full pl-11 pr-12 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 text-sm placeholder-slate-400 focus:ring-2 focus:ring-red-500 transition-all outline-none"
                            placeholder="••••••••">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                            <template x-if="show">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </template>
                            <template x-if="!show">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </template>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center space-x-2 cursor-pointer group">
                        <input wire:model="remember" type="checkbox" class="w-4 h-4 rounded-md border-slate-300 text-red-600 focus:ring-red-500 cursor-pointer">
                        <span class="text-xs font-semibold text-slate-500 group-hover:text-slate-700 transition-colors">Ingat Saya</span>
                    </label>
                    <a href="#" class="text-xs font-bold text-red-600 hover:text-red-700 transition-colors">Lupa Password?</a>
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="w-full py-4 px-6 bg-red-600 hover:bg-red-700 text-white font-bold rounded-2xl shadow-lg shadow-red-600/30 transition-all transform hover:-translate-y-0.5 active:scale-[0.98] flex items-center justify-center space-x-2 disabled:opacity-70 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="login">Masuk ke Dashboard</span>
                    <span wire:loading wire:target="login">Memproses...</span>
                    
                    <svg wire:loading.remove wire:target="login" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                    
                    <!-- Loading Spinner -->
                    <svg wire:loading wire:target="login" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <p class="mt-8 text-center text-xs text-slate-400 font-medium tracking-wide">
            &copy; 2026 DSITD Universitas Hasanuddin. All rights reserved.
        </p>
    </div>
</div>