@extends('layouts.panel')
@section('title', 'Tambah Berita')
@section('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/filepond/filepond.css">
@endsection
@section('content')
    <form action="{{ route('berita.store') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="card">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control @error('judul') is-invalid  @enderror"
                                        id="judul" placeholder="" name="judul">
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        @error('judul')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="judul">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid  @enderror"
                                        id="slug" placeholder="" name="slug" readonly>
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        @error('judul')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea id="editor" name="deskripsi"></textarea>
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
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
                        <div class="form-grup">
                            <label for="deskripsi" class="form-label">Gambar</label>
                            <input id="image_upload" type="file" class="imgbb-filepond" name="gambar">
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                @error('gambar')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Unggah berita</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Unggah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
    <script src="{{ asset('') }}assets/static/js/pages/filepond.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor')).catch(error => {
            console.error(error);
        });
        $(document).ready(function() {
            $('#judul').on('input', function() {
                var judul = $(this).val().toLowerCase().replace(/\s+/g, '-');
                $('#slug').val(judul);
            });
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
            allowImagePreview: false,
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
