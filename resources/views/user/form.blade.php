<div class="row">

    <div class="col-md-12">

        {{-- Foto --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Foto Profile

            </label>

            <input
                type="file"
                name="foto_profile"
                class="form-control @error('foto_profile') is-invalid @enderror">

            @error('foto_profile')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        {{-- Nama --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Nama User

            </label>

            <input
                type="text"
                name="nama_user"
                class="form-control @error('nama_user') is-invalid @enderror"
                value="{{ old('nama_user') }}">

            @error('nama_user')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        {{-- Email --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Email

            </label>

            <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}">

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        {{-- Nomor HP --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Nomor HP

            </label>

            <input
                type="text"
                name="no_tlp"
                class="form-control @error('no_tlp') is-invalid @enderror"
                value="{{ old('no_tlp') }}">

            @error('no_tlp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        {{-- Role --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Role

            </label>

            <select
                name="role"
                class="form-select @error('role') is-invalid @enderror">

                <option value="Staff">Staff</option>
                <option value="Admin">Admin</option>
                <option value="Manager">Manager</option>

            </select>

            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        {{-- Password --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Password

            </label>

            <input
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror">

            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        {{-- Konfirmasi Password --}}
        <div class="form-group mb-4">

            <label class="form-label">

                Konfirmasi Password

            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control">

        </div>

    </div>

    <div class="col-md-12">

        <button
            id="btn-tambah-user"
            type="submit"
            class="btn btn-submit">

            <span id="btn-tambah-spinner" class="spinner d-none"></span>
            <span id="btn-tambah-text">Tambah User</span>

        </button>
    </div>
</div>
@vite(['resources/js/button/user-button.js', 'resources/css/button.css'])