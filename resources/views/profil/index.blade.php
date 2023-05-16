@extends('layouts.panel')
@section('title', 'Profil Desa')
@section('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/filepond/filepond.css">
    <link rel="stylesheet"
        href="{{ asset('') }}assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/toastify-js/src/toastify.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/quill/quill.snow.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/quill/quill.bubble.css">
@endsection
@section('content')
    @foreach ($profils as $profil)
        <form action="{{ route('profil.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="d-flex flex-lg-row flex-column align-items-lg-end align-items-start gap-4">
                                        <img id="preview-foto" class="d-block img-thumbnail" height="150" width="150"
                                            src="{{ asset('') . $profil->foto_profil }}" alt="Logo Profil">
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
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" placeholder=""
                                            name="nama" value="{{ $profil->nama }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" class="form-control" id="telepon" placeholder=""
                                            name="telepon" value="{{ $profil->telepon }}">
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" placeholder=""
                                            name="alamat" value="{{ $profil->alamat }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" class="form-control" id="longitude" placeholder=""
                                            name="longitude" value="{{ $profil->longitude }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" class="form-control" id="latitude" placeholder=""
                                            name="latitude" value="{{ $profil->latitude }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="video" class="form-label">Gambar</label>
                                        <input type="file" class="multiple-files-filepond" name="gambar[]" multiple>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="video" class="form-label">Video</label>
                                        <input type="file" class="basic-filepond" name="video">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <input type="hidden" name="deskripsi" value="{{ $profil->deskripsi }}">
                                        <div id="editor" style="min-height: 200px">
                                            {{ strip_tags($profil->deskripsi) }}</div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                                </div>
                            </div>
    @endforeach
    </form>
    </div>
    </div>
    </div>
    </div>
@endsection
@section('js')
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
    <script src="{{ asset('') }}assets/extensions/filepond/filepond.js"></script>
    <script src="{{ asset('') }}assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/filepond.js"></script>
    <script src="{{ asset('') }}assets/extensions/quill/quill.min.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/quill.js"></script>
    <script>
        $(document).ready(function() {
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

        quill = new Quill('#editor', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='deskripsi']").value = quill.root.innerHTML;
        });
    </script>
@endsection
