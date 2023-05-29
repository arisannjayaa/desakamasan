@extends('layouts.app')
@section('title', 'Beranda')
@push('css')
    <style>
        ul.pagination {
            justify-content: center;
        }
    </style>
@endpush
@section('content')
    <div class="row mt-lg-5 mt-2 mb-lg-5">
        <div class="col-lg-6 col-12 align-self-end order-2 order-lg-1">
            <h1 class="display-6 fw-bold mb-4">{{ $berita_last->judul }}</h1>
            <p class="text-truncate text-wrap" style="line-height: 1.8;">{{ strip_tags($berita_last->deskripsi) }}</p>
            <div>

                <p><i class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($berita_last->created_at)->format('d M') }}
                </p>
                <p><i class="bi bi-pencil-square me-2"></i>Ditulis oleh Administrator</p>
            </div>
        </div>
        <div class="col-lg-6 col-12 order-1 order-lg-2 mb-lg-0 mb-5">
            <img style="object-fit: cover; width: 100%; height: 100%;" class="img-fluid rounded-4 shadow"
                src="{{ asset('storage/berita/') . '/' . $berita_last->gambar }}" alt="">
        </div>
    </div>
    <div class="mb-5">
        <hr>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">Terbaru</li>
        </ol>
        <hr>
    </div>
    <div class="row">
        @foreach ($berita_all as $row)
            <div class="col-lg-4 col-md-6 col-12">
                <article>
                    <div class="mb-3">
                        <img style="object-fit: cover; width: 100%; height: 100%;" class="img-fluid rounded-4"
                            src="{{ asset('storage/berita/') . '/' . $row->gambar }}" alt="">
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span>{{ \Carbon\Carbon::parse($row->created_at)->format('d M') }}</span>
                            <span>Author</span>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-truncate">{{ $row->judul }}</h3>
                            <p class="text-truncate text-wrap">{{ strip_tags($row->deskripsi) }}</p>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
    {{ $berita_all->links() }}
@endsection
