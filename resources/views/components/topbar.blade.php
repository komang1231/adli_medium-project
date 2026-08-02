<header class="topbar sticky-top">

    {{-- Kiri --}}
    <div class="topbar-left">
        <button id="sidebarToggle" class="topbar-menu" type="button">
            <img src="{{ asset('assets/icons/topbar/hamburger.svg') }}" alt="Menu">
        </button>
    </div>

    {{-- Tengah --}}
    <div class="topbar-actions">

        {{-- Transaksi --}}
        <a href="{{ route('transaksis.create') }}" class="topbar-action topbar-transaction" type="button">
            <img class="add" src="{{ asset('assets/icons/topbar/add.svg') }}" alt="">
            <span>Transaksi</span>
            <img class="icon" src="{{ asset('assets/icons/topbar/transaksi.svg') }}" alt="">
        </a>

        {{-- Pelanggan --}}
        <a href="{{ route('members.index') }}" class="topbar-action topbar-customer" type="button"
            {{-- data-bs-toggle="offcanvas" data-bs-target="#formOffcanvas" --}}
            >
            <img class="add" src="{{ asset('assets/icons/topbar/add.svg') }}" alt="">
            <span>Pelanggan</span>
            <img class="icon" src="{{ asset('assets/icons/topbar/pelanggan.svg') }}" alt="">
        </a>
        {{-- <button class="btn btn-add me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#formOffcanvas">
            <img class="icon" src="{{ asset('assets/icons/table/add.svg') }}" alt="">
            Add
        </button> --}}

    </div>

    {{-- Kanan --}}
    <div class="topbar-profile">

        {{-- Mail --}}
        <button class="topbar-mail" type="button">
            <img src="{{ asset('assets/icons/topbar/mail.svg') }}" alt="Mail">
        </button>

        {{-- Profile --}}
        <div class="topbar-user-wrapper" data-dropdown-widget>
            <button class="topbar-user" type="button" data-dropdown-trigger aria-haspopup="true" aria-expanded="false">
                <img src="{{ auth()->user()->foto_profile ? asset('storage/' . auth()->user()->foto_profile) : asset('assets/icons/topbar/profile.svg') }}"
                    alt="Profile">

                <div class="topbar-user-info">
                    <span class="topbar-user-name">{{ explode(' ', auth()->user()->nama_user ?? 'Adli')[0] }}</span>
                    <span class="topbar-user-role">{{ strtoupper(auth()->user()->role ?? 'ADMIN') }}</span>
                </div>
            </button>

            <div class="topbar-user-dropdown" data-dropdown-menu hidden>
                <button type="button" class="dropdown-item" data-bs-toggle="offcanvas"
                    data-bs-target="#profileOffcanvas">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </button>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item dropdown-item-danger">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        @include('profile.profile-offcanvas')
        {{-- <button class="topbar-user" type="button">
            <img src="{{ asset('assets/icons/topbar/profile.svg') }}" alt="Profile">

            <div class="topbar-user-info">
                <span class="topbar-user-name">Adli</span>
                <span class="topbar-user-role">ADMIN</span>
            </div>
        </button> --}}

    </div>
    {{-- OFF CANVAS CREATE --}}
    {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="formOffcanvas" aria-labelledby="formOffcanvasLabel">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="formOffcanvasLabel">Create Member</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="POST" action="{{ route('members.store') }}" role="form" enctype="multipart/form-data">
                @csrf

                @include('member.form')

            </form>
        </div>
    </div> --}}

</header>
