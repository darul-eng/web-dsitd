<section class="py-32 bg-slate-50 border-y border-slate-100" aria-label="Galeri Kegiatan">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-6">
            <div class="max-w-xl">
                <h2 class="text-xs font-black text-red-600 uppercase tracking-widest mb-4">Kegiatan</h2>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Galeri Dokumentasi.</h1>
            </div>
            <p class="max-w-md text-sm text-slate-500 font-medium leading-relaxed">
                Klik salah satu kegiatan untuk melihat slider foto. Klik foto untuk mode fullscreen.
            </p>
        </div>

        <div
            x-data="galleryShowcase({{ \Illuminate\Support\Js::from($galleriesPayload) }})"
            class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="(gallery, index) in galleries" :key="gallery.uuid">
                    <button
                        type="button"
                        class="group text-left"
                        @click="openGallery(index)"
                        :disabled="!gallery.imagesCount"
                    >
                        <div class="relative rounded-[2rem] overflow-hidden border border-slate-100 bg-white aspect-[4/3]">
                            <template x-if="gallery.coverUrl">
                                <img :src="gallery.coverUrl" :alt="gallery.title" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
                            </template>
                            <template x-if="!gallery.coverUrl">
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></svg>
                                </div>
                            </template>

                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur text-[9px] font-black text-slate-900 rounded-full uppercase tracking-widest" x-text="(gallery.imagesCount || 0) + ' Foto'"></span>
                            </div>

                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="absolute bottom-4 left-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="inline-flex items-center gap-2 text-white text-[10px] font-black uppercase tracking-widest">
                                    <span>Lihat Galeri</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <div class="flex items-center gap-3 mb-2">
                                <template x-if="gallery.category">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest" x-text="gallery.category"></span>
                                </template>
                                <template x-if="gallery.category && gallery.date">
                                    <div class="w-1 h-1 bg-red-600 rounded-full"></div>
                                </template>
                                <template x-if="gallery.date">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest" x-text="gallery.date"></span>
                                </template>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight group-hover:text-red-600 transition-colors" x-text="gallery.title"></h3>
                        </div>
                    </button>
                </template>
            </div>

            <template x-if="!galleries.length">
                <div class="p-10 bg-white border border-slate-100 rounded-[2rem] text-center">
                    <p class="text-sm font-bold text-slate-500">Belum ada galeri yang dipublikasikan.</p>
                </div>
            </template>

            <!-- Slider Modal -->
            <div x-cloak x-show="modalOpen" class="fixed inset-0 z-[90] flex items-center justify-center p-4 md:p-10" aria-modal="true" role="dialog">
                <!-- Background Transparan dengan blur -->
                <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="closeGallery()"></div>

                <!-- Area Slider Diperkecil -->
                <div class="relative w-full max-w-4xl h-[70vh] md:h-[60vh] min-h-[400px] max-h-[700px] rounded-[2rem] overflow-hidden">

                    <!-- Close Modal -->
                    <button type="button" @click="closeGallery()" class="absolute top-4 right-4 w-10 h-10 bg-black/50 hover:bg-black/80 backdrop-blur-md text-white rounded-full flex items-center justify-center z-50 transition-all hover:scale-110" aria-label="Tutup">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <!-- Slides -->
                    <template x-for="(img, idx) in currentGallery?.images" :key="img.uuid">
                        <div x-show="imageIndex === idx"
                             x-transition:enter="transition ease-out duration-700"
                             x-transition:enter-start="opacity-0 scale-105"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-500"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute inset-0 w-full h-full cursor-zoom-in bg-black"
                             @click="openFullscreen()"
                             @touchstart="touchStartX = $event.changedTouches[0].screenX"
                             @touchend="handleTouchEnd($event)">

                            <img :src="img.url" :alt="img.caption || currentGallery?.title" class="absolute inset-0 w-full h-full object-cover">

                            <!-- Gradient Overlay -->
                            <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-black/90 via-black/40 to-transparent pointer-events-none"></div>

                            <!-- Content -->
                            <div class="absolute bottom-0 left-0 w-full p-6 md:p-10 text-white pointer-events-none">
                                <h4 class="text-2xl md:text-3xl font-bold tracking-tight mb-2 text-glow" x-text="img.caption || currentGallery?.title"></h4>
                                <template x-if="img.caption">
                                    <p class="text-white/80 text-xs md:text-sm font-medium tracking-wide uppercase" x-text="currentGallery?.title"></p>
                                </template>
                            </div>
                        </div>
                    </template>

                    <!-- Progress Bar -->
                    <div class="absolute bottom-0 left-0 w-full h-[4px] bg-white/10 z-40">
                        <div x-ref="progressBar" class="h-full w-0 bg-white"></div>
                    </div>

                    <!-- Navigation -->
                    <button type="button" @click="prevImage()" class="hidden md:flex absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/60 hover:bg-black/90 backdrop-blur-md text-white rounded-full items-center justify-center z-40 transition-all hover:scale-110" aria-label="Sebelumnya">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button type="button" @click="nextImage()" class="hidden md:flex absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/60 hover:bg-black/90 backdrop-blur-md text-white rounded-full items-center justify-center z-40 transition-all hover:scale-110" aria-label="Berikutnya">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>

                    <!-- Dots -->
                    <div class="absolute bottom-5 right-6 flex gap-2 z-40">
                        <template x-for="(img, idx) in currentGallery?.images" :key="idx">
                            <button @click="goToImage(idx)"
                                    class="h-1.5 rounded-full transition-all duration-300 shadow-sm"
                                    :class="imageIndex === idx ? 'w-6 bg-white' : 'w-1.5 bg-white/50 hover:bg-white/80'"
                                    :aria-label="'Slide ' + (idx + 1)">
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Fullscreen Lightbox -->
            <template x-teleport="body">
                <div x-cloak x-show="fullscreenOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-8" aria-modal="true" role="dialog">
                    <div class="fixed inset-0 bg-slate-950/95 backdrop-blur-xl" @click="closeFullscreen()"></div>

                    <button type="button" @click="closeFullscreen()" class="fixed top-6 right-6 w-14 h-14 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white rounded-full flex items-center justify-center z-[101] transition-all hover:scale-110 hover:rotate-90">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <div class="relative w-full h-full flex items-center justify-center z-[100] pointer-events-none">
                        <template x-if="currentImage?.url">
                            <img :src="currentImage.url" :alt="currentImage.caption" class="max-w-full max-h-full object-contain drop-shadow-2xl pointer-events-auto" @click.stop>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>

    @once
        <script>
            (() => {
                const register = () => {
                    if (!window.Alpine?.data) return;

                    Alpine.data('galleryShowcase', (payload) => {
                        const galleries = Array.isArray(payload) ? payload : [];

                        return {
                            galleries,
                            modalOpen: false,
                            fullscreenOpen: false,
                            galleryIndex: 0,
                            imageIndex: 0,
                            preventFullscreenUntil: 0,
                            timer: null,
                            slideInterval: 5000,
                            touchStartX: 0,

                            lockScroll() {
                                document.documentElement.classList.add('overflow-hidden');
                                document.body.classList.add('overflow-hidden');
                            },

                            unlockScroll() {
                                document.documentElement.classList.remove('overflow-hidden');
                                document.body.classList.remove('overflow-hidden');
                            },

                            get currentGallery() {
                                return this.galleries?.[this.galleryIndex] ?? null;
                            },

                            get currentImage() {
                                return this.currentGallery?.images?.[this.imageIndex] ?? null;
                            },

                            resetProgressBar() {
                                if(!this.$refs.progressBar) return;
                                this.$refs.progressBar.style.transition = 'none';
                                this.$refs.progressBar.style.width = '0%';
                                setTimeout(() => {
                                    if(this.modalOpen && !this.fullscreenOpen) {
                                        this.$refs.progressBar.style.transition = `width ${this.slideInterval}ms linear`;
                                        this.$refs.progressBar.style.width = '100%';
                                    }
                                }, 50);
                            },

                            startTimer() {
                                clearInterval(this.timer);
                                if (this.fullscreenOpen) return;
                                this.resetProgressBar();
                                this.timer = setInterval(() => {
                                    this.nextImage();
                                }, this.slideInterval);
                            },

                            stopTimer() {
                                clearInterval(this.timer);
                                if(this.$refs.progressBar) {
                                    this.$refs.progressBar.style.transition = 'none';
                                    this.$refs.progressBar.style.width = '0%';
                                }
                            },

                            openGallery(index) {
                                if (!this.galleries?.[index]?.images?.length) return;
                                this.galleryIndex = index;
                                this.imageIndex = 0;
                                this.modalOpen = true;
                                this.fullscreenOpen = false;
                                this.lockScroll();
                                this.preventFullscreenUntil = Date.now() + 350;
                                this.$nextTick(() => {
                                    this.startTimer();
                                });
                            },

                            closeGallery() {
                                this.modalOpen = false;
                                this.fullscreenOpen = false;
                                this.unlockScroll();
                                this.stopTimer();
                            },

                            goToImage(idx) {
                                this.imageIndex = idx;
                                this.startTimer();
                            },

                            nextImage() {
                                const total = this.currentGallery?.images?.length ?? 0;
                                if (!total) return;
                                this.imageIndex = (this.imageIndex + 1) % total;
                                this.startTimer();
                            },

                            prevImage() {
                                const total = this.currentGallery?.images?.length ?? 0;
                                if (!total) return;
                                this.imageIndex = (this.imageIndex - 1 + total) % total;
                                this.startTimer();
                            },

                            handleTouchEnd(e) {
                                const touchEndX = e.changedTouches[0].screenX;
                                if (this.touchStartX - touchEndX > 50) this.nextImage();
                                if (touchEndX - this.touchStartX > 50) this.prevImage();
                            },

                            openFullscreen() {
                                if (!this.currentImage?.url) return;
                                if (Date.now() < this.preventFullscreenUntil) return;
                                this.fullscreenOpen = true;
                                this.lockScroll();
                                this.stopTimer();
                            },

                            closeFullscreen() {
                                this.fullscreenOpen = false;
                                if (!this.modalOpen) {
                                    this.unlockScroll();
                                } else {
                                    this.startTimer();
                                }
                            },
                        };
                    });
                };

                document.addEventListener('alpine:init', register);
                register();
            })();
        </script>
    @endonce
</section>
