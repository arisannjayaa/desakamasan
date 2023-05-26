@extends('layouts.panel')
@section('title', 'Tambah Daerah')
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
    @if ($errors->any())
        <div class="alert alert-light-danger color-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><i class="bi bi-exclamation-circle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('daerah.store') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama"
                                        class="form-label @error('nama') text-danger @enderror">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="" name="nama"
                                        value="{{ old('nama') }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="slug"
                                        class="form-label @error('slug') text-danger @enderror">Slug</label>
                                    <input type="text" class="form-control" id="slug" placeholder="" name="slug"
                                        readonly value="{{ old('slug') }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="alamat"
                                        class="form-label @error('alamat') text-danger @enderror">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" placeholder="" name="alamat"
                                        value="{{ old('alamat') }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label
                                        for="telepon"class="form-label @error('telepon') text-danger @enderror">Telepon</label>
                                    <input type="text" class="form-control" id="telepon" placeholder="" name="telepon"
                                        value="{{ old('telepon') }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="fasilitas"
                                        class="form-label @error('fasilitas') text-danger @enderror">Fasilitas
                                    </label>
                                    <select class="choices form-select multiple-remove" multiple="multiple"
                                        name="fasilitas[]">
                                        <option value="Penginapan">Penginapan</option>
                                        <option value="Areal Parkir">Areal Parkir</option>
                                        <option value="Kamar Mandi Umum">Kamar Mandi Umum</option>
                                        <option value="ATMs">ATMs</option>
                                        <option value="Spot Foto">Spot Foto</option>
                                        <option value="Balai Pertemuan">Balai Pertemuan</option>
                                        <option value="Wifi Area">Wifi Area</option>
                                        <option value="Tempat Makan">Tempat Makan</option>
                                        <option value="Pusat Informasi">Pusat Informasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="kategori"
                                        class="form-label @error('kategori') text-danger @enderror">Kategori </label>
                                    <select class="choices form-select" name="kategori">
                                        <option value="Wisata Alam">Wisata Alam</option>
                                        <option value="Wisata Budaya">Wisata Budaya</option>
                                        <option value="Wisata Buatan">Wisata Buatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi"
                                        class="form-label @error('deskripsi') text-danger @enderror">Deskripsi </label>
                                    <textarea id="editor" name="deskripsi">{{ old('deskripsi') }}</textarea>
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
                                    <input type="text" class="form-control" id="latitude" placeholder="" name="latitude"
                                        value="{{ old('latitude') }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="longitude"
                                        class="form-label @error('longitude') text-danger @enderror">Longitude </label>
                                    <input type="text" class="form-control" id="longitude" placeholder=""
                                        name="longitude" value="{{ old('longitude') }}">
                                </div>
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
        });

        function deleteImage(namaFile) {
            $.ajax({
                url: "{{ route('image.delete') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                data: {
                    image: namaFile
                },
                success: function(response) {
                    console.log(response)
                },
                error: function(response) {
                    console.log('error')
                }
            });
        }

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
                    deleteImage(uniqueFileId);
                    error('Error terjadi saat menghapus file');
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
