document.addEventListener('DOMContentLoaded', function () {
    const addMember = document.getElementById('form-add-member');
    const editMember = document.getElementById('editMemberForm');
    if (!addMember) return; // biar aman kalau script ke-load di halaman lain yang nggak ada form ini

    addMember.addEventListener('submit', function () {
        document.getElementById('btn-tambah-transaksi').disabled = true;   
        document.getElementById('btn-tambah-spinner').classList.remove('d-none');
        document.getElementById('btn-tambah-text').textContent = 'Menyimpan...';
    });

    editMember.addEventListener('submit', function () {
        document.getElementById('btn-edit-transaksi').disabled = true;
        document.getElementById('btn-edit-spinner').classList.remove('d-none');
        document.getElementById('btn-edit-text').textContent = 'Menyimpan...';
    });

});