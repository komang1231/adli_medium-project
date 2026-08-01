{{-- <div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="kode_payment_method" class="form-label">{{ __('Kode Payment Method') }}</label>
            <input type="text" name="kode_payment_method" class="form-control @error('kode_payment_method') is-invalid @enderror" value="{{ old('kode_payment_method', $paymentMethod?->kode_payment_method) }}" id="kode_payment_method" placeholder="Kode Payment Method">
            {!! $errors->first('kode_payment_method', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_payment_method" class="form-label">{{ __('Nama Payment Method') }}</label>
            <input type="text" name="nama_payment_method" class="form-control @error('nama_payment_method') is-invalid @enderror" value="{{ old('nama_payment_method', $paymentMethod?->nama_payment_method) }}" id="nama_payment_method" placeholder="Nama Payment Method">
            {!! $errors->first('nama_payment_method', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div> --}}