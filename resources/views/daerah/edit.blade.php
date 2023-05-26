@extends('layouts.panel')
@section('title', 'Edit Berita')
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

        .choices__inner {
            background: #fff;
        }

        .choices__list--multiple .choices__item {
            background: #1942b8;
            border: 1px solid #1e4fde;
        }
    </style>
@endpush
@section('content')
    <form action="{{ route('daerah.store') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid  @enderror"
                                        id="nama" placeholder="" name="nama" value="{{ $daerah->nama }}">
                                    <div class="invalid-feedback">
                                        @error('nama')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid  @enderror"
                                        id="slug" placeholder="" name="slug" readonly value="{{ $daerah->slug }}">
                                    <div class="invalid-feedback">
                                        @error('slug')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid  @enderror"
                                        id="alamat" placeholder="" name="alamat" value="{{ $daerah->alamat }}">
                                    <div class="invalid-feedback">
                                        @error('alamat')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" class="form-control @error('telepon') is-invalid  @enderror"
                                        id="telepon" placeholder="" name="telepon" value="{{ $daerah->telepon }}">
                                    <div class="invalid-feedback">
                                        @error('telepon')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="fasilitas">Fasilitas</label>
                                    <select class="choices form-select multiple-remove" multiple="multiple"
                                        name="fasilitas[]">
                                        <option value="Penginapan"
                                            {{ in_array('Penginapan', $daerah->fasilitas) ? 'selected' : '' }}>Penginapan
                                        </option>
                                        <option value="Areal Parkir"
                                            {{ in_array('Areal Parkir', $daerah->fasilitas) ? 'selected' : '' }}>Areal
                                            Parkir</option>
                                        <option value="Kamar Mandi Umum"
                                            {{ in_array('Kamar Mandi Umum', $daerah->fasilitas) ? 'selected' : '' }}>Kamar
                                            Mandi Umum</option>
                                        <option value="ATMs"
                                            {{ in_array('ATMs', $daerah->fasilitas) ? 'selected' : '' }}>ATMs</option>
                                        <option value="Spot Foto"
                                            {{ in_array('Spot Foto', $daerah->fasilitas) ? 'selected' : '' }}>Spot Foto
                                        </option>
                                        <option value="Balai Pertemuan"
                                            {{ in_array('Balai Pertemuan', $daerah->fasilitas) ? 'selected' : '' }}>Balai
                                            Pertemuan</option>
                                        <option value="Wifi Area"
                                            {{ in_array('Wifi Area', $daerah->fasilitas) ? 'selected' : '' }}>Wifi Area
                                        </option>
                                        <option value="Tempat Makan"
                                            {{ in_array('Tempat Makan', $daerah->fasilitas) ? 'selected' : '' }}>Tempat
                                            Makan</option>
                                        <option value="Pusat Informasi"
                                            {{ in_array('Pusat Informasi', $daerah->fasilitas) ? 'selected' : '' }}>Pusat
                                            Informasi</option>
                                    </select>
                                    kerej
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="choices form-select  @error('kategori') is-invalid  @enderror"
                                        name="kategori">
                                        <option value="Wisata Alam">Wisata Alam</option>
                                        <option value="Wisata Budaya">Wisata Budaya</option>
                                        <option value="Wisata Buatan">Wisata Buatan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('kategori')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea id="editor" name="deskripsi">{{ $daerah->deskripsi }}</textarea>
                                    <div class="invalid-feedback">
                                        @error('deskripsi')
                                            {{ $message }}
                                        @enderror
                                    </div>
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
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control @error('latitude') is-invalid  @enderror"
                                        id="latitude" placeholder="" name="latitude" value="{{ $daerah->latitude }}">
                                    <div class="invalid-feedback">
                                        @error('latitude')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid  @enderror"
                                        id="longitude" placeholder="" name="longitude"
                                        value="{{ $daerah->longitude }}">
                                    <div class="invalid-feedback">
                                        @error('longitude')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-grup">
                            <label for="deskripsi" class="form-label">Gambar (Maximal 4 Gambar)</label>
                            <input id="image_upload" type="file" class="imgbb-filepond" name="gambar">
                            <div class="invalid-feedback">
                                @error('gambar')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
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
            $('#nama').on('input', function() {
                var nama = $(this).val().toLowerCase().replace(/\s+/g, '-');
                $('#slug').val(nama);
            });

            // you want to get it of the window global
            const providerOSM = new GeoSearch.OpenStreetMapProvider();

            //leaflet map
            var leafletMap = L.map('map', {
                fullscreenControl: true,
                minZoom: 2
            }).setView([<?= $daerah->latitude ?>, <?= $daerah->longitude ?>], 14);

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(leafletMap);
            theMarker = L.marker([<?= $daerah->latitude ?>, <?= $daerah->longitude ?>]).addTo(leafletMap);

            // Memperbarui posisi marker
            theMarker.setLatLng([<?= $daerah->latitude ?>, <?= $daerah->longitude ?>]);

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
        });

        function deleteOld(namaFile) {
            $.ajax({
                url: "{{ route('image.delete') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                data: {
                    old_file: namaFile
                },
                success: function(response) {
                    console.log(response)
                },
                error: function(response) {
                    console.log('error')
                }
            });
        };

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
            @if ($daerah->gambar)
                files: [
                    @for ($i = 0; $i < count($daerah->gambar); $i++)
                        {
                            // the server file reference
                            source: "{{ asset('storage/daerah') . '/' . $daerah->gambar[$i] }}",
                            // set type to local to indicate an already uploaded file
                            options: {
                                type: 'local',
                                // pass poster property
                                metadata: {
                                    poster: "{{ asset('storage/daerah') . '/' . $daerah->gambar[$i] }}",
                                },
                            },
                        },
                    @endfor
                ],
            @endif
            server: {
                process: '{{ route('image.upload') }}',
                revert: (uniqueFileId, load, error) => {
                    deleteTemporary(uniqueFileId);
                    error('Error terjadi saat menghapus file');
                    load();
                },
                remove: function(source, load, error) {
                    deleteOld(source);
                    load();
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            storeAsFile: true
        });
    </script>
@endpush
