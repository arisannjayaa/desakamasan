@extends('layouts.panel')
@section('title', 'Edit Sosial Media')
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
    </style>
@endpush
@section('content')
    <div id="errorContainer"></div>
    <form id="myForm" action="{{ route('sosial-media.update', $sosial_media->id) }}" method="post">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-body">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="" name="nama"
                                        value="{{ old('nama', $sosial_media->nama) }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="url" class="form-label">Url</label>
                                    <div class="alert alert-light-info">Berikan url yang valid sesuai media sosial yang
                                        digunakan contoh: <span
                                            class="badge bg-info">https://www.instagram.com/contoh21</span>
                                    </div>
                                    <input type="text" class="form-control" id="url" placeholder="" name="url"
                                        value="{{ old('url', $sosial_media->url) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2 d-grid gap-2 d-md-block">
            <button id="btnSubmit" type="submit" class="btn btn-primary">Perbaharui</button>
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
                                    '{{ route('sosial-media.index') }}'; // Ganti URL dengan halaman yang ingin Anda arahkan
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
    </script>
@endpush
