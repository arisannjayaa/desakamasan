@extends('layouts.app')
@section('title', 'Daerah')
@push('css')
    <style>
        ul.pagination {
            justify-content: center;
        }
    </style>
@endpush
@section('content')
    @isset($daerah)
        <div class="container">
            <div class="row flex-column mt-lg-5 mt-2">
                <div class="col-lg-12 col-12 text-lg-center text-left">
                    <h1 class="fw-bold mb-3 text-truncate fs-1 text-wrap">{{ $daerah->nama }}</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 col-12">
                    <div class="ratio ratio-16x9">
                        <img style="object-fit: cover;" class="img-fluid rounded-4 shadow-sm"
                            src="{{ asset('storage/berita/') . '/' . $daerah->gambar }}" alt="">
                    </div>
                    <div class="d-flex gap-2 mt-3 justify-content-between">
                        <p class="text-sm"><i
                                class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($daerah->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($daerah->created_at)->year ? 'd M' : 'd M Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    <div class="">
        <hr>
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('beranda.berita') }}">Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $daerah->nama }}</li>
            </ol>
        </div>
        <hr class="mb-0">
    </div>
    <div class="container">
        <div class="row justify-content-center gap-5">
            <div class="col-lg-7 col-12 border-start border-end bg-white">
                <div class="p-lg-4 px-0 py-3">
                    <div class="text-wrap">{!! $daerah->deskripsi !!}</div>
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <hr class="d-lg-none d-block d-md-none">
                <div class="mt-4">
                    <h4>Berita Lainnya</h4>
                    <div class="mt-3">
                        @foreach ($daerah_all as $row)
                            <article class="d-lg-flex gap-2">
                                <a style="object-fit: cover; width: 40%; height: 40%;" class="links"
                                    href="{{ route('beranda.berita.details', $row->slug) }}">
                                    <div class="mb-3">
                                        <img class="img-fluid rounded-4 shadow-sm"
                                            src="{{ asset('storage/berita/') . '/' . $row->gambar }}" alt="">
                                    </div>
                                </a>

                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span>{{ \Carbon\Carbon::parse($row->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($row->created_at)->year ? 'd M' : 'd M Y') }}
                                        </span>
                                    </div>
                                    <div class="mb-4">
                                        <h5 class="text-truncate">{{ $row->nama }}</h5>
                                        <p class="text-truncate text-sm">{!! $row->deskripsi !!}</p>
                                    </div>
                                </div>
                            </article>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
