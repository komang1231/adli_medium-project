import { Modal, Offcanvas } from 'bootstrap';

document.querySelectorAll('.btn-edit-category').forEach(button => {

    button.addEventListener('click', function () {

        const used = Number(this.dataset.used);

        if (used > 0) {

            document.getElementById('warningCategoryName').textContent =
                this.dataset.name;

            document.getElementById('warningCategoryCount').textContent =
                used;

            new Modal(
                document.getElementById('warningCategoryModal')
            ).show();

            return;

        }

        document.getElementById('editCategoryName').textContent =
            this.dataset.name;

        const modal = new Modal(
            document.getElementById('editCategoryModal')
        );

        const modalForm = document.getElementById('modalActionForm');
        const modalButton = document.getElementById('modalActionButton');

        document.getElementById('modalMode').value = 'callback';

        window.modalCallback = () => {

            modal.hide();

            document.getElementById('edit_nama_category').value =
                this.dataset.name;

            document.getElementById('editForm').action =
                this.dataset.action;

            new Offcanvas(
                document.getElementById('editCategoryOffcanvas')
            ).show();

        };

        modal.show();

    });

});