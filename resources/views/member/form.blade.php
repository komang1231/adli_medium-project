<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nama_pelanggan" class="form-label">{{ __('Nama Pelanggan') }}</label>
            <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan', $member?->nama_pelanggan) }}" id="nama_pelanggan" placeholder="Nama Pelanggan" required>
            {!! $errors->first('nama_pelanggan', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="no_tlp" class="form-label">{{ __('Nomor Telp') }}</label>
            <input type="text" name="no_tlp" class="form-control @error('no_tlp') is-invalid @enderror" value="{{ old('no_tlp', $member?->no_tlp) }}" id="no_tlp" placeholder="Nomor Telp" required>
            {!! $errors->first('no_tlp', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="duration" class="form-label">{{ __('Pilih Durasi Member (detik)') }}</label>
            <select name="duration" id="duration" class="form-select-custom @error('duration') is-invalid @enderror" @if(!$member?->exists) required @endif>
                <option value="" {{ old('duration') == '' ? 'selected' : '' }}>Pilih lama member</option>
                <option value="15s" {{ old('duration') == '15s' ? 'selected' : '' }}>15 Detik</option>
                <option value="1month" {{ old('duration') == '1month' ? 'selected' : '' }}>1 Bulan</option>
                <option value="3month" {{ old('duration') == '3month' ? 'selected' : '' }}>3 Bulan</option>
                <option value="6month" {{ old('duration') == '6month' ? 'selected' : '' }}>6 Bulan</option>
                <option value="1year" {{ old('duration') == '1year' ? 'selected' : '' }}>1 Tahun</option>
            </select>
            {!! $errors->first('duration', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            @if($member?->exists)
                <small class="text-muted">Biarkan kosong jika tidak ingin memperpanjang masa berlaku.</small>
            @endif
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button id="btn-add-member" type="submit" class="btn btn-primary">
            <span id="btn-login-spinner" class="spinner d-none"></span>
            <span id="btn-tambah-text">Submit</span>

        </button>
    </div>
</div>
@vite(['resources/js/button/member-button.js', 'resources/css/button.css'])