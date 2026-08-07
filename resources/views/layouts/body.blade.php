<body data-theme=dark>

    <x-sidebar />

    <div class="main-wrapper">
        <x-topbar />

        <main class="main-content">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
@vite(['resources/js/button.js', 'resources/css/button.css'])
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>