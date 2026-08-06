<div class="row">

    <div class="col-md-12">

        <div class="form-group mb-4">

            <label class="form-label">
                Nama Category
            </label>

            <input
                type="text"
                name="nama_category"
                class="form-control">

        </div>

    </div>

    <div class="col-md-12">

        <button
            type="submit"
            id="btn-tambah-category"
            class="btn btn-submit">

            <span id="btn-tambah-spinner" class="spinner d-none"></span>
            <span id="btn-tambah-text">Simpan</span>

        </button>

    </div>

</div>
@vite(['resources/js/button/category-button.js', 'resources/css/button.css'])