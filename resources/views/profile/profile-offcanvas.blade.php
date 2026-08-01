@php
    $user = Auth::user();
    $fotoUrl = $user->foto_profile
        ? asset('storage/' . $user->foto_profile)
        : asset('assets/icons/topbar/profile.svg');
@endphp

<div class="offcanvas offcanvas-end profile-offcanvas" tabindex="-1" id="profileOffcanvas" aria-labelledby="profileOffcanvasLabel">

    <div class="offcanvas-header">
        <span class="offcanvas-title" id="profileOffcanvasLabel">{{ __('Profile') }}</span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        <div class="profile-header">
            <div class="profile-avatar-wrapper">
                <img src="{{ $fotoUrl }}" alt="{{ $user->nama_user }}" class="profile-avatar">
                <button type="button" class="profile-avatar-edit" aria-label="{{ __('Ganti foto profile') }}">
                    <i class="bi bi-camera-fill"></i>
                </button>
            </div>

            <span class="profile-kode">{{ $user->kode_user }}</span>
            <span class="profile-nama">{{ $user->nama_user }}</span>
        </div>

        <div class="profile-fields">
            <div class="profile-field">
                <div class="profile-field-label">{{ __('Email') }}</div>
                <div class="profile-field-value">{{ $user->email }}</div>
            </div>
            <div class="profile-field">
                <div class="profile-field-label">{{ __('Nomor HP') }}</div>
                <div class="profile-field-value">{{ $user->no_tlp }}</div>
            </div>
            <div class="profile-field">
                <div class="profile-field-label">{{ __('Role') }}</div>
                <div class="profile-field-value">{{ $user->role }}</div>
            </div>
            <div class="profile-field profile-field-last">
                <div class="profile-field-label">{{ __('Dibuat') }}</div>
                <div class="profile-field-value">{{ $user->created_at->locale('id')->translatedFormat('d F Y') }}</div>
            </div>
        </div>

        <div class="profile-actions">
            <button type="button" class="btn-profile-primary" id="btnEditBiodata">
                <i class="bi bi-pencil-square"></i>
                {{ __('Edit Biodata') }}
            </button>
            <button type="button" class="btn-profile-secondary" id="btnUbahPassword">
                <i class="bi bi-lock"></i>
                {{ __('Ubah Password') }}
            </button>
        </div>

    </div>
</div>