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

        <!-- Foto -->
        <div class="form-group mb-4">

            <label class="form-label">

                Foto

            </label>

            <input type="file" id="edit_foto_menu" name="foto_menu" class="form-control">

        </div>

        <!-- Kategori -->
        <select id="edit_category_id" name="category_id" class="form-select">

            <option value="">

                Pilih Kategori

            </option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}">

                    {{ $category->nama_category }}

                </option>
            @endforeach

        </select>

    </div>

    <div class="col-md-12">

        <button type="submit" class="btn btn-submit">

            Submit

        </button>

    </div>

</div>
