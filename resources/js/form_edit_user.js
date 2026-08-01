import { Offcanvas } from 'bootstrap';

document.querySelectorAll('.btn-edit-user').forEach(button => {

    button.addEventListener('click', function () {

        document.getElementById('edit_nama_user').value =
            this.dataset.nama;

        document.getElementById('edit_email').value =
            this.dataset.email;

        document.getElementById('edit_no_tlp').value =
            this.dataset.telp;

        document.getElementById('editUserForm').action =
            this.dataset.action;

        const preview =
            document.getElementById('preview_foto_profile');

        if (this.dataset.foto) {

            preview.src = this.dataset.foto;

            preview.style.display = 'block';

        } else {

            preview.style.display = 'none';

        }

        new Offcanvas(
            document.getElementById('editUserOffcanvas')
        ).show();

    });

});