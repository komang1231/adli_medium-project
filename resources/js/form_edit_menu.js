import { Offcanvas } from 'bootstrap';

document.querySelectorAll('.btn-edit-menu').forEach(button => {

    button.addEventListener('click', function () {

        document.getElementById('edit_nama_menu').value =
            this.dataset.nama;

        document.getElementById('edit_harga').value =
            this.dataset.harga;

        document.getElementById('edit_stok').value =
            this.dataset.stok;

        document.getElementById('edit_category_id').value =
            this.dataset.category;

        document.getElementById('editMenuForm').action =
            this.dataset.action;

        const preview = document.getElementById('preview_foto_menu');

        if (this.dataset.foto) {

            preview.src = this.dataset.foto;
            preview.style.display = 'block';

        } else {

            preview.style.display = 'none';

        }

        new Offcanvas(
            document.getElementById('editMenuOffcanvas')
        ).show();

    });

});