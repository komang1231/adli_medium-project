<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="kode_pelanggan" class="form-label">{{ __('Kode Pelanggan') }}</label>
            <input type="text" name="kode_pelanggan" class="form-control @error('kode_pelanggan') is-invalid @enderror" value="{{ old('kode_pelanggan', $member?->kode_pelanggan) }}" id="kode_pelanggan" placeholder="Kode Pelanggan">
            {!! $errors->first('kode_pelanggan', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_pelanggan" class="form-label">{{ __('Nama Pelanggan') }}</label>
            <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan', $member?->nama_pelanggan) }}" id="nama_pelanggan" placeholder="Nama Pelanggan">
            {!! $errors->first('nama_pelanggan', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="no_tlp" class="form-label">{{ __('No Tlp') }}</label>
            <input type="text" name="no_tlp" class="form-control @error('no_tlp') is-invalid @enderror" value="{{ old('no_tlp', $member?->no_tlp) }}" id="no_tlp" placeholder="No Tlp">
            {!! $errors->first('no_tlp', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="status" class="form-label">{{ __('Status') }}</label>
            <input type="text" name="status" class="form-control @error('status') is-invalid @enderror" value="{{ old('status', $member?->status) }}" id="status" placeholder="Status">
            {!! $errors->first('status', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="expired_at" class="form-label">{{ __('Expired At') }}</label>
            <input type="text" name="expired_at" class="form-control @error('expired_at') is-invalid @enderror" value="{{ old('expired_at', $member?->expired_at) }}" id="expired_at" placeholder="Expired At">
            {!! $errors->first('expired_at', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>