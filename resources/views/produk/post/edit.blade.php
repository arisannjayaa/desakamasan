@extends('layouts.panel')
@section('title', 'Edit Berita')
@push('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/extensions/filepond/filepond.css">
    <style>
        .choices__inner {
            background: #fff;
        }

        .choices__list--multiple .choices__item {
            background: #1942b8;
            border: 1px solid #1e4fde;
        }

        .filepond--item {
            width: calc(50% - 0.5em);
        }
    </style>
@endpush
@section('content')
    <form id="myForm" action="{{ route('produk-post.update', $produk->id) }}" method="post" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div id="errorContainer"></div>
                <div class="card">
                    <div class="card-body">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama Toko / Pengerajin</label>
                                    <input type="text" class="form-control" id="nama" placeholder="" name="nama"
                                        value="{{ $produk->nama }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" placeholder="" name="slug"
                                        readonly value="{{ $produk->slug }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" placeholder="" name="alamat"
                                        value="{{ $produk->alamat }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="kategori" class="form-label">Kategori </label>
                                    <select class="choices form-select" name="kategori">
                                        <option value="">Pilih kategori:</option>
                                        @foreach ($kategori as $row)
                                            <option {{ $produk->id_kategori_produk == $row->id ? 'selected' : '' }}
                                                value="{{ $row->id }}">{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea id="editor" name="deskripsi">{{ $produk->deskripsi }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-grup">
                            <label for="deskripsi" class="form-label">Gambar
                                (Maximal 4 Gambar)</label>
                            <div class="alert alert-light-info">
                                Gunakan format gambar atau pas foto ukuran rasio 16:9 untuk tampilan yang lebih baik
                            </div>
                            <input id="image_upload" type="file" class="imgbb-filepond" name="gambar">
                        </div>
                    </div>
                </div>
                <div class="mt-2 d-grid gap-2">
                    <button id="btnSubmit" type="submit" class="btn btn-primary">Perbaharui</button>
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
                                    '{{ route('produk-post.index') }}'; // Ganti URL dengan halaman yang ingin Anda arahkan
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
            allowMultiple: true,
            maxFiles: 4,
            maxParallelUploads: 4,
            stylePanelAspectRatio: '4:3',
            @if ($produk->foto)
                files: [
                    @foreach ($produk->foto as $foto)
                        @if (Storage::exists('public/produk/' . $foto->file))
                            {
                                // the server file reference
                                source: "{{ asset('storage/produk') . '/' . $foto->file }}",
                                // set type to local to indicate an already uploaded file
                                options: {
                                    type: 'local',
                                    // pass poster property
                                    metadata: {
                                        poster: "{{ asset('storage/produk') . '/' . $foto->file }}",
                                    },
                                },
                            },
                        @endif
                    @endforeach
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
