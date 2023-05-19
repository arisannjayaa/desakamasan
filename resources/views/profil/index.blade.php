@extends('layouts.panel')
@section('title', 'Profil Desa')
@section('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/filepond/filepond.css">
@endsection
@section('content')
    <form action="{{ route('profil.store') }}" method="post" enctype="multipart/form-data">
        @foreach ($profil as $row)
            @csrf
            <input type="hidden" readonly value="{{ $row->id_profil_desa }}" name="id">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="d-flex flex-lg-row flex-column align-items-lg-end align-items-start gap-4">
                                        <img id="preview-foto" class="d-block img-thumbnail" height="150" width="150"
                                            src="{{ asset('') . $row->foto_profil }}" alt="Logo Profil">
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
                                            name="nama" value="{{ $row->nama }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" class="form-control" id="telepon" placeholder=""
                                            name="telepon" value="{{ $row->telepon }}">
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" placeholder=""
                                            name="alamat" value="{{ $row->alamat }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" class="form-control" id="longitude" placeholder=""
                                            name="longitude" value="{{ $row->longitude }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" class="form-control" id="latitude" placeholder=""
                                            name="latitude" value="{{ $row->latitude }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="video" class="form-label">Gambar</label>
                                        <input id="gambar_upload" type="file" class="imgbb-filepond" name="gambar"
                                            multiple>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="video" class="form-label">Video</label>
                                        <input id="video_upload" type="file" class="imgbb-filepond" name="video">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea id="editor">{{ $row->deskripsi }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                                </div>
                            </div>
        @endforeach
    </form>
@endsection
@section('js')
    <script src="{{ asset('') }}assets/extensions/filepond/filepond.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/filepond.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor')).catch(error => {
            console.error(error);
        });
    </script>
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

        // Filepond: ImgBB with server property
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
        FilePond.create(document.querySelector("#gambar_upload"), {
            credits: null,
            allowImagePreview: true,
            allowMultiple: true,
            acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
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
            storeAsFile: true,
        });
    </script>
@endsection
