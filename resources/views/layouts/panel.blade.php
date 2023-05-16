<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>
    <script src="{{ asset('') }}assets/static/js/initTheme.js"></script>
    <div id="app">
        @include('partials.sidebar')
        <div id="main" class='layout-navbar navbar-fixed'>
            <header>
                @include('partials.navbar')
            </header>
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>{{ $menu }}</h4>
                            @isset($links)
                                <button class="btn {{ $links['class'] }}"
                                    onclick="window.location.href='{{ $links['url'] }}'">{{ $links['button'] }}</button>
                            @endisset
                        </div>
                    </div>
                    <section class="section">
                        @yield('content')
                    </section>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('') }}assets/static/js/components/dark.js"></script> --}}
    <script src="{{ asset('') }}assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('') }}assets/compiled/js/app.js"></script>

    {{-- library js --}}
    <script src="{{ asset('') }}assets/extensions/jquery/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/datatables.js"></script>
    @yield('js')
</body>

</html>
