{{-- Profile detail modal, shown when a Pimpinan card is clicked --}}
<div class="modal-overlay" id="profileModalOverlay" x-show="showModal" x-cloak @click.self="showModal = false">
    <button class="btn-close-float" @click="showModal = false">&times;</button>
    <div class="modal-card">
        <div class="glow glow-1"></div>
        <div class="glow glow-2"></div>
        <div class="modal-left">
            <img :src="activeHotspot?.image" alt="Foto Profil" class="profile-img">
        </div>
        <div class="modal-right">
            <span class="label-id"><i class="fa-solid fa-id-badge"></i> Profil Pimpinan</span>
            <h2 x-text="activeHotspot?.name || '-'">Nama</h2>
            <p class="role" x-text="activeHotspot?.role || '-'"></p>
            <div class="info-list">
                <div class="info-item">
                    <div class="icon-box"><i class="fa-solid fa-id-card"></i></div>
                    <div class="info-text">
                        <span>NIP</span>
                        <p x-text="activeHotspot?.nip || '-'"></p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="icon-box"><i class="fa-regular fa-envelope"></i></div>
                    <div class="info-text">
                        <span>Email</span>
                        <p x-text="activeHotspot?.email || '-'"></p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="icon-box"><i class="fa-solid fa-phone"></i></div>
                    <div class="info-text">
                        <span>Telepon</span>
                        <p x-text="activeHotspot?.phone || '-'"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="close-action" @click="showModal = false">TUTUP</button>
            </div>
        </div>
    </div>
</div>
