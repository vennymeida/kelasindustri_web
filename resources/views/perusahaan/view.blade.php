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
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <a href="{{ route('perusahaan.index') }}">
                                    <img class="img-fluid mt-1" style="width: 50px; height: 35px;"
                                        src="{{ asset('assets/img/Vector.svg') }}">
                                </a>
                            </div>
                            <div class="profile-widget-name mt-2 ml-3 text-primary" style="font-size: 20px;">
                                <a href=""
                                    style="text-decoration: none; color: inherit;"><strong>Pertinjau Detail Pencari
                                        Kerja</strong></a>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="text-center">
                                    @if ($perusahaan->perusahaan && $perusahaan->perusahaan->logo)
                                        <img src="{{ asset('storage/' . $perusahaan->perusahaan->logo) }}" alt="Logo"
                                            class="img-thumbnail rounded-circle" style="width: 200px; height: 200px;">
                                    @else
                                        <div class="text-muted" style="font-size: 24px;">No Logo Available</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7">
                                <dl class="row">
                                    <dt class="col-sm-4">Nama User</dt>
                                    <dd class="col-sm-8">{{ $perusahaan->name }}</dd>

                                    <dt class="col-sm-4 mt-3">Email User</dt>
                                    <dd class="col-sm-8 mt-3">{{ $perusahaan->email }}</dd>

                                    <dt class="col-sm-4 mt-3">Pemilik</dt>
                                    <dd class="col-sm-8 mt-3">{{ optional($perusahaan->perusahaan)->pemilik ?: '-' }}</dd>

                                    <dt class="col-sm-4 mt-3">Nama Perusahaan</dt>
                                    <dd class="col-sm-8 mt-3">{{ optional($perusahaan->perusahaan)->nama ?: '-' }}</dd>

                                    <dt class="col-sm-4 mt-3">Alamat Perusahaan</dt>
                                    <dd class="col-sm-8 mt-3">
                                        {{ optional($perusahaan->perusahaan)->alamat_perusahaan ?: '-' }}</dd>

                                    <dt class="col-sm-4 mt-3">Email Perusahaan</dt>
                                    <dd class="col-sm-8 mt-3">{{ optional($perusahaan->perusahaan)->email ?: '-' }}</dd>

                                    <dt class="col-sm-4 mt-3">Website</dt>
                                    <dd class="col-sm-8 mt-3">{{ optional($perusahaan->perusahaan)->website ?: '-' }}</dd>

                                    <dt class="col-sm-4 mt-3">No. Telp</dt>
                                    <dd class="col-sm-8 mt-3">
                                        {{ optional($perusahaan->perusahaan)->no_hp_perusahaan ?: '-' }}</dd>

                                    <dt class="col-sm-4 mt-3">Deskripsi</dt>
                                    <dd class="col-sm-8 mt-3">{{ optional($perusahaan->perusahaan)->deskripsi ?: '-' }}
                                    </dd>

                                    <dt class="col-sm-4 mt-3">SIU</dt>
                                    <dd class="col-sm-8 mt-3">
                                        @if (optional($perusahaan->perusahaan)->siu)
                                            <a href="{{ asset('storage/' . $perusahaan->perusahaan->siu) }}"
                                                target="_blank" class="btn btn-primary btn-sm">View SIU</a>
                                        @else
                                            <div class="text-muted">No SIU Available</div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="text-center mt-4">
                            <a href="{{ route('perusahaan.index') }}" class="btn btn-info">Kembal</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
