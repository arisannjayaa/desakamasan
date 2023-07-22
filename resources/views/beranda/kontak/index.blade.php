@extends('layouts.app')
@section('title', $menu)
@push('css')
<style>
    ul.pagination {
        justify-content: center;
    }

    #map {
        height: 500px;
        /* The height is 400 pixels */
    }

    .leaflet-geosearch-bar {
        z-index: 0;
    }
</style>
@endpush
@section('content')
    @if (isset($kontak))
        <div class="row">
            <div class="col">
                <div class="ratio ratio-16x9" style="background: url('{{ asset('assets/static/images/bg/AMP02633.jpg') }}'); background-size: cover; opacity: 0.7;">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="text-white">{{ $menu }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-4 mt-5">
            <div class="row justify-content-center align-items-end">
                <div class="col-lg-8 col-12 col-md-12">
                    <div class="mb-5 rounded" id="map"></div>
                    <h4 class="mb-3"><i class="bi bi-telephone-fill"></i> Telepon</h4>
                    <p>{{ $kontak->telepon }}</p>
                    <h4 class="mb-3"><i class="bi bi-envelope-fill"></i> Email</h4>
                    <p>{{ $kontak->email }}</p>
                    <h4 class="mb-3"><i class="bi bi-geo-alt-fill"></i> Alamat</h4>
                    <p>{{ $kontak->alamat }}</p>
                </div>
            </div>
        </div>
    @else
        @include('beranda.error-404')
    @endif
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var latitude = <?= $kontak->latitude ?>; // Ganti dengan latitude yang diinginkan
            var longitude = <?= $kontak->longitude ?>; // Ganti dengan longitude yang diinginkan

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
