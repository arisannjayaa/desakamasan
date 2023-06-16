@extends('layouts.app')
@section('title', 'Berita')
@push('css')
    <style>
        ul.pagination {
            justify-content: center;
        }
    </style>
@endpush
@section('content')
    @if (isset($berita_last))
        <div class="container">
            <div class="row mt-lg-5 mt-2 mb-lg-5">
                <div class="col-lg-7 col-12 align-self-end order-2 order-lg-1">
                    <h1 class="display-6 fw-bold mb-4">{{ $berita_last->judul }}</h1>
                    <p style="line-height: 1.8;">
                        {{ strip_tags(Str::limit($berita_last->deskripsi, 110)) }}</p>
                    <div>
                        <p>
                            <i class="bi bi-calendar3 me-2"></i>
                            {{ \Carbon\Carbon::parse($berita_last->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($berita_last->created_at)->year ? 'd M' : 'd M Y') }}
                        </p>
                        <p>
                            <i class="bi bi-pencil me-2"></i>
                            Ditulis oleh {{ $berita_last->user->username }}
                        </p>
                        <a href="{{ url('/berita/tags/') . '/' . $berita_last->kategori->slug }}" class="nav-link">
                            <i class="bi bi-tag me-2"></i>
                            <span class="badge border rounded-4 text-secondary">{{ $berita_last->kategori->nama }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 col-12 order-1 order-lg-2 mb-lg-0 mb-5">
                    <div class="ratio ratio-4x3">
                        <img style="object-fit: cover;" class="img-fluid rounded-4 shadow-sm"
                            src="{{ asset('storage/berita/') . '/' . $berita_last->foto }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5 bg-white">
            <hr>
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terbaru</li>
                </ol>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($berita_all as $row)
                    <div class="col-lg-4 col-md-6 col-12">
                        <article>
                            <a class="links" href="{{ route('berita.show', $row->slug) }}">
                                <div class="mb-3 ratio ratio-16x9">
                                    <img style="object-fit: cover; width: 100%; height: 100%;"
                                        class="img-fluid rounded-4 shadow-sm"
                                        src="{{ asset('storage/berita/') . '/' . $row->foto }}" alt="">
                                </div>
                            </a>
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <span>{{ \Carbon\Carbon::parse($row->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($row->created_at)->year ? 'd M' : 'd M Y') }}
                                    </span>
                                    <a href="#" class="nav-link">
                                        <span
                                            class="badge border rounded-4 text-secondary">{{ $row->kategori->nama }}</span>
                                    </a>
                                </div>
                                <div class="mb-4">
                                    <h5 class="text-truncate">{{ $row->judul }}</h5>
                                    <p class="text-sm">{{ strip_tags(Str::limit($row->deskripsi, 85)) }}</p>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="d-lg-block d-none">
                {{ $berita_all->links() }}
            </div>
            <div class="d-lg-none d-block">
                {{ $berita_simple->links() }}
            </div>
        </div>
    @else
        @include('beranda.error-404')
    @endif
@endsection
