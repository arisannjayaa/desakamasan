@extends('layouts.app')
@section('title', $menu)
@push('css')
<style>
    td, th {
        padding: 7px;
    }
</style>
@endpush
@section('content')
    {{-- @dd($perangkat) --}}
    @if (isset($perangkat))
        <div class="row">
            <div class="col">
                <div class="ratio ratio-16x9"
                    style="background: url('{{ asset('assets/static/images/bg/AMP02633.jpg') }}'); background-size: cover; opacity: 0.7;">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <h4 class="text-white">Perangkat Desa</h4>
                        <h1 class="text-white">{{ $perangkat->nama }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="ratio ratio-1x1">
                        <img class="rounded-3" style="object-fit: cover" src="{{ asset('storage/perangkat-desa/') . '/' . $perangkat->foto }}"
                            alt="">
                    </div>
                    <div class="d-grid mt-3">
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
                <div class="col-lg-6 col-12 pt-4 pt-lg-0">
                    <div class="d-flex align-items-lg-center align-items-start flex-lg-row flex-column flex-md-row  gap-2 mb-3">
                        <h1 class="h1">{{ $perangkat->nama }}</h1>
                        <span class="rounded-5 border p-2 text-sm bg-primary text-white">{{ $perangkat->jabatan }}</span>
                    </div>
                    <div class="mb-5">
                        <h5>Identitas Pribadi</h5>
                        <table>
                            <tr>
                                <td>Tempat dan Tanggal Lahir</td>
                                <td>:</td>
                                <td>{{ $perangkat->tempat_lahir . ', ' .  \Carbon\Carbon::parse($perangkat->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $perangkat->jenis_kelamin}}</td>
                            </tr>
                            <tr>
                                <td>Status Kawin</td>
                                <td>:</td>
                                <td>{{ $perangkat->status_kawin}}</td>
                            </tr>
                            <tr>
                                <td>Pendidikan Terakhir</td>
                                <td>:</td>
                                <td>{{ $perangkat->pendidikan_terakhir}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $perangkat->alamat}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mb-5">
                        <h5>Riwayat Pendidikan</h5>
                        <table>
                            @foreach ($perangkat->riwayat_pendidikan as $index => $row)
                                <tr>
                                    <td>{{ $loop->iteration . '. ' . $row->jenjang }}</td>
                                    <td>:</td>
                                    <td>{{ $row->institusi . ' ' . $row->tahun_lulus }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="mb-5">
                        <h5>Riwayat Pekerjaan</h5>
                        <table>
                            @foreach ($perangkat->riwayat_kerja as $index => $row)
                                <tr>
                                    <td>{{ $loop->iteration . '. ' . $row->perusahaan_organisasi }}</td>
                                    <td>:</td>
                                    <td>{{ 'Tahun ' . $row->tahun_mulai . ' - ' . $row->tahun_selesai }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('beranda.error-404')
    @endif
@endsection
