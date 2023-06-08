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
        <div class="bg-white">
            <div class="container">
                <div class="row flex-column  align-items-center text-center  pt-lg-5 pt-2">
                    <div class="col-lg-8 col-12">
                        <h1 class="fw-bold mb-3 text-truncate fs-1 text-wrap">{{ $produk->nama }}</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($produk->foto as $index => $produk_img)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img style="object-fit: cover;" class="img-fluid rounded-4 shadow-sm"
                                            src="{{ asset('storage/produk/') . '/' . $produk_img->file }}" alt="...">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-lg-flex d-block my-3 gap-3">
                            <p class="text-sm"><i
                                    class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($produk->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($produk->created_at)->year ? 'd M' : 'd M Y') }}
                            </p>
                            <a href="#" class="nav-link">
                                <i class="bi bi-tag me-1"></i>
                                <span class="badge border rounded-4 text-secondary">{{ $produk->kategori->nama }}</span>
                            </a>
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
        <div class="row gap-4 bg-white">
            <div class="col-lg-7 col-12">
                <div class="p-lg-4 px-0 py-3">
                    <div class="text-wrap">{!! $produk->deskripsi !!}</div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="mt-4">
                    <h5>Produk Lainnya</h5>
                    <div class="mt-3">
                        @foreach ($produk_all as $row)
                            <article class="d-flex gap-2 mb-3">
                                <div class="col-lg-5 col-5">
                                    <a style="object-fit: contain; width: 40%; height: 40%;" class="links"
                                        href="{{ route('produk.show', $row->slug) }}">
                                        <div class="mb-2">
                                            <img class="img-fluid rounded-4 shadow-sm"
                                                src="{{ asset('storage/produk/') . '/' . $row->foto[0]->file }}"
                                                alt="">
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
                                        <h5 class="text-truncate fs-6">{{ $row->nama }}</h5>
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
