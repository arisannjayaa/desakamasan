@extends('layouts.panel')
@section('title', 'Berita')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Tabel Berita
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
                        @foreach ($berita as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img height="50" src="{{ asset('') . $row->foto }}" alt="">
                                </td>
                                <td>{{ $row->judul }}</td>
                                <td class="text-truncate" style="max-width: 100px;">
                                    {{ strip_tags($row->deskripsi) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu border border-1">
                                            <li><span
                                                    onclick="window.location.href='{{ route('berita.edit', $row->id_berita) }}'"
                                                    role="button"class="dropdown-item">Edit</span></li>
                                            <li><span onclick="window.location.href="
                                                    role="button"class="dropdown-item">Lihat</span></li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah Anda yakin menghapus data ini?')"><i
                                            class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
