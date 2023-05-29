@extends('layouts.panel')
@section('title', 'Berita')
@section('content')
    <div id="successAlert" class="alert alert-success alert-dismissible show fade d-none">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Tabel Berita
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
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
        $(document).on('submit', '#formDelete', function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: 'DELETE',
                url: url,
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    // datatable reload otomatis saat delete data
                    Swal.fire({
                        title: 'Error!',
                        text: 'Do you want to continue?',
                        icon: 'error',
                        showCancelButton: true,
                        confirmButtonText: 'Cool',
                        cancelButtonText: 'Cancel'
                    });

                    console.log(response);
                    if (response.status == 200) {
                        $('#successAlert').removeClass('d-none');
                        $('#tables').DataTable().ajax.reload();
                        $('#successAlert').text(response.message).fadeIn().delay(2000).fadeOut();
                    }
                },
                error: function(xhr, status, error) {
                    // Terjadi error saat menghapus data, lakukan penanganan error
                }
            });
        });
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
                ajax: '{{ route('berita.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'judul',
                        name: 'judul',
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        orderable: false,
                        searchable: false
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
