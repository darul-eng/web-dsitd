{{-- Modal Profile Organization, styled after struktur.html --}}
<div class="modal-overlay" id="profileModalOverlay" x-show="showModal" x-cloak @click.self="showModal = false">
    <button class="btn-close-float" @click="showModal = false">&times;</button>
    <div class="modal-card">
        <div class="glow glow-1"></div>
        <div class="glow glow-2"></div>
        <div class="modal-left">
            <img :src="activeHotspot?.image" alt="Foto Profil" class="profile-img">
            <div class="status-badge">
                <div class="dot"></div>
                Available for projects
            </div>
        </div>
        <div class="modal-right">
            <span class="label-id"><i class="fa-solid fa-sparkles"></i> Identity Card</span>
            <h2 x-text="activeHotspot?.name || '-'">Nama</h2>
            <div class="info-list">
                <div class="info-item">
                    <div class="icon-box"><i class="fa-solid fa-user-tie"></i></div>
                    <div class="info-text">
                        <span>Jabatan</span>
                        <p x-text="activeHotspot?.role || '-' "></p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="icon-box"><i class="fa-regular fa-envelope"></i></div>
                    <div class="info-text">
                        <span>Email</span>
                        <p x-text="activeHotspot?.email || '-' "></p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="icon-box"><i class="fa-solid fa-location-dot"></i></div>
                    <div class="info-text">
                        <span>Base Location</span>
                        <p x-text="activeHotspot?.location || '-' "></p>
                    </div>
                </div>
            </div>
            <div class="stats-row">
                <div class="stat-item">
                    <h4 x-text="activeHotspot?.projects || 0"></h4>
                    <p>Proyek</p>
                </div>
                <div class="stat-item">
                    <h4 x-text="activeHotspot?.exp || '0th'"></h4>
                    <p>Exp</p>
                </div>
                <div class="stat-item">
                    <h4 x-text="activeHotspot?.clients || 0"></h4>
                    <p>Klien</p>
                </div>
            </div>
            <div class="modal-footer">
                <div class="socials">
                    <template x-if="activeHotspot?.instagram"><a :href="activeHotspot.instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a></template>
                    <template x-if="activeHotspot?.linkedin"><a :href="activeHotspot.linkedin" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></template>
                    <template x-if="activeHotspot?.twitter"><a :href="activeHotspot.twitter" target="_blank"><i class="fa-brands fa-twitter"></i></a></template>
                </div>
                <button class="close-action" @click="showModal = false">CLOSE</button>
            </div>
        </div>
    </div>
</div>
