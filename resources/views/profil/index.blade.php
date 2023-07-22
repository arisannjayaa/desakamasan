@extends('layouts.panel')
@section('title', 'Profil Desa')
@push('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/filepond/filepond.css">
@endpush
@section('content')
    <form id="myForm" action="{{ route('profil-desa.update', $profil->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div id="errorContainer"></div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-grup">
                            <label for="deskripsi">Gambar (Maximal
                                1 Gambar) </label>
                            <div class="alert alert-light-info">
                                Gunakan format gambar atau pas foto ukuran rasio 16:9 untuk tampilan yang lebih baik
                            </div>
                            <input id="image_upload" type="file" class="imgbb-filepond" name="gambar">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="" name="nama"
                                        value="{{ $profil->nama }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Deskripsi </label>
                                    <textarea id="editor" name="deskripsi">{{ $profil->deskripsi }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Visi</label>
                                    <textarea id="editor1" name="visi">{{ $profil->visi }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Misi</label>
                                    <textarea id="editor2" name="misi">{{ $profil->misi }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-grup">
                            <label for="deskripsi" class="form-label">Video</label>
                            <div class="alert alert-light-info">
                                Salin url video youtube ke form dibawah ini, contoh:
                                https://www.youtube.com/watch?v=pLdjw4u07_eEE
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-youtube mb-2"></i></span>
                                <input type="text" class="form-control" name="video" placeholder="https://youtu.be/xxx"
                                    value="{{ $profil->video }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 d-grid gap-2">
                    <button id="btnSubmit" type="submit" class="btn btn-primary">Perbaharui</button>
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
        function createCke(id) {
            ClassicEditor.create(document.querySelector(id), {
                    toolbar: {
                        items: [
                            "heading",
                            "|",
                            "bold",
                            "italic",
                            "link",
                            "bulletedList",
                            "numberedList",
                            "blockQuote",
                            "insertTable",
                            "undo",
                            "redo",
                        ],
                    },
                })
                .then((editor) => {
                    // console.log('Editor berhasil dibuat', editor);
                })
                .catch((error) => {
                    // console.error(error);
                });
        }
        $(document).ready(function() {
            createCke("#editor1");
            createCke("#editor2");
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
                        $('#btnSubmit').html('Simpan');
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
                                location.reload(true);
                                // Pengguna mengklik tombol "Cool"
                                // Ganti URL dengan halaman yang ingin Anda arahkan
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
            allowMultiple: false,
            @if ($profil->foto)
                files: [
                    @if (Storage::exists('public/profil/' . $profil->foto))
                        {
                            // the server file reference
                            source: "{{ asset('storage/profil') . '/' . $profil->foto }}",
                            // set type to local to indicate an already uploaded file
                            options: {
                                type: 'local',
                                // pass poster property
                                metadata: {
                                    poster: "{{ asset('storage/profil') . '/' . $profil->foto }}",
                                },
                            },
                        },
                    @endif
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
