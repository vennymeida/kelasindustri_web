@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Pelamar Kerja')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Daftar Pencari Kerja</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Detail Pencari Kerja</h2>
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <a href="{{ route('pelamar.index') }}">
                                    <img class="img-fluid mt-1" style="width: 50px; height: 35px;"
                                        src="{{ asset('assets/img/Vector.svg') }}">
                                </a>
                            </div>
                            <div class="profile-widget-name mt-2 ml-3 text-primary" style="font-size: 20px;">
                                <a href="{{ route('pelamar.index') }}"
                                    style="text-decoration: none; color: inherit;"><strong>Pertinjau Detail Pencari
                                        Kerja</strong></a>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <!-- Foto -->
                            <div class="col-md-2">
                                <div class="text-center mb-4">
                                    @if ($pelamar->profile && $pelamar->profile->foto)
                                        <img src="{{ asset('storage/' . $pelamar->profile->foto) }}" alt="Foto"
                                            class="img-thumbnail rounded-circle" style="width: 200px; height: 200px;">
                                    @else
                                        <span>No Photo Available</span>
                                    @endif
                                </div>
                            </div>
                            <!-- Nama and Ringkasan -->
                            <div class="col-md-9 ml-4">
                                <h4><strong>{{ $pelamar->name }}</strong></h4>
                                <h6 class="mt-4"><strong>Ringkasan</strong></h6>
                                <p>{{ optional($pelamar->profile)->ringkasan ?: '-' }}</p>

                                <h6 class="mt-5"><strong>Personal Info</strong></h6>
                                <dl class="row">
                                    <dt class="col-sm-3 mt-3">Email</dt>
                                    <dd class="col-sm-7 mt-3">{{ $pelamar->email }}</dd>

                                    <dt class="col-sm-3 mt-3">No. Telepon</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->profile)->no_hp ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Alamat</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->profile)->alamat ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Tanggal Lahir</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ optional($pelamar->profile)->tgl_lahir? \Carbon\Carbon::parse($pelamar->profile->tgl_lahir)->locale('id')->isoFormat('D MMMM Y'): '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Jenis Kelamin</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ $pelamar->profile ? ($pelamar->profile->jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan') : '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Harapan Gaji</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->profile)->harapan_gaji ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Resume</dt>
                                    <dd class="col-sm-7 mt-3">
                                        @if ($pelamar->profile && $pelamar->profile->resume)
                                            <a href="{{ asset('storage/' . $pelamar->profile->resume) }}" target="_blank"
                                                class="btn btn-primary btn-sm">Lihat Resume</a>
                                        @else
                                            <span class="text-muted">Tidak ada Resume</span>
                                        @endif
                                    </dd>
                                </dl>
                                <h6 class="mt-5"><strong>Pendidikan</strong></h6>
                                <dl class="row">
                                    <dt class="col-sm-3 mt-3">Nama Institusi</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pendidikan)->institusi ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Gelar</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pendidikan)->gelar ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Jurusan</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pendidikan)->jurusan ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Prestasi</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pendidikan)->prestasi ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">IPK</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pendidikan)->ipk ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Periode</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ optional($pelamar->pendidikan)->tahun_mulai && optional($pelamar->pendidikan)->tahun_berakhir ? optional($pelamar->pendidikan)->tahun_mulai . ' - ' . optional($pelamar->pendidikan)->tahun_berakhir : '-' }}
                                    </dd>
                                </dl>
                                <h6 class="mt-5"><strong>Keahlian</strong></h6>
                                <dl class="row">
                                    <dt class="col-sm-3 mt-3">
                                        @if ($pelamar->profileKeahlians && $pelamar->profileKeahlians->count() > 0)
                                            <ul>
                                                @foreach ($pelamar->profileKeahlians as $profileKeahlian)
                                                    <li>{{ $profileKeahlian->keahlian->keahlian }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            -
                                        @endif
                                    </dt>
                                </dl>

                                <h6 class="mt-5"><strong>Pengalaman Kerja</strong></h6>
                                <dl class="row">
                                    <dt class="col-sm-3 mt-3">Nama Pekerjaan</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pengalaman)->nama_pekerjaan ?: '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Nama Perusahaan</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pengalaman)->nama_perusahaan ?: '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Alamat</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pengalaman)->alamat ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Tipe Pekerjaan</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pengalaman)->tipe ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Gaji</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ optional($pelamar->pengalaman)->gaji ? 'IDR ' . number_format($pelamar->pengalaman->gaji, 0, ',', '.') : '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Periode</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ optional($pelamar->pengalaman)->tanggal_mulai ? date('d-m-Y', strtotime($pelamar->pengalaman->tanggal_mulai)) : '-' }}
                                        s/d
                                        {{ optional($pelamar->pengalaman)->tanggal_berakhir ? date('d-m-Y', strtotime($pelamar->pengalaman->tanggal_berakhir)) : '-' }}
                                    </dd>
                                </dl>
                                <h6 class="mt-5"><strong>Pelatihan / Sertifikat</strong></h6>
                                <dl class="row">
                                    <dt class="col-sm-3 mt-3">Nama Pelatihan</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pelatihan)->nama_sertifikat ?: '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Deskripsi</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pelatihan)->deskripsi ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Dikeluarkan Oleh</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($pelamar->pelatihan)->penerbit ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Tanggal Dikeluarkan</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ optional($pelamar->pelatihan)->tanggal_dikeluarkan? \Carbon\Carbon::parse($pelamar->pelatihan->tanggal_dikeluarkan)->locale('id')->isoFormat('D MMMM Y'): '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Sertifikat</dt>
                                    <dd class="col-sm-7 mt-3">
                                        @if ($pelamar->pelatihan && $pelamar->pelatihan->sertifikat)
                                            <a href="{{ asset('storage/' . $pelamar->pelatihan->sertifikat) }}"
                                                target="_blank" class="btn btn-primary btn-sm">Lihat Sertifikat</a>
                                        @else
                                            <span class="text-muted">Tidak ada Sertifikat</span>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="text-center mt-4">
                        <a href="{{ route('pelamar.index') }}" class="btn btn-info">Kembali</a>
                    </div> --}}
                    </div>
                </div>
                {{-- </div>
        </div> --}}
    </section>
@endsection
