document.addEventListener('DOMContentLoaded', function () {
    const addMenu = document.getElementById('form-add-menu');
    const editMenu = document.getElementById('editMenuForm');
    if (!addMenu) return; // biar aman kalau script ke-load di halaman lain yang nggak ada form ini
    addMenu.addEventListener('submit', function () {
        document.getElementById('btn-tambah-menu').disabled = true
        document.getElementById('btn-tambah-spinner').classList.remove('d-none');
        document.getElementById('btn-tambah-text').textContent = 'Menyimpan...';
    });

    editMenu.addEventListener('submit', function () {
        document.getElementById('btn-edit-menu').disabled = true;
        document.getElementById('btn-edit-spinner').classList.remove('d-none');
        document.getElementById('btn-edit-text').textContent = 'Menyimpan...';
    });

});