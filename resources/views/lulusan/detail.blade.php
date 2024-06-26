@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Lulusan')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Daftar Lulusan</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Detail Lulusan</h2>
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <a href="{{ route('lulusan.index') }}">
                                    <img class="img-fluid mt-1" style="width: 50px; height: 35px;"
                                        src="{{ asset('assets/img/Vector.svg') }}">
                                </a>
                            </div>
                            <div class="lulusan-widget-name mt-2 ml-3 text-primary" style="font-size: 20px;">
                                <a href="{{ route('lulusan.index') }}"
                                    style="text-decoration: none; color: inherit;"><strong>Pratinjau Detail Lulusan</strong></a>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <!-- Foto -->
                            <div class="col-md-2">
                                <div class="text-center mb-4">
                                    @if ($lulusan->foto)
                                        <img src="{{ asset('storage/' . $lulusan->lulusan->foto) }}" alt="Foto"
                                            class="img-thumbnail rounded-circle" style="width: 200px; height: 200px;">
                                    @else
                                        <span>No Photo Available</span>
                                    @endif
                                </div>
                            </div>
                            <!-- Nama and Ringkasan -->
                            <div class="col-md-9 ml-4">
                                <h4><strong>{{ $lulusan->name }}</strong></h4>
                                <h6 class="mt-4"><strong>Ringkasan</strong></h6>
                                <p>{!! optional($lulusan->lulusan)->ringkasan ?: '-' !!}</p>

                                <h6 class="mt-5"><strong>Personal Info</strong></h6>
                                <dl class="row">
                                    <dt class="col-sm-3 mt-3">Email</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan)->email ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">No. Telepon</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional(optional($lulusan)->lulusan)->no_hp ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Alamat</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional(optional($lulusan)->lulusan)->alamat ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Tanggal Lahir</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ optional(optional($lulusan)->lulusan)->tgl_lahir ? \Carbon\Carbon::parse($lulusan->lulusan->tgl_lahir)->locale('id')->isoFormat('D MMMM Y') : '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Jenis Kelamin</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ !empty(optional(optional($lulusan)->lulusan)->jenis_kelamin) ? ($lulusan->lulusan->jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan') : '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Resume</dt>
                                    <dd class="col-sm-7 mt-3">
                                        @if (optional(optional($lulusan)->lulusan)->resume)
                                            <a href="{{ Storage::url($lulusan->lulusan->resume) }}" target="_blank" class="btn btn-primary btn-sm">Lihat Resume</a>
                                        @else
                                            <span class="text-muted">Tidak ada Resume</span>
                                        @endif
                                    </dd>
                                </dl>

                                <h6 class="mt-5"><strong>Pendidikan</strong></h6>
                                <dl class="row">
                                    <dt class="col-sm-3 mt-3">Nama Institusi</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan->pendidikan)->nama_institusi ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Tingkatan</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan->pendidikan)->tingkatan ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Jurusan</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan->pendidikan)->jurusan ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Periode</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ optional($lulusan->pendidikan)->tahun_mulai && optional($lulusan->pendidikan)->tahun_selesai ? optional($lulusan->pendidikan)->tahun_mulai . ' - ' . optional($lulusan->pendidikan)->tahun_selesai : '-' }}
                                    </dd>
                                </dl>
                                <h6 class="mt-5"><strong>Keahlian</strong></h6>
                                <dl class="row">
                                    <dt class="col-sm-3 mt-3">
                                        @if ($lulusan->keahlians->count() > 0)
                                            <ul>
                                                @foreach ($lulusan->keahlians as $keahlian)
                                                    <li>{{ $keahlian->keahlian }}</li>
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
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan->pengalaman)->nama_pengalaman ?: '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Nama Perusahaan</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan->pengalaman)->nama_instansi ?: '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Alamat</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan->pengalaman)->alamat ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Tipe Pekerjaan</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan->pengalaman)->tipe ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Gaji</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ optional($lulusan->pengalaman)->gaji ? 'IDR ' . number_format($lulusan->pengalaman->gaji, 0, ',', '.') : '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Periode</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ optional($lulusan->pengalaman)->tanggal_mulai ? date('d-m-Y', strtotime($lulusan->pengalaman->tanggal_mulai)) : '-' }}
                                        s/d
                                        {{ optional($lulusan->pengalaman)->tanggal_berakhir ? date('d-m-Y', strtotime($lulusan->pengalaman->tanggal_berakhir)) : '-' }}
                                    </dd>
                                </dl>
                                <h6 class="mt-5"><strong>Pelatihan / Sertifikat</strong></h6>
                                <dl class="row">
                                    <dt class="col-sm-3 mt-3">Nama Pelatihan</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan->pelatihan)->nama_sertifikat ?: '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Deskripsi</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan->pelatihan)->deskripsi ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Dikeluarkan Oleh</dt>
                                    <dd class="col-sm-7 mt-3">{{ optional($lulusan->pelatihan)->penerbit ?: '-' }}</dd>

                                    <dt class="col-sm-3 mt-3">Tanggal Dikeluarkan</dt>
                                    <dd class="col-sm-7 mt-3">
                                        {{ optional($lulusan->pelatihan)->tanggal_dikeluarkan? \Carbon\Carbon::parse($lulusan->pelatihan->tanggal_dikeluarkan)->locale('id')->isoFormat('D MMMM Y'): '-' }}
                                    </dd>

                                    <dt class="col-sm-3 mt-3">Sertifikat</dt>
                                    <dd class="col-sm-7 mt-3">
                                        @if ($lulusan->pelatihan && $lulusan->pelatihan->sertifikat)
                                            <a href="{{ asset('storage/' . $lulusan->pelatihan->sertifikat) }}"
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
                        <a href="{{ route('lulusan.index') }}" class="btn btn-info">Kembali</a>
                    </div> --}}
                    </div>
                </div>
                {{-- </div>
        </div> --}}
    </section>
@endsection
