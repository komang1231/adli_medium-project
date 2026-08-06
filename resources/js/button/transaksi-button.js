document.addEventListener('DOMContentLoaded', function () {
    const addTransaksi = document.getElementById('form-add-transaksi');
    const editTransaksi = document.getElementById('editTransaksiForm');
    if (!addTransaksi) return; // biar aman kalau script ke-load di halaman lain yang nggak ada form ini

    addTransaksi.addEventListener('submit', function () {
        document.getElementById('btn-tambah-transaksi').disabled = true;
        document.getElementById('btn-tambah-spinner').classList.remove('d-none');
        document.getElementById('btn-tambah-text').textContent = 'Menyimpan...';
    });

    editTransaksi.addEventListener('submit', function () {
        document.getElementById('btn-edit-transaksi').disabled = true;
        document.getElementById('btn-edit-spinner').classList.remove('d-none');
        document.getElementById('btn-edit-text').textContent = 'Menyimpan...';
    });
});