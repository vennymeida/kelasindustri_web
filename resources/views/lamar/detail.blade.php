@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Pelamar Kerja')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>View Perusahaan</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Detail Pelamar Kerja</h2>
            <div class="section-body">
                <div class="row justify-content-center">
                    <div class="col-12"> <!-- Use col-12 to take up the full width -->
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body">
                                <p class="card-title font-weight-bolder" style="font-size: 25px;">
                                    <a href="{{ route('pelamarkerja.index') }}">
                                        <img class="img-fluid mt-1" style="width: 30px; height: 30px;"
                                            src="{{ asset('assets/img/Vector.svg') }}">
                                    </a>
                                </p>
                                <div class="row">
                                    <div class="col-md-4 d-flex align-items-start justify-content-center">
                                        @if ($lulusan->foto)
                                            <img src="{{ asset('storage/' . $lulusan->foto) }}" alt="Foto"
                                                class="rounded-circle mr-1 mb-5" style="width: 200px; height: 200px;">
                                        @else
                                            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                                class="rounded-circle mr-1 mb-5" style="width: 200px; height: 200px;">
                                        @endif
                                    </div>

                                    <div class="col-md-7">
                                        <ul class="list-unstyled">
                                            <p class="mb-2 text-primary font-weight-bold" style="font-size: 28px;">
                                                {{ $namaPengguna }}
                                            </p>
                                            <br>
                                            <h5 class="font-weight-bolder">Lowongan Pekerjaan yang Di lamar </h5>
                                            <dl class="row">
                                                <dt class="col-sm-4 mt-2">Nama Perusahaan</dt>
                                                <dt class="col-sm-8 mt-2 font-weight-normal">{{ $namaPerusahaan }}</dt>
                                                <dt class="col-sm-4 mt-2">Posisi Pekerjaan</dt>
                                                <dt class="col-sm-8 mt-2 font-weight-normal">{{ $judulPekerjaan }}</dt>
                                            </dl>
                                            <br>
                                            <h5 class="font-weight-bolder">Ringkasan </h5>
                                            <p class="mb-2 text-justify" style="font-size: 14px;">
                                                {{ $lulusan->ringkasan }}</p>
                                            <dl class="row">
                                                <dt class="col-sm-4 mt-2">Email</dt>
                                                <dd class="col-sm-8 mt-2">{{ $email }}</dd>

                                                <dt class="col-sm-4 mt-2">No Telepon</dt>
                                                <dd class="col-sm-8 mt-2">{{ $lulusan->no_hp }}</dd>

                                                <dt class="col-sm-4 mt-2">Alamat</dt>
                                                <dd class="col-sm-8 mt-2">{{ $lulusan->alamat }}</dd>

                                                <dt class="col-sm-4 mt-2">Tanggal Lahir</dt>
                                                <dd class="col-sm-8 mt-2">{{ $tglLahir }}</dd>

                                                <dt class="col-sm-4 mt-2">Jenis Kelamin</dt>
                                                <dd class="col-sm-8 mt-2">
                                                    @if ($lulusan->jenis_kelamin === 'P')
                                                        Perempuan
                                                    @elseif ($lulusan->jenis_kelamin === 'L')
                                                        Laki-laki
                                                    @else
                                                        Tidak Diketahui
                                                    @endif
                                                </dd>

                                                <dt class="col-sm-4 mt-2">Harapan Gaji</dt>
                                                <dd class="col-sm-8 mt-2">{{ $lulusan->harapan_gaji }}
                                                </dd>

                                                <dt class="col-sm-4 mt-2">Resume</dt>
                                                <dd class="col-sm-8 mt-2">
                                                    @if ($lamar && $lamar->resume)
                                                        <a href="{{ asset('storage/' . $lamar->resume) }}"
                                                            onclick="return openResume();" target="_blank"
                                                            class="btn btn-primary btn-sm">
                                                            Lihat Resume
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Tidak ada resume</span>
                                                    @endif
                                                </dd>
                                            </dl>

                                            <hr class="my-4">
                                            <h5 class="font-weight-bolder">Pendidikan </h5>
                                            @if ($pendidikan && $pendidikan->count() > 0)
                                                {{-- Tampilkan satu pendidikan terbaru --}}
                                                <dl class="row">
                                                    <dt class="col-sm-4 mt-2">Nama Institusi</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pendidikan->first())->nama_institusi ?: '-' }}</dd>

                                                    <dt class="col-sm-4 mt-2">Tingkatan</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pendidikan->first())->tingkatan ?: '-' }}</dd>

                                                    <dt class="col-sm-4 mt-2">Jurusan</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pendidikan->first())->jurusan ?: '-' }}</dd>

                                                    <dt class="col-sm-4 mt-2">Periode</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pendidikan->first())->tahun_mulai ?: '' }}<span> -
                                                        </span>
                                                        {{ optional($pendidikan->first())->tahun_selesai ?: '' }}</dd>
                                                </dl>
                                                {{-- Tampilkan tombol "Muat Lebih Banyak" jika ada lebih dari satu pendidikan --}}
                                                @if ($pendidikan->count() > 1)
                                                    <button id="muatLebihBanyak" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#pendidikanModal">
                                                        Muat Lebih Banyak
                                                    </button>
                                                @endif
                                            @else
                                                <div class="col-md-12 text-center my-4"><br><br>
                                                    <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                                                    <p class="mt-1 text-not">Tidak Ada Pendidikan yang Di Unggah</p>
                                                </div>
                                            @endif

                                            {{-- <hr class="my-4">
                                            <h5 class="font-weight-bolder">Keahlian</h5>
                                            <dl class="row">
                                                <dt class="col-sm-3 mt-3">
                                                    @if ($keahlian && $keahlian->count() > 0)
                                                        <ul>
                                                            @foreach ($keahlian as $keahlian)
                                                                <li>{{ $keahlian->keahlian->keahlian }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        -
                                                    @endif
                                                </dt>
                                            </dl> --}}

                                            <hr class="my-4">
                                            <h5 class="font-weight-bolder">Pengalaman Kerja </h5>
                                            @if ($pengalaman && $pengalaman->count() > 0)
                                                <dl class="row">
                                                    <dt class="col-sm-4 mt-2">Nama Pekerjaan</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pengalaman->first())->nama_pengalaman ?: '-' }}
                                                    </dd>

                                                    <dt class="col-sm-4 mt-2">Nama Perusahaan</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pengalaman->first())->nama_instansi ?: '-' }}
                                                    </dd>

                                                    <dt class="col-sm-4 mt-2">Alamat</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pengalaman->first())->alamat ?: '-' }}</dd>

                                                    <dt class="col-sm-4 mt-2">Tipe Pekerjaan</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pengalaman->first())->tipe ?: '-' }}</dd>

                                                    <dt class="col-sm-4 mt-2">Periode</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ $tgl_mulai ?: '' }} - {{ $tgl_selesai ?: '' }}
                                                    </dd>
                                                </dl>
                                                {{-- Tampilkan tombol "Muat Lebih Banyak" jika ada lebih dari satu pengalaman --}}
                                                @if ($pengalaman->count() > 1)
                                                    <button id="muatLebihBanyak" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#pengalamanModal">
                                                        Muat Lebih Banyak
                                                    </button>
                                                @endif
                                            @else
                                                <div class="col-md-12 text-center my-4"><br><br>
                                                    <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                                                    <p class="mt-1 text-not">Tidak Ada Pengalaman Kerja yang Di Unggah</p>
                                                </div>
                                            @endif

                                            <hr class="my-4">
                                            <h5 class="font-weight-bolder">Pelatihan / Sertifikasi </h5>
                                            @if ($pelatihan && $pelatihan->count() > 0)
                                                <dl class="row">
                                                    <dt class="col-sm-4 mt-2">Nama Pelatihan</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pelatihan->first())->nama_sertifikat ?: '-' }}</dd>

                                                    <dt class="col-sm-4 mt-2">Deskripsi</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pelatihan->first())->deskripsi ?: '-' }}
                                                    </dd>

                                                    <dt class="col-sm-4 mt-2">Dikeluarkan oleh</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pelatihan->first())->penerbit ?: '-' }}
                                                    </dd>

                                                    <dt class="col-sm-4 mt-2">Tanggal Dikeluarkan</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        {{ optional($pelatihan->first())->tgl_dikeluarkan ?: '-' }}
                                                    </dd>

                                                    <dt class="col-sm-4 mt-2">Sertifikat</dt>
                                                    <dd class="col-sm-8 mt-2">
                                                        @if ($pelatihan && $pelatihan->first()->sertifikat)
                                                            <a href="{{ asset('storage/' . $pelatihan->first()->sertifikat) }}"
                                                                onclick="return openResume();" target="_blank"
                                                                class="btn btn-primary btn-sm">
                                                                Lihat Sertifikat
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Tidak ada sertifikat</span>
                                                        @endif
                                                    </dd>
                                                </dl>
                                                {{-- Tampilkan tombol "Muat Lebih Banyak" jika ada lebih dari satu pelatihan --}}
                                                @if ($pelatihan->count() > 1)
                                                    <button id="muatLebihBanyak" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#pelatihanModal">
                                                        Muat Lebih Banyak
                                                    </button>
                                                @endif
                                            @else
                                                <div class="col-md-12 text-center my-4"><br><br>
                                                    <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                                                    <p class="mt-1 text-not">Tidak Ada Pelatihan/Sertifikat Yang Di Unggah
                                                    </p>
                                                </div>
                                            @endif
                                        </ul>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Modal untuk menampilkan lebih banyak pendidikan -->
    <div class="modal fade" id="pendidikanModal" tabindex="-1" role="dialog" aria-labelledby="pendidikanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pendidikanModalLabel" style="color: #6777ef; font-weight: bold;">
                        Pendidikan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Tampilkan semua pendidikan dalam modal --}}
                    @foreach ($pendidikan as $pendidikanItem)
                        <dl class="row">
                            <dt class="col-sm-4 mt-2">Nama Institusi</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pendidikanItem)->nama_institusi ?: '-' }}
                            </dd>

                            <dt class="col-sm-4 mt-2">Tingkatan</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pendidikanItem)->tingkatan?: '-' }}
                            </dd>

                            <dt class="col-sm-4 mt-2">Jurusan</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pendidikanItem)->jurusan ?: '-' }}
                            </dd>

                            <dt class="col-sm-4 mt-2">Periode</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pendidikanItem)->tahun_mulai ?: '' }}<span>
                                    -
                                </span>
                                {{ optional($pendidikanItem)->tahun_selesai ?: '' }}
                            </dd>
                        </dl>
                        <hr class="my-4">
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan lebih banyak pengalaman -->
    <div class="modal fade" id="pengalamanModal" tabindex="-1" role="dialog" aria-labelledby="pengalamanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pengalamanModalLabel" style="color: #6777ef; font-weight: bold;">
                        Pengalaman
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Tampilkan semua pengalaman dalam modal --}}
                    @foreach ($pengalaman as $pengalamanItem)
                        <dl class="row">
                            <dt class="col-sm-4 mt-2">Nama Pekerjaan</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pengalamanItem)->nama_pengalaman?: '-' }}
                            </dd>

                            <dt class="col-sm-4 mt-2">Nama Perusahaan</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pengalamanItem)->nama_instansi ?: '-' }}
                            </dd>

                            <dt class="col-sm-4 mt-2">Alamat</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pengalamanItem)->alamat ?: '-' }}
                            </dd>

                            <dt class="col-sm-4 mt-2">Tipe Pekerjaan</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pengalamanItem)->tipe ?: '-' }}
                            </dd>
                            <dt class="col-sm-4 mt-2">Periode</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ $tgl_mulai ?: '' }} -
                                {{ $tgl_selesai ?: '' }}
                            </dd>
                        </dl>
                        <hr class="my-4">
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan lebih banyak pelatihan -->
    <div class="modal fade" id="pelatihanModal" tabindex="-1" role="dialog" aria-labelledby="pelatihanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pelatihanModalLabel" style="color: #6777ef; font-weight: bold;">Pelatihan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Tampilkan semua pelatihan dalam modal --}}
                    @foreach ($pelatihan as $pelatihanItem)
                        <dl class="row">
                            <dt class="col-sm-4 mt-2">Nama Pelatihan</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pelatihanItem)->nama_sertifikat ?: '-' }}
                            </dd>

                            <dt class="col-sm-4 mt-2">Deskripsi</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pelatihanItem)->deskripsi ?: '-' }}
                            </dd>

                            <dt class="col-sm-4 mt-2">Dikeluarkan oleh</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pelatihanItem)->penerbit ?: '-' }}
                            </dd>

                            <dt class="col-sm-4 mt-2">Tanggal Dikeluarkan</dt>
                            <dd class="col-sm-8 mt-2">
                                {{ optional($pelatihanItem)->tgl_dikeluarkan ?: '-' }}
                            </dd>

                            <dt class="col-sm-4 mt-2">Sertifikat</dt>
                            <dd class="col-sm-8 mt-2">
                                @if ($pelatihanItem && $pelatihanItem->sertifikat)
                                    <a href="{{ asset('storage/' . $pelatihanItem->sertifikat) }}"
                                        onclick="return openResume();" target="_blank" class="btn btn-primary btn-sm">
                                        Lihat Sertifikat
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada
                                        sertifikat</span>
                                @endif
                            </dd>
                        </dl>
                        <hr class="my-4">
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
