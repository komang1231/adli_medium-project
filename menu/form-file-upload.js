document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-file-input]').forEach((input) => {
        input.addEventListener('change', () => {
            const label = input.closest('.form-group').querySelector('[data-file-name]');
            if (!label) return;
            label.textContent = input.files.length ? input.files[0].name : 'Belum ada file dipilih';
        });
    });
});
