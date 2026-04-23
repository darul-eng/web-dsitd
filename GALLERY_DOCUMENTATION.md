# 📸 Gallery Showcase - Dokumentasi Lengkap

## 🎯 Overview
Gallery showcase yang estetik dan interaktif pada halaman landing DSITD. Menggunakan gaya "Immersive Modern Slider" dengan transisi sinematik, fitur *auto-play* dengan indikator progress, *borderless modal*, serta optimal untuk berbagai perangkat (desktop & mobile).

## 📍 Location
- **File Utama:** `resources/views/livewire/public/gallery-showcase.blade.php`
- **File Integrasi:** `resources/views/livewire/public/home.blade.php` (dipanggil via `<livewire:public.gallery-showcase />`)
- **Component:** Livewire (Backend) & Alpine.js dengan `galleryShowcase()` (Frontend State)

## 🎨 Fitur Utama

### 1. Gallery Card Grid (Beranda)
Menampilkan galeri dalam grid responsif:
- ✅ Efek *zoom* gambar saat di-hover (`scale-110`)
- ✅ Gradasi bayangan memudar (`bg-gradient-to-t`) 
- ✅ Badge cerdas untuk menampilkan jumlah foto
- ✅ Kategori dan tanggal rilis kegiatan otomatis

### 2. Immersive Slider Modal
Modal slider modern yang difokuskan pada keterpaparan gambar:
- ✅ **Borderless Design:** Area slider tanpa sudut melengkung tajam (`rounded-none`) untuk fiksasi sinematik.
- ✅ **Auto-Play & Progress Bar:** Timer otomatis (5000ms) dengan garis progres animasi linier di dasar gambar.
- ✅ **Dot Navigation:** Navigasi titik minimalis di sudut kanan bawah yang merespons status aktif (membesar/memanjang).
- ✅ **Arrow Navigation:** Panah hover gelap transparan dengan *backdrop-blur*.
- ✅ **Typography Contrast:** Overlay gradien hitam dari bawah agar deskripsi teks cerah dan terbaca tajam (*text-glow*).

### 3. Fullscreen Lightbox
Zoom penuh gambar tanpa hambatan layout:
- ✅ **Alpine Teleport:** Dirender langsung di dalam `<body>` menggunakan `<template x-teleport="body">` untuk menghindari konflik hirarki z-index.
- ✅ Latar belakang blur solid (`bg-slate-950/95 backdrop-blur-xl`).
- ✅ Otomatis menjeda (pause) timer *auto-play* saat gambar dibuka penuh.
- ✅ Melanjutkan timer saat lightbox ditutup.

### 4. Mobile & Touch Optimizations
- ✅ **Touch Swipe Gesture:** Dukungan sentuh geser layar ke kiri/kanan (Threshold 50px).
- ✅ Navigasi titik (dots) yang bersahabat untuk di-tap pada mobile.

## ⌨️ Keyboard & Gesture Control

| Input | Action |
|---------|--------|
| `Click (Image)` | Buka Fullscreen Lightbox |
| `Swipe Left` | Lanjut ke gambar berikutnya |
| `Swipe Right` | Kembali ke gambar sebelumnya |
| `Click (Close)` | Tutup modal/lightbox |

## 🎬 Animation Timings

```javascript
// Auto-Play
- Interval: 5000ms (5 Detik per slide)
- Progress Bar: Linear transition

// Slide Enter (Masuk)
- Duration: 700ms
- Easing: ease-out
- Effect: opacity-0 scale-105 → opacity-100 scale-100

// Slide Leave (Keluar)
- Duration: 500ms
- Easing: ease-in
- Effect: opacity-100 scale-100 → opacity-0 scale-95
```

## 🎨 Color Palette & Theming

```css
/* Backgrounds */
Backdrop Modal: bg-black/40 backdrop-blur-sm
Slider Base: bg-black
Lightbox Full: bg-slate-950/95 backdrop-blur-xl

/* UI Elements */
Arrows: bg-black/60 hover:bg-black/90 text-white
Dots (Active): w-6 bg-white
Dots (Inactive): w-1.5 bg-white/50 hover:bg-white/80
Progress Bar: bg-white to bg-white/10
Overlay Gradient: from-black/90 via-black/40 to-transparent
```

## 🔧 Panduan Kustomisasi

### Mengubah Kecepatan Auto-Play
Buka `gallery-showcase.blade.php`, cari fungsi `Alpine.data('galleryShowcase', ...)`
```javascript
// Ubah nilai berikut (dalam milidetik)
slideInterval: 5000, 
```

### Mengubah Ukuran Modal
Buka `gallery-showcase.blade.php`, cari *container* area slider.
```html
<!-- Default: max-w-4xl h-[60vh] min-h-[300px] -->
<div class="relative w-full max-w-4xl h-[60vh] min-h-[300px]...">
```
Tingkatkan `max-w-4xl` menjadi `max-w-6xl` atau full layar dengan `w-screen h-screen` sesuai preferensi.

## 🐛 Troubleshooting

### Timer Tidak Berjalan
- Pastikan variabel `this.timer` diregistrasi dengan benar di object Alpine.
- Cek console browser, pastikan tidak ada sintaks Alpine yang terputus (contoh: `<template>` tidak ditutup).

### Z-Index Lightbox Tertimpa
- Pastikan menggunakan direktif `<template x-teleport="body">` pada block lightbox.

---

**Last Updated:** April 23, 2026
**Version:** 3.0 (Immersive Slider Edition)
**Status:** Production Ready ✅

