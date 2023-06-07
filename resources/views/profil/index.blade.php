@extends('layouts.panel')
@section('title', 'Profil Desa')
@push('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/filepond/filepond.css">
    <style>
        #map {
            height: 500px;
            /* The height is 400 pixels */
        }

        .leaflet-geosearch-bar {
            z-index: 0;
        }
    </style>
@endpush
@section('content')
    <form action="{{ route('profil-desa.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="d-flex flex-lg-row flex-column align-items-lg-end align-items-start gap-4">
                                    <img id="preview-foto" class="d-block img-thumbnail" height="150" width="150"
                                        src="" alt="Logo Profil">
                                    <div class="d-flex flex-column align-items-stretch gap-3">
                                        <button id="btn_triger_input_foto" type="button"
                                            class="btn btn-primary btn-sm align-self-start">Unggah foto baru</button>
                                        <input id="input_foto" type="file" name="foto_profil" value="" hidden>
                                        <small class="text-muted mb-0">Diizinkan JPG, GIF, atau PNG. Ukuran maksimal
                                            1Mb</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="" name="nama">
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" placeholder="" name="alamat">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="telepon" placeholder="" name="telepon">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="telepon" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="telepon" placeholder="" name="telepon">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Deskripsi </label>
                                    <textarea id="editor" name="deskripsi"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-heading mb-2">Peta</div>
                        <div class="mb-2 rounded" id="map"></div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" placeholder=""
                                        name="latitude">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="longitude" class="form-label">Longitude </label>
                                    <input type="text" class="form-control" id="longitude" placeholder=""
                                        name="longitude">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-grup">
                            <label for="deskripsi" class="form-label">Video</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-youtube mb-2"></i></span>
                                <input type="text" class="form-control" placeholder="https://youtu.be/xxx">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-grup">
                            <label for="deskripsi">Gambar (Maximal
                                4 Gambar) </label>
                            <input id="image_upload" type="file" class="imgbb-filepond" name="gambar">
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection
@push('js')
    <script src="{{ asset('') }}assets/extensions/filepond/filepond.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/filepond.js"></script>
    <script src="{{ asset('') }}assets/extensions/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            // you want to get it of the window global
            const providerOSM = new GeoSearch.OpenStreetMapProvider();

            //leaflet map
            var leafletMap = L.map('map', {
                fullscreenControl: true,
                minZoom: 2
            }).setView([0, 0], 2);

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(leafletMap);

            let theMarker = {};

            leafletMap.on('click', function(e) {
                let latitude = e.latlng.lat.toString().substring(0, 15);
                let longitude = e.latlng.lng.toString().substring(0, 15);
                // document.getElementById("latitude").value = latitude;
                // document.getElementById("longtitude").value = longtitude;
                let popup = L.popup()
                    .setLatLng([latitude, longitude])
                    .setContent("Kordinat : " + latitude + " - " + longitude)
                    .openOn(leafletMap);

                if (theMarker != undefined) {
                    leafletMap.removeLayer(theMarker);
                };

                $('#longitude').val(longitude);
                $('#latitude').val(latitude);
                theMarker = L.marker([latitude, longitude]).addTo(leafletMap);
            });

            const search = new GeoSearch.GeoSearchControl({
                provider: providerOSM,
                style: 'bar',
                searchLabel: 'Cari lokasi',
            });

            leafletMap.addControl(search);

            $('#btn_triger_input_foto').click(function() {
                $(this).siblings('input[id="input_foto"]').trigger('click');
            });

            $('#input_foto').change(function() {
                var input = $(this)[0];
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-foto').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });

        function deleteTemporary(namaFile) {
            $.ajax({
                url: "{{ route('image.delete') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                data: {
                    file_temporary: namaFile
                },
                success: function(response) {
                    console.log(response)
                },
                error: function(response) {
                    console.log('error')
                }
            });
        };

        FilePond.create(document.querySelector("#image_upload"), {
            credits: null,
            allowImagePreview: true,
            acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
            allowMultiple: true,
            maxFiles: 4,
            maxParallelUploads: 4,
            server: {
                process: '{{ route('image.upload') }}',
                revert: (uniqueFileId, load, error) => {
                    deleteTemporary(uniqueFileId);
                    error('Error terjadi saat menghapus file');
                    load();
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            storeAsFile: true
        });

        FilePond.create(document.querySelector("#video_upload"), {
            credits: null,
            allowImagePreview: false,
            allowVideoPreview: true, // default true
            allowAudioPreview: true,
            acceptedFileTypes: ["video/mp4"],
            server: {
                process: '{{ route('video.upload') }}',
                revert: '{{ route('video.delete') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            storeAsFile: true,
        });
    </script>
@endpush
