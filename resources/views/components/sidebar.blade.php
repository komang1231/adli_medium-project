<aside id="sidebar" class="sidebar d-flex flex-column">

    <a href="/" class="sidebar-logo">
        <img class="sidebar-logo-full" src="{{ asset('assets/icons/logo/logo.svg') }}" alt="POS Coffee Shop Click">

        <img class="sidebar-logo-icon" src="{{ asset('assets/icons/logo/logo_icon.svg') }}" alt="POS Coffee Shop Click">
    </a>

    <hr>

    <nav class="sidebar-menu flex-grow-1">
        @if (in_array(auth()->user()->role, ['Staff', 'Manager', 'Admin']))

            <a href="{{ route('dashboard.index') }}"
                class="sidebar-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <span class="sidebar-icon" style="--icon: url('{{ asset('assets/icons/sidebar/dashboard.svg') }}')">
                </span>
                <span class="menu-name">Dashboard</span>
            </a>

            @if (in_array(auth()->user()->role, ['Admin']))
                <a href="{{ route('categories.index') }}"
                    class="sidebar-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <span class="sidebar-icon" style="--icon: url('{{ asset('assets/icons/sidebar/kategori.svg') }}')">
                    </span>
                    <span class="menu-name">Kategori</span>
                </a>


                <a href="{{ route('menus.index') }}"
                    class="sidebar-item {{ request()->routeIs('menus.*') ? 'active' : '' }}">
                    <span class="sidebar-icon" style="--icon: url('{{ asset('assets/icons/sidebar/menu.svg') }}')">
                    </span>
                    <span class="menu-name">Menu</span>
                </a>
            @endif

            <a href="{{ route('transaksis.index') }}"
                class="sidebar-item {{ request()->routeIs('transaksis.*') ? 'active' : '' }}">
                <span class="sidebar-icon" style="--icon: url('{{ asset('assets/icons/sidebar/transaksi.svg') }}')">
                </span>
                <span class="menu-name">Transaksi</span>
            </a>

            @if (in_array(auth()->user()->role, ['Manager', 'Admin']))
                <a href="{{ route('users.index') }}"
                    class="sidebar-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <span class="sidebar-icon" style="--icon: url('{{ asset('assets/icons/sidebar/users.svg') }}')">
                    </span>
                    <span class="menu-name">Users</span>
                </a>
            @endif

            <a href="{{ route('members.index') }}"
                class="sidebar-item {{ request()->routeIs('members.*') ? 'active' : '' }}">
                <span class="sidebar-icon" style="--icon: url('{{ asset('assets/icons/sidebar/pelanggan.svg') }}')">
                </span>
                <span class="menu-name">Pelanggan</span>
            </a>

            <a href="{{ route('payment-methods.index') }}"
                class="sidebar-item {{ request()->routeIs('payment-methods.*','payment-providers.*') ? 'active' : '' }}">
                <span class="sidebar-icon" style="--icon: url('{{ asset('assets/icons/sidebar/payment.svg') }}')">
                </span>
                <span class="menu-name">Payment</span>
            </a>
        @endif
    </nav>

</aside>
