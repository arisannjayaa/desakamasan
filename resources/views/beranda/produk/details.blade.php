@extends('layouts.app')
@section('title', $produk->nama)
@push('css')
    <style>
        ul.pagination {
            justify-content: center;
        }
    </style>
@endpush
@section('content')
    @isset($produk)
        <div class="container">
            <div class="row mt-lg-5 mt-2 mb-lg-5">
                <div class="col-lg-6 col-12 align-self-end order-2 order-lg-1">
                    <h1 class="display-6 fw-bold mb-4">{{ $produk->nama }}</h1>
                    <div>
                        <p>
                            <i class="bi bi-calendar3 me-2"></i>
                            {{ \Carbon\Carbon::parse($produk->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($produk->created_at)->year ? 'd M' : 'd M Y') }}
                        </p>
                        <span class="nav-link">
                            <i class="bi bi-tag me-2"></i>
                            <span class="badge border rounded-4 text-secondary">{{ $produk->kategori->nama }}</span>
                        </span>
                    </div>
                </div>
                <div class="col-lg-6 col-12 order-1 order-lg-2 mb-lg-0 mb-5">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($produk->foto as $index => $produk_img)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="ratio ratio-16x9">
                                        <img style="object-fit: cover;" class="img-fluid rounded-4 shadow-sm"
                                            src="{{ asset('storage/produk/') . '/' . $produk_img->file }}" alt="...">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    <div class="bg-white">
        <hr class="mt-0">
        <div class="container-lg">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('daerah.index') }}">Daerah</a></li>
                <li class="breadcrumb-item active text-truncate w-75">{{ $produk->nama }}</li>
            </ol>
        </div>
        <hr class="mb-0">
    </div>
    <div class="container-lg container-fluid">
        <div class="row gap-lg-4 justify-content-center">
            <div class="col-lg-8 col-12 bg-white">
                <div class="p-lg-4 px-0 py-3">
                    <div class="text-wrap">{!! $produk->deskripsi !!}</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="p-lg-4 col-lg-8 col-12 bg-white">
                <div class="mt-4">
                    <h5>Porduk Terkait Lainnya</h5>
                    <div class="mt-3">
                        <div class="row">
                            @foreach ($produk_all as $row)
                                <div class="col-lg-4">
                                    <a style="object-fit: contain; width: 40%; height: 40%;" class="links"
                                        href="{{ route('produk.show', $row->slug) }}">
                                        <div class="mb-2">
                                            <div class="ratio ratio-16x9">
                                                <img style="object-fit: cover" class="img-fluid rounded-4 shadow-sm"
                                                    src="{{ asset('storage/produk/') . '/' . $row->foto[0]->file }}"
                                                    alt="{{ $row->nama }}">
                                            </div>
                                        </div>
                                    </a>
                                    <p style="cursor: pointer;" onclick="window.location.href='{{ route('produk.show', $row->slug) }}';">
                                        {{ Str::limit($row->nama, 70, '...') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
