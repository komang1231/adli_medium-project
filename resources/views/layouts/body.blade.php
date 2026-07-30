<body data-theme=dark>

    <x-sidebar />

    <div class="main-wrapper">
        <x-topbar />

        <main class="main-content">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>

</body>