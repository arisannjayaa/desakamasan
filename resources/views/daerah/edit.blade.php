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
    <div id="errorContainer"></div>
    <form id="myForm" action="{{ route('daerah.update', $daerah->id) }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-body">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama"
                                        class="form-label @error('nama') text-danger @enderror">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid  @enderror"
                                        id="nama" placeholder="" name="nama" value="{{ $daerah->nama }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="slug"
                                        class="form-label @error('slug') text-danger @enderror">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid  @enderror"
                                        id="slug" placeholder="" name="slug" readonly value="{{ $daerah->slug }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="alamat"
                                        class="form-label @error('alamat') text-danger @enderror">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid  @enderror"
                                        id="alamat" placeholder="" name="alamat" value="{{ $daerah->alamat }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="telepon"
                                        class="form-label @error('telepon') text-danger @enderror">Telepon</label>
                                    <input type="text" class="form-control @error('telepon') is-invalid  @enderror"
                                        id="telepon" placeholder="" name="telepon" value="{{ $daerah->telepon }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="fasilitas"
                                        class="form-label @error('fasilitas') text-danger @enderror">Fasilitas</label>
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
                                        <option value="ATMs" {{ in_array('ATMs', $daerah->fasilitas) ? 'selected' : '' }}>
                                            ATMs</option>
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
                                    <label for="kategori"
                                        class="form-label @error('kategori') text-danger @enderror">Kategori</label>
                                    <select class="choices form-select  @error('kategori') is-invalid  @enderror"
                                        name="kategori">
                                        <option value="Wisata Alam">Wisata Alam</option>
                                        <option value="Wisata Budaya">Wisata Budaya</option>
                                        <option value="Wisata Buatan">Wisata Buatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi"
                                        class="form-label @error('deskripsi') text-danger @enderror">Deskripsi</label>
                                    <textarea id="editor" name="deskripsi">{{ $daerah->deskripsi }}</textarea>
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
                                    <label for="latitude"
                                        class="form-label @error('latitude') text-danger @enderror">Latitude</label>
                                    <input type="text" class="form-control @error('latitude') is-invalid  @enderror"
                                        id="latitude" placeholder="" name="latitude" value="{{ $daerah->latitude }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="longitude"
                                        class="form-label @error('longitude') text-danger @enderror">Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid  @enderror"
                                        id="longitude" placeholder="" name="longitude"
                                        value="{{ $daerah->longitude }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-grup">
                            <label for="deskripsi" class="form-label @error('gambar') text-danger @enderror">Gambar
                                (Maximal 4 Gambar)</label>
                            <input id="image_upload" type="file" class="imgbb-filepond" name="gambar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2 d-grid gap-2 d-md-block">
            <button id="btnSubmit" type="submit" class="btn btn-primary">Simpan</button>
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

            $('#myForm').on('submit', function(e) {
                e.preventDefault();
                $('#btnSubmit').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );
                $('#btnSubmit').attr('disabled', 'disabled');
                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    dataType: 'json',
                    complete: function() {
                        $('#btnSubmit').html('Unggah');
                        $('#btnSubmit').removeAttr('disabled');
                    },
                    success: function(response) {
                        console.log('berhasil');
                        alert('Data berhasil diperbaharui!');
                        window.location.href = '{{ route('daerah.index') }}';
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.errors;
                        console.log(errorMessage);
                        if (xhr.status == 422) {
                            var errorHtml =
                                '<div class="alert alert-light-danger color-danger">';
                            errorHtml += '<ul>';
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorHtml +=
                                    '<li><i class="bi bi-exclamation-circle"></i> ' +
                                    value + '</li>';
                            });
                            errorHtml += '</ul>';
                            errorHtml += '</div>';

                            $('#errorContainer').html(errorHtml);
                            $('html, body').animate({
                                scrollTop: $('body').offset().top
                            }, 100);
                        } else {
                            // Logika saat terjadi error selain status 422
                        }
                    },
                });
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
                        @if (Storage::exists('public/daerah/' . $daerah->gambar[$i]))
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
                        @endif
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
