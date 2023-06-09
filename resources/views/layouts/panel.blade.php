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
    <script src="{{ asset('') }}assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/form-element-select.js"></script>
    <script src="{{ asset('') }}assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script>
        function deleteData() {
            var form = $('#myForm');
            var url = form.attr('action');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1d4ed8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        data: form.serialize(),
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            // datatable reload otomatis saat delete data
                            if (response.status == 200) {
                                Swal.fire(
                                    'Dihapus!',
                                    'Data Anda telah dihapus.',
                                    'success'
                                )
                                $('#tables').DataTable().ajax.reload();
                            }
                        },
                        error: function(xhr, status, error) {
                            // Terjadi error saat menghapus data, lakukan penanganan error
                        }
                    });

                }
            })
        };
    </script>
    {{-- <script src="{{ asset('') }}assets/static/js/pages/sweetalert2.js"></script>> --}}
    @stack('js')
</body>

</html>
