@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
{{--    @dd($desa)--}}
    <div class="container">
        <div class="row mt-lg-5 mb-lg-5">
            <div class="col-lg-7 col-12 align-self-end order-2 order-lg-1">
                <span class="h5 mb-2">Selamat datang di</span>
                <h1 class="display-4 fw-bold mb-3">{{ $desa[0]->nama  }}</h1>
                <div>{!! $desa[0]->deskripsi !!}</div>
                <button class="btn btn-primary">Selengkapnya</button>
            </div>
            <div class="col-lg-5 col-12 order-1 order-lg-2 mb-lg-0 mb-5">
                <img height="300" class="img-fluid rounded-4 shadow" src="{{ asset('storage/profil/').'/'.$desa[0]->foto }}"
                    alt="">
            </div>
        </div>
        <hr>
        <div class="row mt-lg-5 mb-lg-5">
            <h2 class="mb-3">Berita</h2>
            @foreach($berita as $data)
                <div class="col-lg-4 col-md-6 col-12">
                    <article>
                        <a class="links" href="{{ route('berita.show', $data->slug) }}">
                            <div class="mb-3 ratio ratio-16x9">
                                <img style="object-fit: cover; width: 100%; height: 100%;"
                                     class="img-fluid rounded-4 shadow-sm"
                                     src="{{ asset('storage/berita/') . '/' . $data->foto }}" alt="">
                            </div>
                        </a>
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                        <span>{{ \Carbon\Carbon::parse($data->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($data->created_at)->year ? 'd M' : 'd M Y') }}
                                        </span>
                                <span class="nav-link">
                                            <span
                                                class="badge border rounded-4 text-secondary">{{ $data->kategori->nama }}</span>
                                        </span>
                            </div>
                            <div class="mb-4">
                                <h5 style="cursor: pointer;" onclick="window.location.href='{{ route('berita.show', $data->slug) }}';" class="text-truncate">{{ $data->judul }}</h5>
                                <p class="text-sm">{{ strip_tags(Str::limit($data->deskripsi, 85)) }}</p>
                                <a href="{{ route('berita.show', $data->slug) }}"><button
                                        class="btn btn-primary rounded-4">Selengkapnya</button></a>
                            </div>
                        </div>
                    </article>
                 </div>
            @endforeach
            <hr>
        </div>

        <div class="row mt-lg-5 mb-lg-5">
            <h2 class="mb-3">Daerah</h2>
            @foreach ($daerah as $data)
                <div class="col-lg-4 col-md-6 col-12">
                    <article>
                        <a class="links" href="{{ route('daerah.show', $data->slug) }}">
                            <div class="mb-3 ratio ratio-16x9">
                                <img style="object-fit: cover; width: 100%; height: 100%;"
                                     class="img-fluid rounded-4 shadow-sm"
                                     src="{{ asset('storage/daerah/') . '/' . $data->foto[0]->file }}" alt="">
                            </div>
                        </a>
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                    <span>{{ \Carbon\Carbon::parse($data->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($data->created_at)->year ? 'd M' : 'd M Y') }}
                                    </span>
                                <a href="#" class="nav-link">
                                        <span
                                            class="badge border rounded-4 text-secondary">{{ $data->kategori->nama }}</span>
                                </a>
                            </div>
                            <div class="mb-4">
                                <h5 class="text-truncate">{{ $data->judul }}</h5>
                                <p class="text-sm">{{ strip_tags(Str::limit($data->deskripsi, 85)) }}</p>
                                <a href="{{ route('daerah.show', $data->slug) }}"><button
                                        class="btn btn-primary rounded-4">Selengkapnya</button></a>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

        <div class="row mb-lg-5 mt-lg-5">
            <h2 class="mb-3">Produk</h2>
            @foreach ($produk as $data)
                <div class="col-lg-4 col-md-6 col-12">
                    <article>
                        <a class="links" href="{{ route('produk.show', $data->slug) }}">
                            <div class="mb-3 ratio ratio-16x9">
                                <img style="object-fit: cover; width: 100%; height: 100%;"
                                     class="img-fluid rounded-4 shadow-sm"
                                     src="{{ asset('storage/produk/') . '/' . $data->foto[0]->file }}" alt="">
                            </div>
                        </a>
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                    <span>{{ \Carbon\Carbon::parse($data->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($data->created_at)->year ? 'd M' : 'd M Y') }}
                                    </span>
                                <span class="nav-link">
                                        <span
                                            class="badge border rounded-4 text-secondary">{{ $data->kategori->nama }}</span>
                                    </span>
                            </div>
                            <div class="mb-4">
                                <h5 style="cursor: pointer;" onclick="window.location.href='{{ route('produk.show', $data->slug) }}';" class="text-truncate">{{ $data->judul }}</h5>
                                <p class="text-sm">{{ strip_tags(Str::limit($data->deskripsi, 85)) }}</p>
                                <a href="{{ route('produk.show', $data->slug) }}"><button
                                        class="btn btn-primary rounded-4">Selengkapnya</button></a>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
@endsection
