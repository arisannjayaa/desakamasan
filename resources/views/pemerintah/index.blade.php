@extends('layouts.panel')
@section('title', $menu)
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Tabel {{ $menu }}
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Status Kawin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@include('pemerintah.show-modal')
@push('js')
    <script>
        function showModal(id) {
            $('#myModal').modal('show');
            $.ajax({
                type: "get",
                url: "/user/perangkat-desa/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var data = response.data;
                    $('#nama').text(data.nama);
                    $('#jabatan').text(data.jabatan);
                    $('#tanggal_lahir').text(data.tanggal_lahir);
                    $('#tempat_lahir').text(data.tempat_lahir);
                    $('#jenis_kelamin').text(data.jenis_kelamin);
                    $('#status_kawin').text(data.status_kawin);
                    $('#jumlah_anak').text(data.jumlah_anak);
                    $('#pendidikan_terakhir').text(data.pendidikan_terakhir);
                    $('#alamat').text(data.alamat);
                    $('#foto').attr('src', '{{ asset('storage/perangkat-desa') }}' + '/' + data.foto);
                    // console.log(data.riwayat_kerja);\
                    var cardKerja = '';
                    $.each(data.riwayat_kerja, function(indexInArray, item) {
                        console.log(item);
                        cardKerja += `<div class="mb-2">
                                        <table style="font-size: 12px">
                                            <tr>
                                                <td>Perusahaan atau Organisasi</td>
                                                <td>:</td>
                                                <td> ${item.perusahaan_organisasi}</td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Mulai</td>
                                                <td>:</td>
                                                <td> ${item.tahun_mulai}</td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Selesai</td>
                                                <td>:</td>
                                                <td> ${item.tahun_selesai}</td>
                                            </tr>
                                        </table>
                                    </div>`;
                    });
                    $('#pekerjaan_wrapper').html(cardKerja);

                    var cardPendidikan = '';
                    $.each(data.riwayat_pendidikan, function(indexInArray, item) {
                        console.log(item);
                        cardPendidikan += ` <div class="mb-2">
                                        <table style="font-size: 12px">
                                            <tr>
                                                <td>Jenjang</td>
                                                <td>:</td>
                                                <td> ${item.jenjang}</td>
                                            </tr>
                                            <tr>
                                                <td>Institusi</td>
                                                <td>:</td>
                                                <td> ${item.institusi}</td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Lulus</td>
                                                <td>:</td>
                                                <td> ${item.tahun_lulus}</td>
                                            </tr>
                                        </table>
                                    </div>`;
                    });
                    $('#pendidikan_wrapper').html(cardPendidikan);
                },
            });
            console.log(id);
        }
        $(document).ready(function() {
            $('#tables').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                responsive: true,
                language: {
                    "lengthMenu": "_MENU_",
                    "info": "Menampilkan _START_ dari _END_ dari  _TOTAL_ data",
                    "search": "Cari:",
                    infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                    infoFiltered: "(disaring dari _MAX_ total entri)",
                    "emptyTable": "Data tidak tersedia",
                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                },
                ajax: '{{ route('perangkat-desa.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'foto',
                        name: 'foto',
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan',
                    },
                    {
                        data: 'pendidikan_terakhir',
                        name: 'pendidikan_terakhir',
                    },
                    {
                        data: 'status_kawin',
                        name: 'status_kawin',
                    },
                    {
                        data: 'opsi',
                        name: 'opsi',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnsDefs: []
            })
        })
    </script>
@endpush
