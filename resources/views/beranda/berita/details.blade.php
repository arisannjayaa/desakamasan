@extends('layouts.app')
@section('title', $berita->judul)
@push('css')
    <style>
        ul.pagination {
            justify-content: center;
        }
    </style>
@endpush
@section('content')
    @isset($berita)
        <div class="container">
            <div class="row mt-lg-5 mt-2 mb-lg-5">
                <div class="col-lg-6 col-12 align-self-end order-2 order-lg-1">
                    <h1 class="display-6 fw-bold mb-4">{{ $berita->judul }}</h1>
                    <div class="mb-lg-0 mb-3">
                        <p>
                            <i class="bi bi-calendar3 me-2"></i>
                            {{ \Carbon\Carbon::parse($berita->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($berita->created_at)->year ? 'd M' : 'd M Y') }}
                        </p>
                        <p>
                            <i class="bi bi-pencil me-2"></i>
                            Ditulis oleh {{ $berita->user->username }}
                        </p>
                        <a href="{{ url('/berita/tags/') . '/' . $berita->kategori->slug }}" class="nav-link">
                            <i class="bi bi-tag me-2"></i>
                            <span class="badge border rounded-4 text-secondary">{{ $berita->kategori->nama }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-12 order-1 order-lg-2 mb-lg-0 mb-5">
                    <div class="ratio ratio-4x3">
                        <img style="object-fit: cover;" class="img-fluid rounded-4 shadow-sm"
                            src="{{ asset('storage/berita/') . '/' . $berita->foto }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    @endisset
    <div class="bg-white">
        <hr class="mt-0">
        <div class="container-lg">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                <li class="breadcrumb-item active text-truncate w-75">{{ $berita->judul }}</li>
            </ol>
        </div>
        <hr class="mb-0">
    </div>
    <div class="container-lg container-fluid">
        <div class="row gap-lg-4 gap-1 bg-white">
            <div class="col-lg-7 col-12">
                <div class="p-lg-4 px-0 py-lg-3 py-1">
                    <div class="text-wrap">{!! $berita->deskripsi !!}</div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="mt-4">
                    <h5>Berita Terkait Lainnya</h5>
                    <div class="mt-3">
                        @foreach ($berita_all as $row)
                            <article class="d-flex gap-2 mb-3">
                                <div class="col-lg-5 col-5">
                                    <a style="object-fit: contain; width: 40%; height: 40%;" class="links"
                                        href="{{ route('berita.show', $row->slug) }}">
                                        <div class="mb-2">
                                            <div class="ratio ratio-4x3">
                                                <img style="object-fit: cover;" class="img-fluid rounded-4 shadow-sm"
                                                    src="{{ asset('storage/berita/') . '/' . $row->foto }}" alt="">
                                            </div>
                                        </div>
                                    </a>
                                    <div class="mb-1">
                                        <span
                                            class="text-sm">{{ \Carbon\Carbon::parse($row->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($row->created_at)->year ? 'd M' : 'd M Y') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-7 mt-1">
                                    <div class="mb-4">
                                        <h5 class="text-truncate fs-6">{{ $row->judul }}</h5>
                                        <p class="text-truncate text-sm text-wrap">
                                            {{ strip_tags(Str::limit($row->deskripsi, 70)) }}</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
