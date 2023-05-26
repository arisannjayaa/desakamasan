@extends('layouts.panel')
@section('title', 'Tambah Berita')
@push('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/filepond/filepond.css">
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
    <form action="{{ route('berita.store') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="card">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="judul"
                                        class="form-label @error('judul') text-danger @enderror">Judul</label>
                                    <input type="text" class="form-control" id="judul" placeholder="" name="judul"
                                        value="{{ old('judul') }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group" class="form-label @error('slug') text-danger @enderror">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" placeholder="" name="slug"
                                        readonly value="{{ old('slug') }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi"
                                        class="form-label @error('deskripsi') text-danger @enderror">Deskripsi</label>
                                    <textarea class="form-control" id="editor" name="deskripsi">{{ old('deskripsi') }}</textarea>
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
@push('js')
    <script src="{{ asset('') }}assets/extensions/filepond/filepond.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/filepond.js"></script>
    <script src="{{ asset('') }}assets/extensions/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('') }}assets/static/js/pages/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('#judul').on('input', function() {
                var judul = $(this).val().toLowerCase().replace(/\s+/g, '-');
                $('#slug').val(judul);
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

            // Filepond
            FilePond.create(document.querySelector("#image_upload"), {
                credits: null,
                allowImagePreview: true,
                acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
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
                storeAsFile: true,
            });
        });
    </script>
@endpush
