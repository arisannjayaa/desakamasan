@extends('layouts.panel')
@section('title', 'Produk')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Tabel Produk
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Toko/Pengerajin</th>
                            <th>Alamat</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
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
                ajax: '{{ route('produk-post.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',
                    },
                    {
                        data: 'id_kategori_produk',
                        name: 'id_kategori_produk',
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
