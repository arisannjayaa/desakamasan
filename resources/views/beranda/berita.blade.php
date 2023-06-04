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
                    <p class="text-truncate" style="line-height: 1.8;">{{ strip_tags($berita_last->deskripsi) }}</p>
                    <div>
                        <p><i
                                class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($berita_last->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($berita_last->created_at)->year ? 'd M' : 'd M Y') }}
                        </p><i class="bi"></i>
                    </div>
                </div>
                <div class="col-lg-5 col-12 order-1 order-lg-2 mb-lg-0 mb-5">
                    <div class="ratio ratio-4x3">
                        <img style="object-fit: cover;" class="img-fluid rounded-4 shadow-sm"
                            src="{{ asset('storage/berita/') . '/' . $berita_last->gambar }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5">
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
                            <a class="links" href="{{ route('beranda.berita.details', $row->slug) }}">
                                <div class="mb-3 ratio ratio-16x9">
                                    <img style="object-fit: cover; width: 100%; height: 100%;"
                                        class="img-fluid rounded-4 shadow-sm"
                                        src="{{ asset('storage/berita/') . '/' . $row->gambar }}" alt="">
                                </div>
                            </a>
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span>{{ \Carbon\Carbon::parse($row->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($row->created_at)->year ? 'd M' : 'd M Y') }}
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <h3 class="text-truncate fs-5">{{ $row->judul }}</h3>
                                    <p class="text-truncate text-sm">{{ strip_tags($row->deskripsi) }}</p>
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
