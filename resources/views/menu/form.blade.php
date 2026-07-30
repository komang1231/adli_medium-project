<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="kode_menu" class="form-label">{{ __('Kode Menu') }}</label>
            <input type="text" name="kode_menu" class="form-control @error('kode_menu') is-invalid @enderror" value="{{ old('kode_menu', $menu?->kode_menu) }}" id="kode_menu" placeholder="Kode Menu">
            {!! $errors->first('kode_menu', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_menu" class="form-label">{{ __('Nama Menu') }}</label>
            <input type="text" name="nama_menu" class="form-control @error('nama_menu') is-invalid @enderror" value="{{ old('nama_menu', $menu?->nama_menu) }}" id="nama_menu" placeholder="Nama Menu">
            {!! $errors->first('nama_menu', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="harga" class="form-label">{{ __('Harga') }}</label>
            <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', $menu?->harga) }}" id="harga" placeholder="Harga">
            {!! $errors->first('harga', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="stok" class="form-label">{{ __('Stok') }}</label>
            <input type="text" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $menu?->stok) }}" id="stok" placeholder="Stok">
            {!! $errors->first('stok', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="foto_menu" class="form-label">{{ __('Foto Menu') }}</label>
            <input type="text" name="foto_menu" class="form-control @error('foto_menu') is-invalid @enderror" value="{{ old('foto_menu', $menu?->foto_menu) }}" id="foto_menu" placeholder="Foto Menu">
            {!! $errors->first('foto_menu', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="category_id" class="form-label">{{ __('Category Id') }}</label>
            <input type="text" name="category_id" class="form-control @error('category_id') is-invalid @enderror" value="{{ old('category_id', $menu?->category_id) }}" id="category_id" placeholder="Category Id">
            {!! $errors->first('category_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>