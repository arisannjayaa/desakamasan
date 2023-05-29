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
    @isset($berita)
        <div class="row flex-column mt-lg-5 mt-2">
            <div class="col-lg-12 col-12 text-center">
                <h1 class="display-6 fw-bold mb-3">{{ $berita->judul }}</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-5 col-12">
                <div class="ratio ratio-4x3">
                    <img style="object-fit: cover;" class="img-fluid rounded-4 shadow-sm"
                        src="{{ asset('storage/berita/') . '/' . $berita->gambar }}" alt="">
                </div>
                <div class="d-flex gap-2 mt-3 justify-content-between">
                    <p class="text-sm"><i
                            class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($berita->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($berita->created_at)->year ? 'd M' : 'd M Y') }}
                    </p>
                    <p class="text-sm"><i class="bi bi-pencil-square me-2"></i>Ditulis oleh Administrator</p>
                </div>
            </div>
        </div>
    @endisset
    <div class="">
        <hr>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda.berita') }}">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $berita->judul }}</li>
        </ol>
        <hr class="mb-0">
    </div>
    <div class="container-sm mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-12 border-lg-start border-lg-end">
                <div class="p-lg-4 p-0">
                    <p class="text-wrap">{{ strip_tags($berita->deskripsi) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
