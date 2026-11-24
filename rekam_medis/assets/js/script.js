document.addEventListener('DOMContentLoaded', function () {
    // 1. Sidebar Toggle Mobile
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });
    }

    // 2. Buat Elemen Modal Konfirmasi Hapus secara Otomatis
    const modalHTML = `
        <div class="modal-overlay" id="customConfirmModal">
            <div class="modal-box">
                <div class="modal-icon">⚠️</div>
                <div class="modal-title">Konfirmasi Hapus</div>
                <div class="modal-text">Apakah Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.</div>
                <div class="modal-actions">
                    <button class="btn btn-secondary" id="btnModalCancel">Batal</button>
                    <a href="#" class="btn btn-danger" id="btnModalConfirm">Hapus Data</a>
                </div>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', modalHTML);

    const modal = document.getElementById('customConfirmModal');
    const btnCancel = document.getElementById('btnModalCancel');
    
    if (btnCancel) {
        btnCancel.addEventListener('click', function() {
            modal.classList.remove('active');
        });
    }

    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
    }

    // 3. Tangkap Parameter URL dan Tampilkan Toast Sesuai Aksi
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status) {
        if (status === 'tambah') {
            showToast('✓ Data berhasil ditambahkan.', 'success');
        } else if (status === 'update') {
            showToast('✓ Data berhasil diperbarui.', 'success');
        } else if (status === 'hapus') {
            showToast('✓ Data berhasil dihapus.', 'danger');
        } else if (status === 'gagal') {
            showToast('✕ Operasi gagal dilakukan.', 'error');
        }

        // Hapus parameter ?status=... dari URL agar bersih saat refresh
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});

// Fungsi Toast Melayang (Kanan Atas)
function showToast(message, type = 'success') {
    let toastContainer = document.getElementById('toastContainer');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toastContainer';
        toastContainer.className = 'toast-container';
        document.body.appendChild(toastContainer);
    }

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <span>${message}</span>
        <button onclick="this.parentElement.remove()" class="toast-close">&times;</button>
    `;

    toastContainer.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('show');
    }, 10);

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3500);
}

// Global Trigger Modal Hapus
function konfirmasiHapus(url) {
    const modal = document.getElementById('customConfirmModal');
    const btnConfirm = document.getElementById('btnModalConfirm');
    
    if (modal && btnConfirm) {
        btnConfirm.setAttribute('href', url);
        modal.classList.add('active');
    } else {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = url;
        }
    }
}