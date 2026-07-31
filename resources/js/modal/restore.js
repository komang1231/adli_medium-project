import { Modal } from 'bootstrap';

document.querySelectorAll('.btn-restore-category').forEach(button => {

    button.addEventListener('click', function () {

        document.getElementById('restoreCategoryName').textContent =
            this.dataset.name;

        const modal = new Modal(
            document.getElementById('restoreCategoryModal')
        );

        const modalForm = document.getElementById('modalActionForm');

        document.getElementById('modalMode').value = 'submit';

        modalForm.action = this.dataset.action;

        document.getElementById('modalMethod').value = 'PATCH';

        modal.show();

    });

});