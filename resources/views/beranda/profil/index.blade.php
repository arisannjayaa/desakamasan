@extends('layouts.app')
@section('title', $menu)
@push('css')
    <style>
        ul.pagination {
            justify-content: center;
        }
    </style>
@endpush
@section('content')
    @if (isset($profil))
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
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="mb-3">
                        <h5 class="text-primary">Tentang Kami</h5>
                        <h1>{{ $profil->nama }}</h1>
                    </div>
                    <div class="d-flex justify-content-center mb-4">
                        <img class="w-100 border" src="{{ asset('storage/profil/'. $profil->foto) }}" alt="{{ $profil->nama }}">
                    </div>
                    <p class="mb-5">{!! $profil->deskripsi  !!}</p>
                    <div class="mb-3">
                        <h4 class="text-center">Visi dan Misi</h4>
                        <div class="mb-3">
                            <h5>Visi</h5>
                            <p>{!! $profil->visi !!}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Misi</h5>
                            <p>{!! $profil->misi !!}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @else
        @include('beranda.error-404')
    @endif
@endsection
