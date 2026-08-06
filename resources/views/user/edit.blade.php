<div class="row">

    <div class="col-md-12">

        {{-- Preview Foto --}}
        <div class="text-center mb-4">

            <img
                id="preview_foto_profile"
                src=""
                alt="Preview"
                class="rounded-circle border"
                style="
                    width:120px;
                    height:120px;
                    object-fit:cover;
                    display:none;
                ">

        </div>

        {{-- Foto --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Foto Profile

            </label>

            <input
                type="file"
                id="edit_foto_profile"
                name="foto_profile"
                class="form-control">

        </div>

        {{-- Nama --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Nama User

            </label>

            <input
                type="text"
                id="edit_nama_user"
                name="nama_user"
                class="form-control">

        </div>

        {{-- Email --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Email

            </label>

            <input
                type="email"
                id="edit_email"
                name="email"
                class="form-control">

        </div>

        {{-- Nomor HP --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Nomor HP

            </label>

            <input
                type="text"
                id="edit_no_tlp"
                name="no_tlp"
                class="form-control">

        </div>

    </div>

    <div class="col-md-12">

        <button
            id="btn-edit-user"
            type="submit"
            class="btn btn-submit">

            <span id="btn-edit-spinner" class="spinner d-none"></span>
            <span id="btn-edit-text">Submit</span>

        </button>
    </div>
</div>
@vite(['resources/js/button/user-button.js', 'resources/css/button.css'])