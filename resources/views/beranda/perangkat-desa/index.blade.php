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
    @if (isset($perangkat_all))
        <div class="container py-4">
            <div class="row">
                @foreach ($perangkat_all as $row)
                    <div class="col-lg-4 col-md-6 col-12">
                        <article>
                            <a class="links" href="">
                                <div class="mb-3 ratio ratio-1x1">
                                    <img style="object-fit: cover; width: 100%; height: 100%;"
                                        class="img-fluid rounded-4 shadow-sm"
                                        src="{{ asset('storage/perangkat-desa/') . '/' . $row->foto }}"
                                        alt="{{ $row->nama }}">
                                </div>
                            </a>
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <a href="#" class="nav-link">
                                        <span class="badge border rounded-4 text-secondary">{{ $row->jabatan }}</span>
                                    </a>
                                </div>
                                <div class="mb-4">
                                    <h5 class="text-truncate">{{ $row->nama }}</h5>
                                    <a href=""><button class="btn btn-primary rounded-4">Selengkapnya</button></a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="d-lg-block d-none">
                {{ $perangkat_all->links() }}
            </div>
            <div class="d-lg-none d-block">
                {{ $perangkat_simple->links() }}
            </div>
        </div>
    @else
        @include('beranda.error-404')
    @endif
@endsection
@push('js')
@endpush
