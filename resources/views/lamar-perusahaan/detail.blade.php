<div class="modal fade" id="modal-rekrut-karyawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Tambah Jadwal Interview / Tes Lanjutan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('lamar.store', $lamar->id) }}" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-4 mr-4" style="display: none"> 
                        <div class="form-group col-md-12 col-12">
                            <label for="email">email</label>
                            <input name="email" type="hidden" class="form-control custom-input @error('email') is-invalid @enderror" value="{{ $lamar->lulusan->user->email }}" placeholder="Email tujuan">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="subject">Subject</label>
                            <input name="subject" type="text" class="form-control custom-input @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Pengumuman Tahapan Interview">
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Tempat Interview</label>
                            <input name="tempat_interview" type="text" class="form-control custom-input @error('tempat_interview') is-invalid @enderror" value="{{ old('tempat_interview') }}" placeholder="Masukkan Tempat Interview">
                            @error('tempat_interview')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-6 col-12">
                            <label>Tanggal Interview</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input name="tanggal_interview" type="date" class="form-control custom-input @error('tanggal_interview') is-invalid @enderror" value="{{ old('tanggal_interview') }}">
                                @error('tanggal_interview')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-12">
                            <label>Catatan (Opsional)</label>
                            <textarea name="catatan" class="form-control custom-input @error('catatan') is-invalid @enderror" rows="4" placeholder="Masukkan catatan">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="d-none"></button>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke m-4">
                <button type="button" class="btn btn-primary" onclick="$('form', this.closest('.modal')).submit();" style="border-radius: 15px; font-size: 14px">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 15px; font-size: 14px">Batal</button>
            </div>
        </div>
    </div>
</div>

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
                                @if ($lamar && $lamar->foto)
                                    <img src="{{ asset('storage/' . $lamar->foto) }}" alt="Foto"
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
                                            {{ $lamar->lulusan->user->name }}
                                        </p>
                                        <a href="#" class="btn btn-primary px-4 text-right"
                                            style="background-color:#6777EF; border-radius:15px; border-color:#6777EF; float: left; margin-left: 200px;"
                                            data-toggle="modal" data-target="#modal-rekrut-karyawan">
                                            Jadwalkan Interview/Tes Lanjutan
                                        </a>
                                        <a class="btn btn-secondary px-4 text-right"
                                            href="{{ route('lamarperusahaan.index') }}" style="border-radius: 15px;">
                                            Kembali
                                        </a>
                                    </ul>
                                    <h5 class="font-weight-bolder">Ringkasan </h5>
                                    <p class="mb-2 text-justify" style="font-size: 14px;">{!! $lamar->lulusan->ringkasan !!}</p>
                                    <h5 class="font-weight-bolder">Personal Info </h5>
                                    <dl class="row">
                                        <dt class="col-sm-4 mt-2">Email</dt>
                                        <dd class="col-sm-8 mt-2">{{ $lamar->lulusan->user->email }}</dd>

                                        <dt class="col-sm-4 mt-2">No Telepon</dt>
                                        <dd class="col-sm-8 mt-2">{{ $lamar->lulusan->no_hp }}</dd>

                                        <dt class="col-sm-4 mt-2">Alamat</dt>
                                        <dd class="col-sm-8 mt-2">{{ $lamar->lulusan->alamat }}</dd>

                                        <dt class="col-sm-4 mt-2">Tanggal Lahir</dt>
                                        <dd class="col-sm-8 mt-2">{{ $lamar->lulusan->tgl_lahir }}</dd>

                                        <dt class="col-sm-4 mt-2">Jenis Kelamin</dt>
                                        <dd class="col-sm-8 mt-2">
                                            @if ($lamar->lulusan->jenis_kelamin === 'P')
                                                Perempuan
                                            @elseif ($lamar->lulusan->jenis_kelamin === 'L')
                                                Laki-laki
                                            @else
                                                Tidak Diketahui
                                            @endif
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
                                                {{ optional($pendidikan->first())->nama_institusi ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Gelar</dt>
                                            <dd class="col-sm-8 mt-2">
                                                {{ optional($pendidikan->first())->tingkatan ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Jurusan</dt>
                                            <dd class="col-sm-8 mt-2">{{ optional($pendidikan->first())->jurusan ?: '-' }}
                                            </dd>
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
                                                                    {{ optional($pendidikanItem)->nama_institusi ?: '-' }}
                                                                </dd>

                                                                <dt class="col-sm-4 mt-2">Gelar</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pendidikanItem)->tingkatan ?: '-' }}</dd>

                                                                <dt class="col-sm-4 mt-2">Jurusan</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pendidikanItem)->jurusan ?: '-' }}</dd>
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
                                    {{-- @if ($keahlian)
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
                                    @endif --}}

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
                                            <dd class="col-sm-8 mt-2">{{ optional($pengalaman->first())->alamat ?: '-' }}
                                            </dd>

                                            <dt class="col-sm-4 mt-2">Tipe Pekerjaan</dt>
                                            <dd class="col-sm-8 mt-2">{{ optional($pengalaman->first())->tipe ?: '-' }}
                                            </dd>
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
                                                                    {{ optional($pengalamanItem)->nama_pengalaman ?: '-' }}
                                                                </dd>

                                                                <dt class="col-sm-4 mt-2">Nama Perusahaan</dt>
                                                                <dd class="col-sm-8 mt-2">
                                                                    {{ optional($pengalamanItem)->nama_instansi ?: '-' }}
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
                                                                    {{ $tgl_mulai ?: '' }} -
                                                                    {{ $tgl_selesai ?: '' }}
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
    @push('customScript')
        <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function() {
                // Fungsi untuk menangani pengiriman formulir saat tombol Tambah diklik
                $('.btn-primary').on('click', function() {
                    // Validasi formulir sebelum pengiriman
                    var form = $(this).closest('form');
                    if (form[0].checkValidity()) {
                        form.submit(); // Kirim formulir jika valid
                    } else {
                        form.addClass('was-validated'); // Tampilkan pesan kesalahan jika formulir tidak valid
                    }
                });

                // Fungsi untuk menutup modal saat tombol Batal diklik
                $('.btn-secondary').on('click', function() {
                    $('#modal-rekrut-karyawan').modal('hide');
                });
            });
        </script>
    @endpush
@endsection
