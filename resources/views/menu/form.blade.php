{{-- <div class="row">
    <div class="col-md-12">

        <div class="form-group mb-3">
            <label for="kode_menu" class="form-label">{{ __('Kode Menu') }}</label>
            <input type="text" name="kode_menu" class="form-control @error('kode_menu') is-invalid @enderror"
                value="{{ old('kode_menu') }}" id="kode_menu" placeholder="Kode Menu">
            {!! $errors->first('kode_menu', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="nama_menu" class="form-label">{{ __('Nama Menu') }}</label>
            <input type="text" name="nama_menu" class="form-control @error('nama_menu') is-invalid @enderror"
                value="{{ old('nama_menu') }}" id="nama_menu" placeholder="Nama Menu">
            {!! $errors->first('nama_menu', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="harga" class="form-label">{{ __('Harga') }}</label>
            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                value="{{ old('harga') }}" id="harga" placeholder="Harga">
            {!! $errors->first('harga', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="stok" class="form-label">{{ __('Stok') }}</label>
            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                value="{{ old('stok') }}" id="stok" placeholder="Stok">
            {!! $errors->first('stok', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        
        <div class="form-group mb-3">
            <label for="category_id" class="form-label">{{ __('Kategori') }}</label>
            <select name="category_id" id="category_id" class="form-select-custom @error('category_id') is-invalid @enderror">
                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama_category }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('category_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        
        <div class="form-group mb-4">
            <label for="foto_menu" class="form-label">{{ __('Foto Menu') }}</label>
            <input type="file" name="foto_menu" id="foto_menu" accept="image/*"
                class="form-file-input @error('foto_menu') is-invalid @enderror" data-file-input>
            <label for="foto_menu" class="form-file-custom">
                <img src="{{ asset('assets/icons/table/upload.svg') }}" alt="" class="icon">
                <span class="form-file-text">Klik untuk pilih foto</span>
                <span class="form-file-name" data-file-name>Belum ada file dipilih</span>
            </label>
            {!! $errors->first('foto_menu', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12">
        <button type="submit" class="btn-submit">{{ __('Submit') }}</button>
    </div>
</div> --}}


<div class="row">

    <div class="col-md-12">

        <!-- Nama -->
        <div class="form-group mb-2">

            <label class="form-label">

                Nama Menu

            </label>

            <input type="text" name="nama_menu" class="form-control @error('nama_menu') is-invalid @enderror"
                value="{{ old('nama_menu') }}">

            @error('nama_menu')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <!-- Harga -->
        <div class="form-group mb-2">

            <label class="form-label">

                Harga

            </label>

            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                value="{{ old('harga') }}">

            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <!-- Stok & Satuan -->
        <div class="form-group mb-2">
            <label class="form-label">Stok</label>

            <div class="input-group col-md-10">
                <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                    value="{{ old('stok') }}">

                <select name="satuan" class="satuan-select form-select col-md-2 @error('satuan') is-invalid @enderror">
                    <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                    <option value="gelas" {{ old('satuan') == 'gelas' ? 'selected' : '' }}>Gelas</option>
                    <option value="cup" {{ old('satuan') == 'cup' ? 'selected' : '' }}>Cup</option>
                    <option value="botol" {{ old('satuan') == 'botol' ? 'selected' : '' }}>Botol</option>
                    <option value="porsi" {{ old('satuan') == 'porsi' ? 'selected' : '' }}>Porsi</option>
                </select>
                <i class="bi bi-chevron-down position-absolute top-50 end-0 translate-middle-y me-3"></i>
            </div>  

            @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @error('satuan')
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

            <input type="file" name="foto_menu" class="form-control">

        </div>


    </div>

    <div class="col-md-12">

        <button id="btn-tambah-menu" type="submit" class="btn btn-submit">

            <span id="btn-tambah-spinner" class="spinner d-none"></span>
            <span id="btn-tambah-text">Submit</span>

        </button>

    </div>

</div>
@vite(['resources/js/button/menu-button.js', 'resources/css/button.css'])
