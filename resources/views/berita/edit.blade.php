@extends('layouts.panel')
@section('title', 'Edit Berita')
@push('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/filepond/filepond.css">
@endpush
@section('content')
    <form action="{{ route('berita.update', $berita->id_berita) }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="card">
                    <div class="card-body">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control @error('judul') is-invalid  @enderror"
                                        id="judul" placeholder="" name="judul" value="{{ $berita->judul }}">
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
                                        id="slug" placeholder="" name="slug" value="{{ $berita->slug }}" readonly>
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        @error('slug')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea id="editor" name="deskripsi">{{ $berita->deskripsi }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-grup">
                            <label for="deskripsi" class="form-label">Gambar</label>
                            <input id="image_upload" type="file" class="imgbb-filepond" name="gambar"
                                value="{{ $berita->foto }}">
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
                            <button type="submit" class="btn btn-primary">Perbaharui</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script src="{{ asset('') }}assets/extensions/filepond/filepond.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/filepond.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    'blockQuote',
                    'insertTable',
                    'undo',
                    'redo'
                ]
            },
        }).then(editor => {
            // console.log('Editor berhasil dibuat', editor);
        }).catch(error => {
            // console.error(error);
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
            allowImagePreview: true,
            allowFilePoster: true,
            files: [{
                // the server file reference
                source: "{{ asset('storage/berita') . '/' . $berita->foto }}",
                // set type to local to indicate an already uploaded file
                options: {
                    type: 'local',
                    // pass poster property
                    metadata: {
                        poster: "{{ asset('storage/berita') . '/' . $berita->foto }}",
                    },
                },
            }, ],
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
@endpush
