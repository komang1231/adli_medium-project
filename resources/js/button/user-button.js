document.addEventListener('DOMContentLoaded', function () {
    const addUser = document.getElementById('form-add-user');
    const editUser = document.getElementById('editUserForm');
    if (!addUser) return; // biar aman kalau script ke-load di halaman lain yang nggak ada form ini

    addUser.addEventListener('submit', function () {
        document.getElementById('btn-tambah-user').disabled = true;
        document.getElementById('btn-tambah-spinner').classList.remove('d-none');
        document.getElementById('btn-tambah-text').textContent = 'Menyimpan...';
    });

    editUser.addEventListener('submit', function () {
        document.getElementById('btn-edit-user').disabled = true;
        document.getElementById('btn-edit-spinner').classList.remove('d-none');
        document.getElementById('btn-edit-text').textContent = 'Menyimpan...';
    });
});