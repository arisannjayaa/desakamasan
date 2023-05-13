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
            <div class="datatable-minimal">
                <table class="table" id="table2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
