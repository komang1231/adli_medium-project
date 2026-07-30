<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="kode_payment_provider" class="form-label">{{ __('Kode Payment Provider') }}</label>
            <input type="text" name="kode_payment_provider" class="form-control @error('kode_payment_provider') is-invalid @enderror" value="{{ old('kode_payment_provider', $paymentProvider?->kode_payment_provider) }}" id="kode_payment_provider" placeholder="Kode Payment Provider">
            {!! $errors->first('kode_payment_provider', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="payment_method_id" class="form-label">{{ __('Payment Method Id') }}</label>
            <input type="text" name="payment_method_id" class="form-control @error('payment_method_id') is-invalid @enderror" value="{{ old('payment_method_id', $paymentProvider?->payment_method_id) }}" id="payment_method_id" placeholder="Payment Method Id">
            {!! $errors->first('payment_method_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_payment_provider" class="form-label">{{ __('Nama Payment Provider') }}</label>
            <input type="text" name="nama_payment_provider" class="form-control @error('nama_payment_provider') is-invalid @enderror" value="{{ old('nama_payment_provider', $paymentProvider?->nama_payment_provider) }}" id="nama_payment_provider" placeholder="Nama Payment Provider">
            {!! $errors->first('nama_payment_provider', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>