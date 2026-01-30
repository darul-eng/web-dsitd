<div class="max-w-[1200px] mx-auto font-inter">
    <!-- Header Area -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 bg-white p-5 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1.5 h-full bg-red-600"></div>
        <div class="flex flex-col gap-1">
            <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-red-600">Dashboard</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                <a href="{{ route('admin.members.index') }}" class="hover:text-red-600">Personnel</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                <span class="text-slate-900">{{ $memberModel ? 'Sunting' : 'Baru' }}</span>
            </nav>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                {{ $memberModel ? 'Sunting Personnel' : 'Tambah Personnel Baru' }}
            </h1>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.members.index') }}" class="px-6 py-2.5 text-[11px] font-bold text-slate-500 hover:text-slate-900 transition-colors uppercase tracking-widest bg-slate-50 rounded-lg border border-slate-200">
                Kembali
            </a>
            <button type="submit" form="member-form" class="px-8 py-2.5 bg-red-600 text-white text-[11px] font-bold rounded-lg hover:bg-red-700 transition-all shadow-lg shadow-red-600/20 uppercase tracking-widest">
                <span wire:loading.remove wire:target="save">Simpan Data</span>
                <span wire:loading wire:target="save">Memproses...</span>
            </button>
        </div>
    </div>

    <form wire:submit="save" id="member-form" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Photo & Basic Status -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-center">
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6">Foto Profil Personnel</h3>
                
                <div class="relative w-48 h-64 mx-auto group cursor-pointer">
                    <div class="absolute inset-0 rounded-2xl border-4 border-dashed border-slate-100 group-hover:border-red-200 transition-all overflow-hidden flex items-center justify-center bg-slate-50">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover rounded-xl">
                        @elseif ($memberModel && $memberModel->image)
                            <img src="{{ asset('storage/' . $memberModel->image) }}" class="absolute inset-0 w-full h-full object-cover rounded-xl">
                        @else
                            <div class="text-center p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-200 mx-auto mb-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <p class="text-[10px] font-bold text-slate-300 uppercase">Klik untuk Unggah Foto</p>
                            </div>
                        @endif
                        <input type="file" wire:model="image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    </div>
                </div>
                @error('image') <p class="mt-3 text-[10px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
                <p class="mt-4 text-[9px] text-slate-400 font-medium italic italic leading-tight px-4">*Gunakan foto rasio 3:4 dengan resolusi baik.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-5">
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Urutan & Visibilitas</h3>
                
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Urutan Tampilan</label>
                    <input wire:model="order" type="number" class="w-full px-4 py-2 text-sm font-bold bg-slate-50 border border-slate-200 rounded-lg outline-none focus:border-red-500 transition-all">
                    <p class="text-[9px] text-slate-400 font-medium italic">Urutan kecil tampil lebih awal.</p>
                </div>

                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-100">
                    <span class="text-[11px] font-bold text-slate-600 uppercase tracking-tight">Status Aktif</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="is_active" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Right Column: Personal Details -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-6">
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest border-b border-slate-100 pb-4">Informasi Utama</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5 md:col-span-2">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Lengkap & Gelar</label>
                        <input wire:model="fullname" type="text" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl outline-none focus:border-red-500 transition-all outline-none" placeholder="Mis: Dr. Nama Lengkap, M.T.">
                        @error('fullname') <p class="text-[10px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIP / ID Pegawai</label>
                        <input wire:model="nip" type="text" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl outline-none focus:border-red-500" placeholder="Opsional...">
                        @error('nip') <p class="text-[10px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jabatan</label>
                        <input wire:model="position" type="text" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl outline-none focus:border-red-500" placeholder="Mis: Kepala Bagian IT">
                        @error('position') <p class="text-[10px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Grup Struktur</label>
                        <select wire:model="position_group" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl outline-none focus:border-red-500">
                            <option value="pimpinan">Pimpinan</option>
                            <option value="pengelola">Pengelola (Manajerial)</option>
                            <option value="staff">Staf Administrasi</option>
                            <option value="teknisi">Tim Teknis / Teknisi</option>
                            <option value="others">Lainnya</option>
                        </select>
                    </div>
                </div>

                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest border-b border-slate-100 pb-4 pt-6">Kontak & Lokasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Alamat Email</label>
                        <input wire:model="email" type="email" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl outline-none focus:border-red-500" placeholder="email@unhas.ac.id">
                        @error('email') <p class="text-[10px] font-bold text-rose-500 italic">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Telepon / WhatsApp</label>
                        <input wire:model="phone" type="text" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl outline-none focus:border-red-500" placeholder="08...">
                    </div>
                    <div class="space-y-1.5 md:col-span-2">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Alamat Rumah / Kantor</label>
                        <textarea wire:model="address" class="w-full px-4 py-2.5 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl outline-none focus:border-red-500 min-h-[80px]" placeholder="Masukkan alamat lengkap..."></textarea>
                    </div>
                </div>

                <h3 x-data="{ open: false }" class="mt-8 border border-slate-100 rounded-xl overflow-hidden">
                    <button type="button" @click="open = !open" class="w-full flex items-center justify-between p-4 bg-slate-50/50 hover:bg-slate-50 transition-colors">
                        <span class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em]">Data Tambahan (Biodata)</span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                    </button>
                    <div x-show="open" x-collapse class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tempat Lahir</label>
                                <input wire:model="place_of_birth" type="text" class="w-full px-4 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg outline-none focus:border-red-500">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Lahir</label>
                                <input wire:model="date_of_birth" type="date" class="w-full px-4 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg outline-none focus:border-red-500">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Kelamin</label>
                                <select wire:model="gender" class="w-full px-4 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg outline-none transition-all">
                                    <option value="">Pilih...</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Agama</label>
                                <select wire:model="religion" class="w-full px-4 py-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg outline-none transition-all">
                                    <option value="">Pilih...</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </h3>
            </div>
        </div>
    </form>
</div>
