@extends('layouts.app')
@section('title', 'Daerah Wisata')
@push('css')
    <style>
        ul.pagination {
            justify-content: center;
        }
    </style>
@endpush
@section('content')
    {{-- @dd($daerah_last); --}}
    @isset($daerah_last)
        <div class="container">
            <div class="row mt-lg-5 mt-2 mb-lg-5">
                <div class="col-lg-6 col-12 align-self-end order-2 order-lg-1">
                    <h1 class="display-6 fw-bold mb-4">{{ $daerah_last->nama }}</h1>
                    <p class="text-truncate" style="line-height: 1.8;">{{ strip_tags($daerah_last->deskripsi) }}</p>
                    <div>
                        <p class="badge bg-primary"><i
                                class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($daerah_last->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($daerah_last->created_at)->year ? 'd M' : 'd M Y') }}
                        </p>
                        <p class="badge bg-success"><i class="bi bi-tag me-2"></i>{{ $daerah_last->kategori }}
                        </p>
                        <a class="nav-link d-block"
                            href="https://www.google.com/maps?q={{ $daerah_last->latitude . ',' . $daerah_last->longitude }}">
                            <p class="badge bg-light-info"><i class="bi bi-pin-map me-2"></i>{{ $daerah_last->alamat }}</p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-12 order-1 order-lg-2 mb-lg-0 mb-5">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="ratio ratio-4x3">
                                @foreach ($daerah_last->gambar as $index => $daerah_img)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img style="object-fit: cover;" class="img-fluid rounded-4 shadow-sm"
                                            src="{{ asset('storage/daerah/') . '/' . $daerah_img }}" alt="...">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    <div class="mb-5">
        <hr>
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('beranda.daerah') }}">Daerah</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terbaru</li>
            </ol>
        </div>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($daerah_all as $row)
                <div class="col-lg-4 col-md-6 col-12">
                    <article>
                        <a class="links" href="{{ route('beranda.daerah.details', $row->slug) }}">
                            <div class="mb-3 ratio ratio-4x3">
                                <img style="object-fit: cover; width: 100%; height: 100%;"
                                    class="img-fluid rounded-4 shadow-sm"
                                    src="{{ asset('storage/daerah/') . '/' . $row->gambar[0] }}" alt="">
                            </div>
                        </a>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span>{{ \Carbon\Carbon::parse($row->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($row->created_at)->year ? 'd M' : 'd M Y') }}
                                </span>
                            </div>
                            <div class="mb-4">
                                <h3 class="text-truncate">{{ $row->nama }}</h3>
                                <p class="text-truncate text-sm">{{ strip_tags($row->deskripsi) }}</p>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
        <div class="d-lg-block d-none">
            {{ $daerah_all->links() }}
        </div>
        <div class="d-lg-none d-block">
            {{ $daerah_simple->links() }}
        </div>
    </div>

@endsection
