<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="kode_user" class="form-label">{{ __('Kode User') }}</label>
            <input type="text" name="kode_user" class="form-control @error('kode_user') is-invalid @enderror" value="{{ old('kode_user', $user?->kode_user) }}" id="kode_user" placeholder="Kode User">
            {!! $errors->first('kode_user', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="foto_profile" class="form-label">{{ __('Foto Profile') }}</label>
            <input type="text" name="foto_profile" class="form-control @error('foto_profile') is-invalid @enderror" value="{{ old('foto_profile', $user?->foto_profile) }}" id="foto_profile" placeholder="Foto Profile">
            {!! $errors->first('foto_profile', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_user" class="form-label">{{ __('Nama User') }}</label>
            <input type="text" name="nama_user" class="form-control @error('nama_user') is-invalid @enderror" value="{{ old('nama_user', $user?->nama_user) }}" id="nama_user" placeholder="Nama User">
            {!! $errors->first('nama_user', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user?->email) }}" id="email" placeholder="Email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="no_tlp" class="form-label">{{ __('No Tlp') }}</label>
            <input type="text" name="no_tlp" class="form-control @error('no_tlp') is-invalid @enderror" value="{{ old('no_tlp', $user?->no_tlp) }}" id="no_tlp" placeholder="No Tlp">
            {!! $errors->first('no_tlp', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="form-group mb-2 mb20">
            <label for="role" class="form-label">{{ __('Role') }}</label>
            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $user?->role) }}" id="role" placeholder="Role">
            {!! $errors->first('role', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="status" class="form-label">{{ __('Status') }}</label>
            <input type="text" name="status" class="form-control @error('status') is-invalid @enderror" value="{{ old('status', $user?->status) }}" id="status" placeholder="Status">
            {!! $errors->first('status', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="form-group mb-2 mb20">
            <label for="password" class="form-label">Password</label>

            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="Password">

            {!! $errors->first('password', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>