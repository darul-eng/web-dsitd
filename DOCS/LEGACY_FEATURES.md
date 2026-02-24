# Document: Legacy Application Features (web-dsti)

Dokumen ini berisi daftar lengkap fitur yang ada pada aplikasi lama (**web-dsti**) sebagai referensi untuk proses migrasi dan modernisasi ke aplikasi baru (**web-dsitd**).

## 1. Public Facing Features (Frontend)

### A. Informasi & Berita
*   **Berita Terbaru**: List berita terbaru di halaman landing.
*   **Kategori Berita**: Pengelompokan berita berdasarkan kategori (e.g., Pengumuman, Berita Utama).
*   **Pencarian Berita**: Fitur pencarian berita berdasarkan kata kunci.
*   **Detail Berita**: Halaman baca berita lengkap dengan dukungan gambar dan formatting.

### B. Profil Instansi
*   **Struktur Organisasi**: Halaman khusus yang menampilkan bagan atau struktur organisasi DSITD.
*   **Profil Direktur**: Halaman khusus untuk informasi pimpinan.
*   **Konten Profil Statis**: Halaman-halaman informasi seperti Visi, Misi, Sejarah, dsb (dinamis dari admin).

### C. Layanan & Fasilitas
*   **Direktori Layanan**: Daftar layanan yang disediakan oleh DSITD.
*   **Kategori Layanan**: Pengelompokan layanan agar mudah dicari.
*   **Detail Layanan**: Penjelasan detail mengenai prosedur atau deskripsi layanan.

### D. Media & Unduhan
*   **Galeri Foto**: Album foto kegiatan atau fasilitas.
*   **Dokumen Publik**: Koleksi dokumen/file yang dapat diunduh oleh publik.
*   **Formulir**: Daftar formulir atau template yang dapat didownload untuk kebutuhan layanan.

### E. FAQ
*   **Tanya Jawab (FAQ)**: Daftar pertanyaan yang sering diajukan beserta jawabannya.
*   **Kategori FAQ**: Pengelompokan FAQ berdasarkan topik.

### F. Kontak & Interaksi
*   **Halaman Kontak**: Informasi alamat, peta, dan nomor telepon.
*   **Formulir Hubungi Kami**: User dapat mengirimkan pesan langsung ke database.

---

## 2. Admin Panel Features (Backoffice)

### A. Dashboard
*   **Statistik Ringkas**: Summary data konten.
*   **Manajemen Profil Admin**: Update email dan password admin.

### B. Content Management System (CMS)
*   **Jumbotron Manager**: Mengatur slider/banner di halaman utama.
*   **News Editor**: CRUD Berita dengan integrasi *Laravel File Manager* untuk upload gambar di dalam teks.
*   **Service Manager**: CRUD Layanan dan kategorinya.
*   **Profile Manager**: CRUD konten halaman profil (Visi, Misi, dll).
*   **FAQ Manager**: CRUD daftar Tanya Jawab.
*   **Link Terkait**: Mengelola daftar link eksternal (Partner, Link Kampus).

### C. Resource Management
*   **Document Manager**: Upload dan kelola file dokumen/formulir (PDF, docx, dll).
*   **Image Gallery**: Upload foto-foto kegiatan.
*   **Membership Management**: Mengatur personil/pegawai dalam struktur organisasi (bisa diatur urutannya/sorting).

### D. Inbox & Communication
*   **Inbox Manager**: Melihat daftar pesan masuk dari frontend.
*   **Response System**: Admin dapat membalas pesan atau menandai pesan yang sudah diproses.

---

## 3. Superadmin Specific Features
*   **Admin Management**: Fitur untuk menambah, mengedit, atau menghapus akun Admin lain.
*   **Role Setup**: Pengaturan hak akses dasar (Admin vs Superadmin).

---

## 4. Technical Specifications (Legacy)
*   **Framework**: Laravel 8.
*   **CSS Framework**: Bootstrap (Bootslander Template).
*   **Database**: MySQL.
*   **Media Storage**: Local storage with public symbolic links.
*   **Asset Manager**: `unisharp/laravel-filemanager` untuk WYSIWYG editor.
