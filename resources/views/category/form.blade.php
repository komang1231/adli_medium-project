{{-- <div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="kode_category" class="form-label">{{ __('Kode Category') }}</label>
            <input type="text" name="kode_category" class="form-control @error('kode_category') is-invalid @enderror" value="{{ old('kode_category', $category?->kode_category) }}" id="kode_category" placeholder="Kode Category">
            {!! $errors->first('kode_category', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_category" class="form-label">{{ __('Nama Category') }}</label>
            <input type="text" name="nama_category" class="form-control @error('nama_category') is-invalid @enderror" value="{{ old('nama_category', $category?->nama_category) }}" id="nama_category" placeholder="Nama Category">
            {!! $errors->first('nama_category', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div> --}}




<div class="row">
    <div class="col-md-12">

        

        <div class="form-group mb-4">
            <label for="nama_category" class="form-label">{{ __('Nama Category') }}</label>
            <input type="text" name="nama_category" class="form-control @error('nama_category') is-invalid @enderror"
                {{-- value="{{ old('nama_category', $category?->nama_category) }}" id="nama_category"
                placeholder="Nama Category" --}}
                >
            {!! $errors->first(
                'nama_category',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>

    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-submit">{{ __('Submit') }}</button>
    </div>
</div>


