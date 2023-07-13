<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('') }}assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/compiled/css/app.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/choices.js/public/assets/styles/choices.css">
    {{-- Leaflet --}}
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/leaflet/leaflet.css">
    <script src="{{ asset('') }}assets/extensions/leaflet/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.css" />
    <script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.umd.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .choices__inner {
            background: #fff;
        }

        .choices__list--multiple .choices__item {
            background: #1942b8;
            border: 1px solid #1e4fde;
        }

        .link-hover:hover {
            color: #1942b8;
        }
    </style>
    @stack('css')
</head>

<body>
    <script src="{{ asset('') }}assets/static/js/initTheme.js"></script>
    <div class="px-2 px-lg-0">
        <nav class="navbar navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="#">Desa Kamasan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == '' ? 'active' : '' }}"
                                href="{{ route('beranda.index') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'berita' ? 'active' : '' }}"
                                href="{{ route('berita.index') }}">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'produk' ? 'active' : '' }}"
                                href="{{ route('produk.index') }}">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'daerah' ? 'active' : '' }}"
                                href="{{ route('daerah.index') }}">Daerah</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Informasi
                            </a>
                            <ul class="dropdown-menu border">
                                <li><a class="dropdown-item" href="#">Profil Desa</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('beranda.perangkat-desa.index') }}">Perangkat Desa</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Kontak</a></li>
                                @guest
                                    <li><a href="{{ route('berita-post.index') }}" class="dropdown-item"
                                            href="#">Login</a></li>
                                @endguest
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <button id="btnSearch" class="btn border rounded-4" data-bs-toggle="modal"
                                data-bs-target="#modalSearch"><i class="bi bi-search me-2"></i>
                                Telusuri...</button>
                        </li>
                    </ul>
                    @auth
                        <ul class="navbar-nav mb-2 mb-lg-0 ms-2">
                            <li class="nav-item">
                                <a href="{{ route('berita-post.index') }}" class="btn border rounded-4 btn-primary">
                                    Dashboard</a>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>
        <div class="content-wrapper">
            <section class="page-content">
                {{-- Main --}}
                @yield('content')
            </section>
        </div>
        <footer class="bg-white border-top">
            <div class="container">
                <div class="row py-lg-5 py-3 px-2">
                    <div class="col-lg-6 col-12">
                        <h4>Desa Kamasan</h5>
                            <p style="text-align: justify;" class="w-lg-50 w-100">Desa Kamasan terletak di Kabupaten
                                Klungkung,
                                Bali, Indonesia.
                                Desa ini
                                terkenal sebagai
                                pusat
                                seni lukis tradisional Bali yang kaya akan warisan budaya dan sejarah. Kamasan
                                dikenal
                                dengan
                                gaya lukisannya yang unik dan khas, dikenal dengan sebutan "gaya Kamasan" atau "gaya
                                Pita
                                Maha".
                                Gaya lukisan ini berasal dari tradisi lukis Klasik Bali yang dipengaruhi oleh seni
                                wayang
                                kulit
                                dan karya seni Hindu-Buddha.</p>
                    </div>
                    <div class="col-lg-2 col-6">
                        <h6>Sosial Media</h6>
                        <ul class="navbar-nav">
                            @foreach ($sosial_media as $row)
                                <li class="nav-item">
                                    <a href="{{ $row->url }}" class="nav-link">{{ $row->nama }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6">
                        <h6>Links</h6>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="" class="nav-link">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Berita</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Daerah Wisata</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @include('beranda.modal-search');
    <script src="{{ asset('') }}assets/compiled/js/app.js"></script>
    <script src="{{ asset('') }}assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/form-element-select.js"></script>
    <script src="{{ asset('') }}assets/extensions/jquery/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').keyup(function() {
                var query = $(this).val();
                var token = $('meta[name="csrf-token"]').attr('content');
                if (query !== '') {
                    $.ajax({
                        url: '{{ route('search') }}',
                        method: 'POST',
                        data: {
                            query: query
                        },
                        headers: {
                            'X-CSRF-TOKEN': token // Menambahkan token CSRF dalam header permintaan
                        },
                        success: function(response) {
                            // Menghapus hasil pencarian sebelumnya
                            $('#searchResults').empty();
                            // Menampilkan hasil pencarian
                            if (response.length > 0) {
                                $.each(response, function(index, result) {
                                    var listItem = $(
                                        '<li class="nav-item link-hover">'
                                    );
                                    var link = $('<a class="nav-link text-sm">').attr(
                                        'href',
                                        getResultURL(result)).text(
                                        result.judul || result.nama);
                                    listItem.append(link);
                                    $('#searchResults').append(listItem);
                                });
                            } else {
                                var message = $('<li class="nav-item text-sm">').text(
                                    'Data tidak tersedia');
                                $('#searchResults').append(message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                } else {
                    $('#searchResults').empty();
                }
            });

            function getResultURL(result) {
                // Mengembalikan URL berdasarkan jenis entitas (berita, produk, dsb.)
                if (result.type === 'berita') {
                    return "{{ url('/berita') }}" + "/" +
                        result.slug;
                } else if (result.type === 'produk') {
                    return "{{ url('/produk') }}" + "/" +
                        result.slug;
                } else if (result.type === 'daerah') {
                    return "{{ url('/daerah') }}" + "/" +
                        result.slug;
                } else {
                    return '#'; // Jika tidak ada jenis entitas yang cocok, dapat diganti dengan URL lain atau '#' jika tidak ingin mengarahkan ke URL tertentu
                }
            }
        });
    </script>
    @stack('js')
</body>

</html>
