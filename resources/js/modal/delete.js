import { Modal } from 'bootstrap';

let modalCallback = null;

document.querySelectorAll('.btn-delete-category').forEach(button => {

    button.addEventListener('click', function () {

        const used = Number(this.dataset.used);
        const modalElement = document.getElementById('deleteCategoryModal');

        const modal = new Modal(modalElement);

        const modalForm = modalElement.querySelector('#modalActionForm');
        const modalMethod = modalElement.querySelector('#modalMethod');
        const modalMode = modalElement.querySelector('#modalMode');
        const modalButton = document.getElementById('modalActionButton');

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

        document.getElementById('deleteCategoryName').textContent =
            this.dataset.name;

        modalForm.action = this.dataset.action;

        modalMethod.value = 'DELETE';

        modalMode.value = 'submit';

        modal.show();

    });

});