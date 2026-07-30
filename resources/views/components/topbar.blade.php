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
        <button class="topbar-action topbar-transaction" type="button">
            <img class="add" src="{{ asset('assets/icons/topbar/add.svg') }}" alt="">
            <span>Transaksi</span>
            <img class="icon" src="{{ asset('assets/icons/topbar/transaksi.svg') }}" alt="">
        </button>

        {{-- Pelanggan --}}
        <button class="topbar-action topbar-customer" type="button">
            <img class="add" src="{{ asset('assets/icons/topbar/add.svg') }}" alt="">
            <span>Pelanggan</span>
            <img class="icon" src="{{ asset('assets/icons/topbar/pelanggan.svg') }}" alt="">
        </button>

    </div>

    {{-- Kanan --}}
    <div class="topbar-profile">

        {{-- Mail --}}
        <button class="topbar-mail" type="button">
            <img src="{{ asset('assets/icons/topbar/mail.svg') }}" alt="Mail">
        </button>

        {{-- Profile --}}
        <button class="topbar-user" type="button">
            <img src="{{ asset('assets/icons/topbar/profile.svg') }}" alt="Profile">

            <div class="topbar-user-info">
                <span class="topbar-user-name">Adli</span>
                <span class="topbar-user-role">ADMIN</span>
            </div>
        </button>

    </div>

</header>
