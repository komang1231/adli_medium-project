import { Modal } from 'bootstrap';

document.querySelectorAll('.btn-delete-menu').forEach(button => {

    button.addEventListener('click', function () {

        document.getElementById('deleteMenuName').textContent =
            this.dataset.name;

        const modal = new Modal(
            document.getElementById('deleteMenuModal')
        );

        const modalForm = document.getElementById('modalActionForm');

        document.getElementById('modalMode').value = 'submit';

        modalForm.action = this.dataset.action;

        document.getElementById('modalMethod').value = 'DELETE';

        modal.show();

    });

});