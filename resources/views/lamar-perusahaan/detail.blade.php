@extends('landing-page.app')
@section('title', 'JobKelasIndustri - Lamaran Pencari Kerja')
@section('main')
    <main class="bg-light">
        <section>
            <div class="col-md-12 mx-auto mt-4">
                <div class="lamaran-header col-md-10 bg-white mx-auto py-5" style="border-radius: 15px;">
                    <div class="col-md-12 d-flex align-items-start justify-content-start">
                        <div class="row">
                            <div class="col-md-3 div-lamaran">
                                @if ($profileUser->foto)
                                    <img src="{{ asset('storage/' . $profileUser->foto) }}" alt="Foto"
                                        class="rounded-circle ml-4 img-lamaran" style="width: 200px; height: 200px;">
                                @else
                                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                        class="rounded-circle ml-4 img-lamaran" style="width: 200px; height: 200px;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <ul class="list-unstyled">
                                    <ul class="list-unstyled d-flex justify-content-between align-items-end">
                                        <p class="mb-2 text-primary font-weight-bold" style="font-size: 28px;">
                                            {{ $namaPengguna }}
                                        </p>
                                        <a class="btn btn-secondary px-4 text-right"
                                            href="{{ route('lamarperusahaan.index') }}" style="border-radius: 15px;">
                                            Kembali
                                        </a>
                                    </ul>
                                    <h5 class="font-weight-bolder">Ringkasan </h5>
                                    <p class="mb-2 text-justify" style="font-size: 14px;">{!! $profileUser->ringkasan !!}</p>
                                    <h5 class="font-weight-bolder">Personal Info </h5>
                                    <dl class="row">
                                        <dt class="col-sm-4 mt-2">Email</dt>
                                        <dd class="col-sm-8 mt-2">{{ $email }}</dd>

                                        <dt class="col-sm-4 mt-2">No Telepon</dt>
                                        <dd class="col-sm-8 mt-2">{{ $profileUser->no_hp }}</dd>

                                        <dt class="col-sm-4 mt-2">Alamat</dt>
                                        <dd class="col-sm-8 mt-2">{{ $profileUser->alamat }}</dd>

                                        <dt class="col-sm-4 mt-2">Tanggal Lahir</dt>
                                        <dd class="col-sm-8 mt-2">{{ $tglLahir }}</dd>

                                        <dt class="col-sm-4 mt-2">Jenis Kelamin</dt>
                                        <dd class="col-sm-8 mt-2">
                                            @if ($profileUser->jenis_kelamin === 'P')
                                                Perempuan
                                            @elseif ($profileUser->jenis_kelamin === 'L')
                                                Laki-laki
                                            @else
                                                Tidak Diketahui
                                            @endif
                                        </dd>

                                        <dt class="col-sm-4 mt-2">Harapan Gaji</dt>
                                        <dd class="col-sm-8 mt-2">{{ $profileUser->harapan_gaji }}
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
                                                {{ optional($pendidikan->first())->institusi ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Gelar</dt>
                                            <dd class="col-sm-8 mt-2">{{ optional($pendidikan->first())->gelar ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Jurusan</dt>
                                            <dd class="col-sm-8 mt-2">{{ optional($pendidikan->first())->jurusan ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Prestasi</dt>
                                            <dd class="col-sm-8 mt-2">{{ optional($pendidikan->first())->prestasi ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">IPK</dt>
                                            <dd class="col-sm-8 mt-2">{{ optional($pendidikan->first())->ipk ?: '-' }}</dd>

                                            <dt class="col-sm-4 mt-2">Periode</dt>
                                            <dd class="col-sm-8 mt-2">
                                                {{ optional($pendidikan->first())->tahun_mulai ?: '' }}<span> -
                                                </span>
                                                {{ optional($pendidikan->first())->tahun_berakhir ?: '' }}</dd>
                                        </dl>
                                        {{-- Tampilkan tombol "Muat Lebih Banyak" jika ada lebih dari satu pendidikan --}}
                                        @if ($pendidikan->count() > 1)
                                            <button id="muatLebihBanyak" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#pendidikanModal">
                                                Muat Lebih Banyak
                                            </button>
                                        @endif

                                        <!-- Modal untuk menampilkan lebih banyak pendidikan -->
                                        <div class="modal fade" id="pendidikanModal" tabindex="-1" role="dialog"
                                            aria-labelledby="pendidikanModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="pendidikanModalLabel"
                                                            style="color: #6777ef; font-weight: bold;">Pendidikan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- Tampilkan semua pendidikan dalam modal --}}
                                                        @foreach ($pendidikan as $pendidikanItem)
                                                            <dl class="row">
                                                                <dt class="col-sm-4 mt-2">Nama Institusi</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pendidikanItem)->institusi ?: '-' }}</dd>

                                                                <dt class="col-sm-4 mt-2">Gelar</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pendidikanItem)->gelar ?: '-' }}</dd>

                                                                <dt class="col-sm-4 mt-2">Jurusan</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pendidikanItem)->jurusan ?: '-' }}</dd>

                                                                <dt class="col-sm-4 mt-2">Prestasi</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pendidikanItem)->prestasi ?: '-' }}</dd>

                                                                <dt class="col-sm-4 mt-2">IPK</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pendidikanItem)->ipk ?: '-' }}</dd>

                                                                <dt class="col-sm-4 mt-2">Periode</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pendidikanItem)->tahun_mulai ?: '' }}<span>
                                                                        -
                                                                    </span>
                                                                    {{ optional($pendidikanItem)->tahun_berakhir ?: '' }}
                                                                </dd>
                                                            </dl>
                                                            <hr class="my-4">
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 text-center my-4"><br><br>
                                            <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                                            <p class="mt-1 text-not">Tidak Ada Pendidikan yang Di Unggah</p>
                                        </div>
                                    @endif


                                    <hr class="my-4">
                                    <h5 class="font-weight-bolder">Keahlian</h5>
                                    @if ($keahlian)
                                        <dl class="row">
                                            <dt class="col-sm-3 mt-1">
                                                @if ($keahlian && $keahlian->count() > 0)
                                                    <ul>
                                                        @foreach ($keahlian as $keahlian)
                                                            <li>{{ $keahlian->keahlian }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    -
                                                @endif
                                            </dt>
                                        </dl>
                                    @else
                                        <div class="col-md-12 text-center my-4"><br><br>
                                            <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                                            <p class="mt-1 text-not">Tidak Ada Keahlian yang Di Unggah</p>
                                        </div>
                                    @endif

                                    <hr class="my-4">
                                    <h5 class="font-weight-bolder">Pengalaman Kerja </h5>
                                    @if ($pengalaman && $pengalaman->count() > 0)
                                        <dl class="row">
                                            <dt class="col-sm-4 mt-2">Nama Pekerjaan</dt>
                                            <dd class="col-sm-8 mt-2">
                                                {{ optional($pengalaman->first())->nama_pekerjaan ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Nama Perusahaan</dt>
                                            <dd class="col-sm-8 mt-2">
                                                {{ optional($pengalaman->first())->nama_perusahaan ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Alamat</dt>
                                            <dd class="col-sm-8 mt-2">{{ optional($pengalaman->first())->alamat ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Tipe Pekerjaan</dt>
                                            <dd class="col-sm-8 mt-2">{{ optional($pengalaman->first())->tipe ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Gaji</dt>
                                            <dd class="col-sm-8 mt-2">
                                                {{ 'Rp ' . number_format(optional($pengalaman->first())->gaji, 0, ',', '.') ?: '-' }}
                                            </dd>
                                            <dt class="col-sm-4 mt-2">Periode</dt>
                                            <dd class="col-sm-8 mt-2">
                                                {{ $tanggal_mulai ?: '' }} - {{ $tanggal_berakhir ?: '' }}
                                            </dd>
                                        </dl>
                                        {{-- Tampilkan tombol "Muat Lebih Banyak" jika ada lebih dari satu pengalaman --}}
                                        @if ($pengalaman->count() > 1)
                                            <button id="muatLebihBanyak" class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#pengalamanModal">
                                                Muat Lebih Banyak
                                            </button>
                                        @endif

                                        <!-- Modal untuk menampilkan lebih banyak pengalaman -->
                                        <div class="modal fade" id="pengalamanModal" tabindex="-1" role="dialog"
                                            aria-labelledby="pengalamanModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="pengalamanModalLabel"
                                                            style="color: #6777ef; font-weight: bold;">Pengalaman</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- Tampilkan semua pengalaman dalam modal --}}
                                                        @foreach ($pengalaman as $pengalamanItem)
                                                            <dl class="row">
                                                                <dt class="col-sm-4 mt-2">Nama Pekerjaan</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pengalamanItem)->nama_pekerjaan ?: '-' }}
                                                                </dd>

                                                                <dt class="col-sm-4 mt-2">Nama Perusahaan</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pengalamanItem)->nama_perusahaan ?: '-' }}
                                                                </dd>

                                                                <dt class="col-sm-4 mt-2">Alamat</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pengalamanItem)->alamat ?: '-' }}</dd>

                                                                <dt class="col-sm-4 mt-2">Tipe Pekerjaan</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pengalamanItem)->tipe ?: '-' }}</dd>

                                                                <dt class="col-sm-4 mt-2">Gaji</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ 'Rp ' . number_format(optional($pengalamanItem)->gaji, 0, ',', '.') ?: '-' }}
                                                                </dd>
                                                                <dt class="col-sm-4 mt-2">Periode</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ $tanggal_mulai ?: '' }} -
                                                                    {{ $tanggal_berakhir ?: '' }}
                                                                </dd>
                                                            </dl>
                                                            <hr class="my-4">
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                            <dd class="col-sm-8 mt-2">{{ optional($pelatihan->first())->penerbit ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Tanggal Dikeluarkan</dt>
                                            <dd class="col-sm-8 mt-2">
                                                {{ optional($pelatihan->first())->tanggal_dikeluarkan ?: '-' }}
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
                                        <!-- Modal untuk menampilkan lebih banyak pelatihan -->
                                        <div class="modal fade" id="pelatihanModal" tabindex="-1" role="dialog"
                                            aria-labelledby="pelatihanModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="pelatihanModalLabel"
                                                            style="color: #6777ef; font-weight: bold;">Pelatihan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
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
                                                                    {{ optional($pelatihanItem)->deskripsi ?: '-' }}</dd>

                                                                <dt class="col-sm-4 mt-2">Dikeluarkan oleh</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pelatihanItem)->penerbit ?: '-' }}</dd>

                                                                <dt class="col-sm-4 mt-2">Tanggal Dikeluarkan</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pelatihanItem)->tanggal_dikeluarkan ?: '-' }}
                                                                </dd>

                                                                <dt class="col-sm-4 mt-2">Sertifikat</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    @if ($pelatihanItem && $pelatihanItem->sertifikat)
                                                                        <a href="{{ asset('storage/' . $pelatihanItem->sertifikat) }}"
                                                                            onclick="return openResume();" target="_blank"
                                                                            class="btn btn-primary btn-sm">
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
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>

                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-12 text-center my-4"><br><br>
                                                <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                                                <p class="mt-1 text-not">Tidak Ada Pelatihan/Sertifikat Yang Di Unggah</p>
                                            </div>
                                    @endif
                                </ul>
                                <br>
                                <br>
                                <form action="{{ route('lamarperusahaan.update', ['lamarperusahaan' => $lamar->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Diterima">
                                    <button type="submit" class="btn btn-success btn-block px-5 py-2 mb-3"
                                        style="border-radius: 15px;">Terima</button>
                                </form>
                                <form action="{{ route('lamarperusahaan.update', ['lamarperusahaan' => $lamar->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Ditolak">
                                    <button type="submit" class="btn btn-secondary btn-block px-5 py-2"
                                        style="border-radius: 15px;">Tolak</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        const textarea = document.getElementById('autoSizeTextarea');

        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        textarea.style.height = (textarea.scrollHeight) + 'px';
    </script>
@endsection
