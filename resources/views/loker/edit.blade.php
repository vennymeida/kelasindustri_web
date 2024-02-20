@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Lowongan Pekerjaan')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Edit Lowongan Pekerjaan</h1>
        </div>
        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
            </div>
        </div>
        <div class="section-body">
            <div class="card" style="border-radius: 15px;">
                <div class="card-header">
                    <h4>Edit Data Lowongan Pekerjaan</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('loker.update', $loker->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $loker->perusahaan->nama }}" disabled style="border-radius: 15px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Pemilik</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $loker->perusahaan->pemilik }}" disabled style="border-radius: 15px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_kategori">Kategori</label>
                                    <select name="id_kategori[]" class="form-control select2" multiple disabled>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ in_array($kategori->id, $loker->kategori->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $kategori->kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_keahlian">Keahlian</label>
                                    <select name="id_keahlian[]" class="form-control select2" multiple disabled>
                                        <option value="">Pilih Keahlian</option>
                                        @foreach ($keahlians as $keahlian)
                                            <option value="{{ $keahlian->id }}"
                                                {{ in_array($keahlian->id, $loker->keahlian->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $keahlian->keahlian }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="hidden" name="judul" value="{{ $loker->judul }}">
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="{{ $loker->judul }}" disabled style="border-radius: 15px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_pekerjaan">Tipe Pekerjaan</label>
                                    <input type="hidden" name="tipe_pekerjaan" value="{{ $loker->tipe_pekerjaan }}">
                                    <select class="form-control select2" id="tipe_pekerjaan" name="tipe_pekerjaan" disabled>
                                        <option value="Onsite" {{ $loker->tipe_pekerjaan === 'Onsite' ? 'selected' : '' }}>
                                            Onsite</option>
                                        <option value="Remote" {{ $loker->tipe_pekerjaan === 'Remote' ? 'selected' : '' }}>
                                            Remote</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <input type="hidden" name="deskripsi" value="{{ $loker->deskripsi }}">
                                    <textarea name="deskripsi" id="deskripsi" class="form-control" type="text"
                                        style="height: 150px; border-radius: 15px;" disabled>{{ $loker->deskripsi }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="requirement">Persyaratan</label>
                                    <input type="hidden" name="requirement" value="{{ $loker->requirement }}">
                                    <div class="col-md-12 px-4 py-1" style="background-color:#e9ecef; border-radius: 15px;">
                                        <p id="requirement-2" type="text">
                                            {!! $loker->requirement !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="min_pendidikan">Minimal Pendidikan</label>
                                    <input type="hidden" name="min_pendidikan" value="{{ $loker->min_pendidikan }}">
                                    <select class="form-control select2" id="min_pendidikan" name="min_pendidikan" disabled>
                                        <option value="" disabled selected>Pilih minimal pendidikan</option>
                                        <option value="SMA" {{ $loker->min_pendidikan === 'SMA' ? 'selected' : '' }}>
                                            SMA
                                        </option>
                                        <option value="SMK" {{ $loker->min_pendidikan === 'SMK' ? 'selected' : '' }}>
                                            SMK
                                        </option>
                                        <option value="SMA/SMK"
                                            {{ $loker->min_pendidikan === 'SMA/SMK' ? 'selected' : '' }}>
                                            SMA/SMK
                                        </option>
                                        <option value="S1" {{ $loker->min_pendidikan === 'S1' ? 'selected' : '' }}>
                                            S1
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="min_pengalaman">Minimal Pengalaman</label>
                                    <input type="hidden" name="min_pengalaman" value="{{ $loker->min_pengalaman }}">
                                    <select class="form-control select2" id="min_pengalaman" name="min_pengalaman"
                                        disabled>
                                        <option value="" disabled selected>Pilih minimal pengalaman</option>
                                        <option value="Tidak ada"
                                            {{ $loker->min_pengalaman === 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada
                                        </option>
                                        <option value="Kurang dari setahun"
                                            {{ $loker->min_pengalaman === 'Kurang dari setahun' ? 'selected' : '' }}>
                                            Kurang dari setahun
                                        </option>
                                        <option value="Lebih dari setahun"
                                            {{ $loker->min_pengalaman === 'Lebih dari setahun' ? 'selected' : '' }}>
                                            Lebih dari setahun
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gaji">Gaji</label>
                                    <input type="hidden" name="gaji_bawah" value="{{ $loker->gaji_bawah }}">
                                    <input type="hidden" name="gaji_atas" value="{{ $loker->gaji_atas }}">
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <input type="text" class="form-control mr-2" id="gaji_bawah"
                                                name="gaji_bawah" value="{{ $loker->gaji_bawah }}" disabled
                                                style="border-radius: 15px;">
                                            <span class="mr-2">-</span>
                                            <input type="text" class="form-control" id="gaji_atas" name="gaji_atas"
                                                value="{{ $loker->gaji_atas }}" disabled style="border-radius: 15px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lokasi">Lokasi Kerja</label>
                                    <input type="hidden" name="lokasi" value="{{ $loker->lokasi }}">
                                    <input type="text" class="form-control" id="lokasi" name="lokasi"
                                        value="{{ $loker->lokasi }}" disabled style="border-radius: 15px;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jumlah_pelamar">Kuota Pelamar</label>
                                    <input type="hidden" name="jumlah_pelamar" value="{{ $loker->jumlah_pelamar }}">
                                    <input type="number" class="form-control" id="jumlah_pelamar" name="jumlah_pelamar"
                                        value="{{ $loker->jumlah_pelamar }}" disabled style="border-radius: 15px;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tutup">Lowongan di tutup</label>
                                    <input type="hidden" name="tutup" value="{{ $loker->tutup }}">
                                    <input type="text" class="form-control" id="tutup" name="tutup"
                                        value="{{ \Carbon\Carbon::parse($loker->tutup)->format('d F Y') }}" disabled
                                        style="border-radius: 15px;">
                                </div>
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status Pekerjaan</label>
                                    <select class="form-control select2" id="status" name="status">
                                        <option value="Pending" {{ $loker->status === 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="Dibuka" {{ $loker->status === 'Dibuka' ? 'selected' : '' }}>
                                            Dibuka</option>
                                        <option value="Ditutup" {{ $loker->status === 'Ditutup' ? 'selected' : '' }}>
                                            Ditutup</option>
                                    </select>
                                </div>
                            </div>
                            @role('super-admin')
                                <select name="id_kategori[]" class="form-control" multiple style="display: none;">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ in_array($kategori->id, $loker->kategori->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $kategori->kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="id_keahlian[]" class="form-control" multiple style="display: none;">
                                    <option value="">Pilih Keahlian</option>
                                    @foreach ($keahlians as $keahlian)
                                        <option value="{{ $keahlian->id }}"
                                            {{ in_array($keahlian->id, $loker->keahlian->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $keahlian->keahlian }}
                                        </option>
                                    @endforeach
                                </select>
                            @endrole
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" href="{{ route('loker.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection

@push('customStyle')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('customScript')
    <script src="{{ asset('assets/js/summernote-bs4.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#requirement').summernote({
                placeholder: 'Masukkan Persyaratan Pekerjaan',
                height: 200,
            });
        });
    </script>

    <script>
        function formatRupiah(angka) {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            var formatted = formatter.format(angka);
            // return formatter.format(angka);
            formatted = formatted.replace("Rp", "");
            return formatted;
        }

        document.getElementById('gaji_bawah').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });

        document.getElementById('gaji_atas').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });
    </script>
@endpush
