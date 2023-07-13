@extends('layouts.app')
@section('title', 'Profil Desa')
@section('content')
<div class="container mt-4 mb-4">
    <h1>Profil Desa</h1>
    <hr class="border border-secondary border-1">

    <div class="mt-3 row">
        <label for="" class="col-sm-4">Name</label>
        <label for="" class="col-sm-8">{{ $profil[0]->nama }}</label>
    </div>

    <div class="mt-3 row">
        <label for="" class="col-sm-4">Deskripsi</label>
        <label for="" class="col-sm-8">{!! $profil[0]->deskripsi !!}</label>
    </div>

    <div class="mt-3 row">
        <label for="" class="col-sm-4">Alamat</label>
        <label for="" class="col-sm-8">{!! $profil[0]->alamat !!}</label>
    </div>

    <div class="mt-3 row">
        <label for="" class="col-sm-4">Lokasi</label>
        <div for="" class="col-sm-8" id="mapContainer" style="width: 720px; height: 420px;"></div>
    </div>
</div>

<script>
    const map = L.map('mapContainer').setView([-8.549215, 115.407944], 16);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    const marker = L.marker([-8.549215, 115.407944]).addTo(map)
    .bindPopup('<b>Desa Kamasan</b><br />-8.549215, 115.407944.').openPopup();
</script>
@endsection