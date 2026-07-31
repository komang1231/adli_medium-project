document.querySelectorAll('.btn-open-edit').forEach(button => {

    button.addEventListener('click', function () {

        document.getElementById('editForm').action =
            this.dataset.action;

        document.getElementById('edit_nama_category').value =
            this.dataset.nama_category;

    });

});