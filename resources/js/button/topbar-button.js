document.addEventListener('DOMContentLoaded', function() {
    const topbarTransaksi = document.getElementById('transaksi-button');
    const topbarPelanggan = document.getElementById('pelanggan-form').querySelector('button');

    topbarTransaksi.addEventListener('click', function() {
        document.getElementById('transaksi-button').disabled = true;
        document.getElementById('transaksi-spinner').classList.remove('d-none');
        const btnText = document.getElementById('transaksi-text');
        btnText.classList.add('d-none');
    });

    topbarPelanggan.addEventListener('click', function() {
        document.getElementById('pelanggan-form').querySelector('button').disabled = true;
        document.getElementById('pelanggan-spinner').classList.remove('d-none');
        const btnText = document.getElementById('pelanggan-text');
        btnText.classList.add('d-none');
    });
});