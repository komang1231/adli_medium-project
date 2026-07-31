<div class="row">
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

        {{-- NEW: select kategori, belum ada preseden desain di Category, pakai class .form-select-custom --}}
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

        {{-- NEW: upload foto, belum ada preseden desain di Category, pakai class .form-file-custom --}}
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
</div>
