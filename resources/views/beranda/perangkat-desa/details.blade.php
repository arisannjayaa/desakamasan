@extends('layouts.app')
@section('title', $daerah->nama)
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
            <div class="row mt-lg-5 mt-2 mb-lg-5">
                <div class="col-lg-7 col-12 align-self-end order-2 order-lg-1">
                    <h1 class="display-6 fw-bold mb-4">{{ $daerah->nama }}</h1>
                    <div>
                        <p>
                            <i class="bi bi-calendar3 me-2"></i>
                            {{ \Carbon\Carbon::parse($daerah->created_at)->format(\Carbon\Carbon::now()->year == \Carbon\Carbon::parse($daerah->created_at)->year ? 'd M' : 'd M Y') }}
                        </p>
                        <a href="#" class="nav-link">
                            <i class="bi bi-tag me-2"></i>
                            <span class="badge border rounded-4 text-secondary">{{ $daerah->kategori->nama }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 col-12 order-1 order-lg-2 mb-lg-0 mb-5">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($daerah->foto as $index => $daerah_img)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img style="object-fit: cover;" class="img-fluid rounded-4 shadow-sm"
                                        src="{{ asset('storage/daerah/') . '/' . $daerah_img->file }}" alt="...">
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
                <li class="breadcrumb-item active text-truncate w-75">{{ $daerah->nama }}</li>
            </ol>
        </div>
        <hr class="mb-0">
    </div>
    <div class="container-lg container-fluid">
        <div class="row gap-lg-4 justify-content-center">
            <div class="col-lg-8 col-12 bg-white">
                <div class="p-lg-4 px-0 py-3">
                    <div class="text-wrap">{!! $daerah->deskripsi !!}</div>
                    <h6>Lokasi</h6>
                    <div class="mb-2 rounded" id="map"></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="p-lg-4 col-lg-8 col-12 bg-white">
                <div class="mt-4">
                    <h5>Daerah Terkait Lainnya</h5>
                    <div class="mt-3">
                        <div class="row">
                            @foreach ($daerah_all as $row)
                                <div class="col-lg-4">
                                    <a style="object-fit: contain; width: 40%; height: 40%;" class="links"
                                        href="{{ route('daerah.show', $row->slug) }}">
                                        <div class="mb-2">
                                            <div class="ratio ratio-16x9">
                                                <img class="img-fluid rounded-4 shadow-sm"
                                                    src="{{ asset('storage/daerah/') . '/' . $row->foto[0]->file }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </a>
                                    <p>{{ Str::limit($row->nama, 70, '...') }}</p>
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
    <script>
        $(document).ready(function() {
            var latitude = <?= $daerah->latitude ?>; // Ganti dengan latitude yang diinginkan
            var longitude = <?= $daerah->longitude ?>; // Ganti dengan longitude yang diinginkan

            var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([latitude, longitude]).addTo(map);

            marker.bindPopup("Lokasi Anda<br><a href='https://www.google.com/maps/search/?api=1&query=" + latitude +
                "," + longitude + "' target='_blank'>Buka di Google Maps</a>").openPopup();

            function openUrl(url) {
                var win = window.open(url, '_blank');
                win.focus();
            }

            marker.on('click', function() {
                openUrl('https://www.google.com/maps/search/?api=1&query=' + latitude + ',' + longitude);
            });
        });
    </script>
@endpush
