<div class="row">

    <div class="col-md-12">

        <!-- Nama -->
        <div class="form-group mb-4">

            <label class="form-label">

                Nama Menu

            </label>

            <input type="text" id="edit_nama_menu" name="nama_menu"
                class="form-control @error('nama_menu') is-invalid @enderror">

            @error('nama_menu')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <!-- Harga -->
        <div class="form-group mb-4">

            <label class="form-label">

                Harga

            </label>

            <input type="number" id="edit_harga" name="harga"
                class="form-control @error('harga') is-invalid @enderror">

            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <!-- Stok -->
        <div class="form-group mb-4">

            <label class="form-label">

                Stok

            </label>

            <input type="number" id="edit_stok" name="stok"
                class="form-control @error('stok') is-invalid @enderror">

            @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <!-- Kategori -->
        <label class="form-label">

            Kategori

        </label>
        
        <x-form.tom-select id="category_id" name="category_id" :options="$categories" valueField="id"
            labelField="nama_category" placeholder="Pilih Kategori" />

        <!-- Foto -->
        <div class="form-group mb-3">

            <label class="form-label">

                Foto

            </label>

            <input type="file" id="edit_foto_menu" name="foto_menu" class="form-control">

        </div>

    </div>

    <div class="col-md-12">

        <button id="btn-edit-menu" type="submit" class="btn btn-submit">

            <span id="btn-edit-spinner" class="spinner d-none"></span>
            <span id="btn-edit-text">Submit</span>

        </button>

    </div>

</div>
@vite(['resources/js/button/menu-button.js', 'resources/css/button.css'])
