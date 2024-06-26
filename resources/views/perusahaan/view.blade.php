@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Perusahaan')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>View Perusahaan</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Detail Perusahaan</h2>
            <div class="d-flex justify-content-center">
                <div class="card" style="border-radius: 15px; width: 100%;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <a href="{{ route('perusahaan.index') }}">
                                    <img class="img-fluid mt-1" style="widivh: 50px; height: 35px;"
                                        src="{{ asset('assets/img/Vector.svg') }}">
                                </a>
                            </div>
                            <div class="profile-widget-name mt-2 ml-3 text-primary" style="font-size: 20px;">
                                <a href=""
                                    style="text-decoration: none; color: inherit;"><strong>Pratinjau Detail
                                        Perusahaan</strong></a>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="text-center">
                                    @if ($perusahaan->perusahaan && $perusahaan->perusahaan->logo_perusahaan)
                                        <img src="{{ asset('storage/' . $perusahaan->perusahaan->logo_perusahaan) }}" alt="Logo"
                                            class="img-thumbnail rounded-circle" style="widivh: 200px; height: 200px;">
                                    @else
                                        <div class="text-muted" style="font-size: 24px;">No Logo Available</div>
                                    @endif
                                </div>
                                <br>
                                <div class="text-center">
                                    <p style="font-size: 16px;">Didaftarkan pada : <br> 2 Mei 2024</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-sm-8 mt-3" style="font-size: 16px;"><strong>{{ optional($perusahaan)->nama_perusahaan ?: '-' }}</strong></div>
                                    <div class="col-sm-8 mt-3">
                                        {{ optional($perusahaan)->alamat_perusahaan ?: '-' }}</div>
                                    <div class="col-sm-8 mt-3">{{ optional($perusahaan)->email_perusahaan ?: '-' }}</div>
                                    <div class="col-sm-8 mt-3">{{ optional($perusahaan)->website ?: '-' }}</div>
                                    <div class="col-sm-8 mt-3">
                                        {{ optional($perusahaan)->no_telp ?: '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class = "row">
                                    <div class="col-sm-8 mt-3" style="font-size: 16px;"><strong>Informasi Perusahaan</strong></div>
                                    <div class="col-sm-8 mt-3">{{ optional($perusahaan)->deskripsi ?: '-' }}
                                    </div>
                                    <div class="col-sm-8 mt-3">
                                        @if (optional($perusahaan)->surat_mou)
                                            <a href="{{ asset('storage/' . $perusahaan->surat_mou) }}"
                                                target="_blank" class="btn btn-primary btn-sm">View MoU</a>
                                        @else
                                            <div class="text-muted">No MoU Available</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-statistic-1" style="border-radius: 15px; background-color: #F5F7FF;">
                                    <div class="card-icon bg-primary" style="border-radius: 50%;">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-body" style="font-size: 22px; margin-top: 20px;">
                                            {{ $jumlahLowongan }}
                                        </div>
                                        <div class="card-header" style="font-size: 18px; margin-bottom: 30px;">
                                            <h4><strong> Total Lowongan Kerja</strong></h4>
                                        </div>
                                        <div class="text-right my-4 mr-5">
                                            <a href="{{ route('showLoker', $perusahaan->id ) }}" class="" style="font-size: 12px;">
                                                Lihat Detail . . .
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-statistic-1" style="border-radius: 15px; background-color: #F5F7FF;">
                                    <div class="card-icon bg-success" style="border-radius: 50%;">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-body" style=" font-size: 22px; margin-top: 20px;">
                                            {{ $jumlahPelamar }}
                                        </div>
                                        <div class="card-header" style="font-size: 18px; margin-bottom: 30px;">
                                            <h4><strong>Total Pelamar</strong></h4>
                                        </div>
                                        <div class="text-right my-4 mr-5">
                                            <a href="{{ route('showPelamar', $perusahaan->id ) }}" class="" style="font-size: 12px;">
                                                Lihat Detail . . .
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card card-statistic-1" style="border-radius: 15px; background-color: #F5F7FF;">
                                    <div class="card-icon bg-warning" style="border-radius: 50%;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-body" style=" font-size: 22px; margin-top: 20px;  margin-bottom: 10px;">
                                            {{ $jumlahDiterima }}
                                        </div>
                                        <div class="card-header">
                                            <h4><strong>Total Lulusan Yang Diterima</strong></h4>
                                        </div>
                                        <div class="text-right my-4 mr-5">
                                            <a href="{{ route('showPelamarDiterima', $perusahaan->id ) }}" class="" style="font-size: 12px;">
                                                Lihat Detail . . .
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
