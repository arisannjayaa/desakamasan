@extends('layouts.panel')
@section('title', 'Edit Perangkat Desa')
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

        filepond--file-poster-wrapper {
            height: 100px;
        }

        .filepond--item {
            width: calc(30% - 0.5em);
            margin: auto;
        }
    </style>
@endpush
@section('content')
    {{-- @dd($riwayat_kerja) --}}
    <div id="errorContainer"></div>
    <form id="myForm" action="{{ route('perangkat-desa.update', $perangkat_desa->id) }}" method="post"
        enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <span>Foto</span>
                    </div>
                    <div class="card-body">
                        <div class="form-grup">
                            <label for="deskripsi" class="form-label">Gambar</label>
                            <input id="image_upload" type="file" class="imgbb-filepond" name="gambar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <span>Informasi Pribadi</span>
                    </div>
                    <div class="card-body">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="" name="nama"
                                        value="{{ $perangkat_desa->nama }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" placeholder="" name="jabatan"
                                        value="{{ $perangkat_desa->jabatan }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="form-group">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" placeholder=""
                                        name="tempat_lahir" value="{{ $perangkat_desa->tempat_lahir }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" placeholder=""
                                        name="tanggal_lahir" value="{{ $perangkat_desa->tanggal_lahir }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="choices form-select" name="jenis_kelamin">
                                        <option value="">Pilih jenis kelamin:</option>
                                        <option {{ $perangkat_desa->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}
                                            value="Laki-Laki">Laki-Laki</option>
                                        <option {{ $perangkat_desa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}
                                            value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-10">
                                <div class="form-group">
                                    <label for="status_kawin" class="form-label">Status Kawin</label>
                                    <select class="choices form-select" name="status_kawin">
                                        <option value="">Pilih status kawin:</option>
                                        <option {{ $perangkat_desa->status_kawin == 'Kawin' ? 'selected' : '' }}
                                            value="Kawin">Kawin</option>
                                        <option {{ $perangkat_desa->status_kawin == 'Belum Kawin' ? 'selected' : '' }}
                                            value="Belum Kawin">Belum Kawin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2">
                                <div class="form-group">
                                    <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                                    <input type="text" class="form-control" id="jumlah_anak" placeholder=""
                                        name="jumlah_anak" value="{{ $perangkat_desa->jumlah_anak }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" id="pendidikan_terakhir" placeholder=""
                                        name="pendidikan_terakhir" value="{{ $perangkat_desa->pendidikan_terakhir }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" placeholder=""
                                        name="alamat" value="{{ $perangkat_desa->alamat }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <span>Riwayat Pekerjaan dan Pengalaman Organisasi</span>
                    </div>
                    <div class="card-body">
                        @foreach ($riwayat_kerja as $key => $row)
                            <div id="riwayat_kerja_{{ $key }}" class="card riwayat-kerja">
                                <div class="card-body">
                                    <div class="row">
                                        <input id="id_kerja"" type="text" value="{{ $row->id }}" hidden
                                            name="id_kerja[]">
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="perusahaan_organisasi" class="form-label">Perusahaan
                                                    Organisasi</label>
                                                <input type="text" class="form-control" id="perusahaan_organisasi"
                                                    placeholder="" name="perusahaan_organisasi[]"
                                                    value="{{ $row->perusahaan_organisasi }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="tahun_mulai" class="form-label">Tahun Mulai</label>
                                                <input type="text" class="form-control" id="tahun_mulai"
                                                    placeholder="" name="tahun_mulai[]" value="{{ $row->tahun_mulai }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="tahun_selesai" class="form-label">Tahun Selesai</label>
                                                <input type="text" class="form-control" id="tahun_selesai"
                                                    placeholder="" name="tahun_selesai[]"
                                                    value="{{ $row->tahun_selesai }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($key != 0)
                                    <div class="d-flex justify-content-end mb-3 me-3"><button id="btnHapus"
                                            type="button" class="btn btn-danger"
                                            onclick="removeKerja('{{ $key }}', '{{ $row->id }}')">Hapus</button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <button id="btn_riwayat_kerja" type="button" class="btn btn-primary">Tambah
                            Riwayat</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <span>Riwayat Pendidikan</span>
                    </div>
                    <div class="card-body">
                        @foreach ($riwayat_pendidikan as $key => $row)
                            <div id="riwayat_pendidikan_{{ $key }}" class="card riwayat-pendidikan">
                                <div class="card-body">
                                    <div class="row">
                                        <input type="text" value="{{ $row->id }}" hidden name="id_pendidikan[]">
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="jenjang" class="form-label">Jenjang</label>
                                                <input type="text" class="form-control" id="jenjang" placeholder=""
                                                    name="jenjang[]" value="{{ $row->jenjang }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="institusi" class="form-label">Institusi</label>
                                                <input type="text" class="form-control" id="institusi" placeholder=""
                                                    name="institusi_pendidikan[]" value="{{ $row->institusi }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                                <input type="text" class="form-control" id="tahun_lulus"
                                                    placeholder="" name="tahun_lulus[]" value="{{ $row->tahun_lulus }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($key != 0)
                                    <div class="d-flex justify-content-end mb-3 me-3"><button id="btnHapus"
                                            type="button" class="btn btn-danger"
                                            onclick="removePendidikan('{{ $key }}', '{{ $row->id }}')">Hapus</button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <button id="btn_riwayat_pendidikan" type="button" class="btn btn-primary">Tambah
                            Riwayat</button>
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
        function removeKerja(id, id_kerja) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1d4ed8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var riwayatKerja = $('#riwayat_kerja_' + id);
                    riwayatKerja.remove();
                    $.ajax({
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('/user/riwayatkerja/delete/') }}" + '/' + id_kerja,
                        data: {
                            id_kerja: id_kerja
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Okey',
                            })
                        }
                    });
                }
            });
        }

        function removePendidikan(id, id_pendidikan) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1d4ed8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var riwayatPendidikan = $('#riwayat_pendidikan_' + id);
                    riwayatPendidikan.remove();
                    $.ajax({
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('/user/riwayatpendidikan/delete/') }}" + '/' + id_pendidikan,
                        data: {
                            id_pendidikan: id_pendidikan
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Okey',
                            })
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            let counterKerja = 1; // Menyimpan jumlah elemen riwayat kerja yang telah ditambahkan

            $('#btn_riwayat_kerja').click(function() {
                // Mengambil elemen terakhir yang ditambahkan
                const lastRiwayatKerja = $('.riwayat-kerja').last();

                // Membuat salinan elemen terakhir yang ditambahkan
                const clonedRiwayatKerja = lastRiwayatKerja.clone();

                // Menghapus nilai input pada elemen riwayat kerja yang baru
                clonedRiwayatKerja.find('input').val('');

                // Menghapus elemen yang tidak diperlukan
                clonedRiwayatKerja.find('.d-flex.justify-content-end.mb-3.me-3').remove();

                // Menambahkan tombol hapus
                const hapusButton = $('<div class="d-flex justify-content-end mb-3 me-3">' +
                    '<button type="button" class="btn btn-danger">Hapus</button>' +
                    '</div>');

                // Menghapus event click sebelumnya dari tombol hapus
                hapusButton.off('click').click(function() {
                    $(this).parent().remove();
                });

                clonedRiwayatKerja.append(hapusButton);

                // Mengupdate nomor urut elemen riwayat kerja
                clonedRiwayatKerja.find('.nomor-urut').text(counterKerja + 1);

                // Menambahkan atribut "name" yang unik untuk input dan elemen terkait
                const inputs = clonedRiwayatKerja.find('input');
                inputs.each(function() {
                    const name = $(this).attr('name');
                    const newName = name + counterKerja;
                    $(this).attr('name', newName);
                });

                // Menambahkan elemen riwayat kerja yang baru setelah elemen terakhir
                clonedRiwayatKerja.insertAfter(lastRiwayatKerja);

                counterKerja++; // Menambahkan counter setelah menambahkan elemen riwayat kerja baru
            });

            let counterPendidikan = 1; // Menyimpan jumlah elemen riwayat kerja yang telah ditambahkan

            $('#btn_riwayat_pendidikan').click(function() {
                // Mengambil elemen terakhir yang ditambahkan
                const lastRiwayatPendidikan = $('.riwayat-pendidikan').last();

                // Membuat salinan elemen terakhir yang ditambahkan
                const clonedRiwayatPendidikan = lastRiwayatPendidikan.clone();

                // Menghapus nilai input pada elemen riwayat kerja yang baru
                clonedRiwayatPendidikan.find('input').val('');

                // Menghapus elemen yang tidak diperlukan
                clonedRiwayatPendidikan.find('.d-flex.justify-content-end.mb-3.me-3').remove();

                // Menambahkan tombol hapus
                const hapusButton = $('<div class="d-flex justify-content-end mb-3 me-3">' +
                    '<button type="button" class="btn btn-danger">Hapus</button>' +
                    '</div>');

                // Menghapus event click sebelumnya dari tombol hapus
                hapusButton.off('click').click(function() {
                    $(this).parent().remove();
                });

                clonedRiwayatPendidikan.append(hapusButton);

                // Mengupdate nomor urut elemen riwayat kerja
                clonedRiwayatPendidikan.find('.nomor-urut').text(counterPendidikan + 1);

                // Menambahkan atribut "name" yang unik untuk input dan elemen terkait
                const inputs = clonedRiwayatPendidikan.find('input');
                inputs.each(function() {
                    const name = $(this).attr('name');
                    const newName = name + counterPendidikan;
                    $(this).attr('name', newName);
                });

                // Menambahkan elemen riwayat kerja yang baru setelah elemen terakhir
                clonedRiwayatPendidikan.insertAfter(lastRiwayatPendidikan);

                counterPendidikan++; // Menambahkan counter setelah menambahkan elemen riwayat kerja baru
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
                                    '{{ route('perangkat-desa.index') }}'; // Ganti URL dengan halaman yang ingin Anda arahkan
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
            allowFilePoster: true,
            allowMultiple: false,
            maxFiles: 1,
            @if ($perangkat_desa->foto)
                files: [
                    @if (Storage::exists('public/perangkat-desa/' . $perangkat_desa->foto))
                        {
                            // the server file reference
                            source: "{{ asset('storage/perangkat-desa') . '/' . $perangkat_desa->foto }}",
                            // set type to local to indicate an already uploaded file
                            options: {
                                type: 'local',
                                // pass poster property
                                metadata: {
                                    poster: "{{ asset('storage/perangkat-desa') . '/' . $perangkat_desa->foto }}",
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
