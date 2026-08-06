document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // ganti selector kalau form-nya punya id/class khusus
    const btn = document.getElementById('btn-login');
    const btnText = document.getElementById('btn-login-text');
    const btnSpinner = document.getElementById('btn-login-spinner');

    form.addEventListener('submit', function () {
        btn.disabled = true;
        btnText.classList.add('d-none');
        btnSpinner.classList.remove('d-none');
    });
});