@extends('layouts.panel')
@section('title', 'Edit Berita')
@push('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/filepond/filepond.css">
@endpush
@section('content')
    <div id="errorContainer"></div>
    <form id="myForm" action="{{ route('berita.update', $berita->id) }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="card">
                    <div class="card-body">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="judul"
                                        class="form-label @error('judul') text-danger @enderror">Judul</label>
                                    <input type="text" class="form-control" id="judul" placeholder="" name="judul"
                                        value="{{ old('judul', $berita->judul) }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="slug"
                                        class="form-label @error('slug') text-danger @enderror">Slug</label>
                                    <input type="text" class="form-control" id="slug" placeholder="" name="slug"
                                        value="{{ old('slug', $berita->slug) }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group" class="form-label @error('deskripsi') text-danger @enderror">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea id="editor" name="deskripsi">{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-grup" class="form-label">
                            <label for="deskripsi" class="form-label">Gambar</label>
                            <input id="image_upload" type="file" class="imgbb-filepond" name="gambar">
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
                        <div class="mt-2 mt-lg-0 d-grid gap-2">
                            <button id="btnSubmit" type="submit" class="btn btn-primary">Perbaharui</button>
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
                    $('#btnSubmit').html('Perbaharui');
                    $('#btnSubmit').removeAttr('disabled');
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Okey',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Pengguna mengklik tombol "Cool"
                            window.location.href =
                                '{{ route('berita.index') }}'; // Ganti URL dengan halaman yang ingin Anda arahkan
                        } else {
                            // Pengguna mengklik tombol "Cancel" atau menutup SweetAlert
                            // Lakukan tindakan lain jika diperlukan
                        }
                    });
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
            allowFilePoster: true,
            @if ($berita->gambar)
                files: [
                    @if (Storage::exists('public/berita/' . $berita->gambar))
                        {
                            // the server file reference
                            source: "{{ asset('storage/berita') . '/' . $berita->gambar }}",
                            // set type to local to indicate an already uploaded file
                            options: {
                                type: 'local',
                                // pass poster property
                                metadata: {
                                    poster: "{{ asset('storage/berita') . '/' . $berita->gambar }}",
                                },
                            },
                        },
                    @endif
                ],
            @endif
            acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
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
            storeAsFile: true,

        });
    </script>
@endpush
