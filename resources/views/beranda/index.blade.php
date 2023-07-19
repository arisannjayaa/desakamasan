@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
    <div class="container">
        <div class="row mt-lg-5 mb-lg-5">
            <div class="col-lg-7 col-12 align-self-end order-2 order-lg-1">
                <span class="h5 mb-2">Selamat datang di</span>
                <h1 class="display-4 fw-bold mb-3">Desa Kamasan</h1>
                <p style="line-height: 1.8;">Desa Kamasan terletak di Kabupaten Klungkung, Bali, Indonesia. Desa ini terkenal
                    sebagai pusat seni lukis
                    tradisional Bali yang kaya akan warisan budaya dan sejarah. Kamasan dikenal dengan gaya lukisannya yang
                    unik
                    dan khas, dikenal dengan sebutan "gaya Kamasan" atau "gaya Pita Maha". Gaya lukisan ini berasal dari
                    tradisi
                    lukis Klasik Bali yang dipengaruhi oleh seni wayang kulit dan karya seni Hindu-Buddha.</p>
                <button class="btn btn-primary">Selengkapnya</button>
            </div>
            <div class="col-lg-5 col-12 order-1 order-lg-2 mb-lg-0 mb-5">
                <img height="300" class="img-fluid rounded-4 shadow" src="{{ asset('storage/profil/AMP02708.jpg') }}"
                    alt="">
            </div>
        </div>
        <hr>
        <div class="row mt-lg-5 mb-lg-5">
            <h1>{{ $title }}</h1>
            @foreach ($berita as $b)
                <div class="row my-4">
                    <div class="col-lg-4"><img src="" alt="gambar-x"></div>
                    <div class="col-lg-8">
                        <h4>{{ $b->judul }}</h4>
                        {{-- <p>{!! $b->deskripsi !!}</p> --}}
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-end">
                {{ $berita->links() }}
            </div>
        </div>
    </div>
@endsection
