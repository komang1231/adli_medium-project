import { Modal } from 'bootstrap';

document.querySelectorAll('.btn-force-delete-category').forEach(button => {

    button.addEventListener('click', function () {

        document.getElementById('forceDeleteCategoryName').textContent =
            this.dataset.name;

        const modal = new Modal(
            document.getElementById('forceDeleteCategoryModal')
        );

        const modalForm = document.getElementById('modalActionForm');

        document.getElementById('modalMode').value = 'submit';

        modalForm.action = this.dataset.action;

        document.getElementById('modalMethod').value = 'DELETE';

        modal.show();

    });

});