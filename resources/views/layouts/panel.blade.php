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
    <script
        src="{{ asset('') }}assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js">
    </script>
    <script
        src="{{ asset('') }}assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="{{ asset('') }}assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js">
    </script>
    <script
        src="{{ asset('') }}assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="{{ asset('') }}assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js">
    </script>
    <script src="{{ asset('') }}assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js">
    </script>
    <script src="{{ asset('') }}assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js">
    </script>
    <script src="{{ asset('') }}assets/extensions/filepond-plugin-media-preview/filepond-plugin-media-preview.min.js">
    </script>
    <script src="{{ asset('') }}assets/extensions/filepond-plugin-file-poster/filepond-plugin-file-poster.js"></script>
    {{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.umd.js"></script> --}}
    @stack('js')
</body>

</html>
