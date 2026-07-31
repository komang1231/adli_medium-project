document.addEventListener('click', (e) => {

    if (!e.target.matches('#modalActionButton')) return;

    const modal = e.target.closest('.modal');

    const modalForm = modal.querySelector('#modalActionForm');
    const modalMode = modal.querySelector('#modalMode');

    if (modalMode.value === 'submit') {

        modalForm.submit();

        return;

    }

    if (modalMode.value === 'callback' && window.modalCallback) {

        window.modalCallback();

    }

});