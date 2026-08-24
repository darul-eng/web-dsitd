<footer id="kontak" class="bg-white border-t border-slate-100 pt-10 sm:pt-16 pb-6 sm:pb-10">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 sm:gap-10 mb-8 sm:mb-16">
            <div class="md:col-span-4">
                <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-3 mb-4 sm:mb-6">
                    <img src="{{ asset('img/logo-dark.png') }}" alt="Logo Lembaga Transformasi Digital & Kecerdasan Artifisial" class="h-10" loading="lazy">
                </a>
                <p class="text-sm text-slate-500 font-medium leading-relaxed mb-4 sm:mb-6 max-w-xs">
                    Lembaga Transformasi Digital dan Kecerdasan Artifisial adalah unit pengelola transformasi digital dan AI di lingkungan Universitas Hasanuddin.
                </p>
                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <div class="md:col-span-2">
                <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-4 sm:mb-6">Layanan</h4>
                <ul class="space-y-2 sm:space-y-3">
                    <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">Email UNHAS</a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">Web Hosting</a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">SIAKAD</a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">VPN Access</a></li>
                </ul>
            </div>

            <div class="md:col-span-2">
                <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-4 sm:mb-6">Tautan</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">Pusat Bantuan</a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">Status Layanan</a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-red-600 transition-colors tracking-tight">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="md:col-span-4">
                <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-4 sm:mb-6">Lokasi Kami</h4>
                <div class="p-5 bg-slate-50 rounded-2xl border border-slate-100 italic text-xs text-slate-600 font-medium leading-loose">
                    Lantai 1, Gedung Perpustakaan Pusat,<br/>
                    Kampus UNHAS Tamalanrea,<br/>
                    Jl. Perintis Kemerdekaan KM.10,<br/>
                    Makassar, Sulawesi Selatan.
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-3 border-t border-slate-100 pt-5 sm:pt-8">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">© 2024 TransDiKA Universitas Hasanuddin. All rights reserved.</p>
            <div class="flex items-center gap-8">
                <a href="#" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">Term of Service</a>
                <a href="#" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">Digital Guidelines</a>
            </div>
        </div>
    </div>
</footer>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('livewire:navigated', () => {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-expo'
        });
    });

    AOS.init({
        duration: 1000,
        once: true,
        offset: 100,
        easing: 'ease-out-expo'
    });
</script>
<livewire:public.chat-bot />
