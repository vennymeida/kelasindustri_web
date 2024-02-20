@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Lowongan Pekerjaan</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <form action="{{ route('loker.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="user_id" value="{{ $profileUser->id }}">
                                <input type="hidden" name="id_perusahaan" value="{{ $perusahaan->id }}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_kategori">Kategori</label>
                                        <select name="id_kategori[]"
                                            class="form-control select2 @error('id_kategori') is-invalid @enderror"
                                            multiple>
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @foreach ($kategoris as $kategori)
                                                <option
                                                    value="{{ $kategori->id }}"{{ in_array($kategori->id, old('id_kategori', [])) ? 'selected' : '' }}>
                                                    {{ $kategori->kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kategori')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_keahlian">Keahlian</label>
                                        <select name="id_keahlian[]"
                                            class="form-control select2 @error('id_keahlian') is-invalid @enderror"
                                            multiple>
                                            <option value="" disabled selected>Pilih Keahlian</option>
                                            @foreach ($keahlians as $keahlian)
                                                <option
                                                    value="{{ $keahlian->id }}"{{ in_array($keahlian->id, old('id_keahlian', [])) ? 'selected' : '' }}>
                                                    {{ $keahlian->keahlian }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_keahlian')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                            id="judul" name="judul" placeholder="Masukkan judul lowongan pekerjaan"
                                            value="{{ old('judul') }}">
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipe_pekerjaan">Tipe Pekerjaan</label>
                                        <select class="form-control select2 @error('tipe_pekerjaan') is-invalid @enderror"
                                            id="tipe_pekerjaan" name="tipe_pekerjaan">
                                            <option value="" disabled selected>Pilih tipe pekerjaan</option>
                                            <option value="Remote"
                                                {{ old('tipe_pekerjaan') === 'Remote' ? 'selected' : '' }}>
                                                Remote
                                            </option>
                                            <option value="Onsite"
                                                {{ old('tipe_pekerjaan') === 'Onsite' ? 'selected' : '' }}>
                                                Onsite
                                            </option>
                                        </select>
                                        @error('tipe_pekerjaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi"
                                            class="form-control summernote-simple @error('deskripsi') is-invalid @enderror" type="text"
                                            style="height: 290px;" placeholder="Masukkan deskripsi pekerjaan">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback mt-4">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="requirement">Persyaratan</label>
                                        <textarea name="requirement" id="requirement"
                                            class="form-control summernote-simple @error('requirement') is-invalid @enderror" type="text">{{ old('requirement') }}</textarea>
                                        @error('requirement')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="min_pendidikan">Minimal Pendidikan</label>
                                        <select class="form-control select2 @error('min_pendidikan') is-invalid @enderror"
                                            id="min_pendidikan" name="min_pendidikan">
                                            <option value="" disabled selected>Pilih minimal pendidikan</option>
                                            <option value="SMA" {{ old('min_pendidikan') === 'SMA' ? 'selected' : '' }}>
                                                SMA
                                            </option>
                                            <option value="SMK" {{ old('min_pendidikan') === 'SMK' ? 'selected' : '' }}>
                                                SMK
                                            </option>
                                            <option value="SMA/SMK"
                                                {{ old('min_pendidikan') === 'SMA/SMK' ? 'selected' : '' }}>
                                                SMA/SMK
                                            </option>
                                            <option value="S1" {{ old('min_pendidikan') === 'S1' ? 'selected' : '' }}>
                                                S1
                                            </option>
                                        </select>
                                        @error('min_pendidikan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="min_pengalaman">Minimal Pengalaman</label>
                                        <select class="form-control select2 @error('min_pengalaman') is-invalid @enderror"
                                            id="min_pengalaman" name="min_pengalaman">
                                            <option value="" disabled selected>Pilih minimal pengalaman</option>
                                            <option value="Tidak ada"
                                                {{ old('min_pengalaman') === 'Tidak ada' ? 'selected' : '' }}>
                                                Tidak ada
                                            </option>
                                            <option value="Kurang dari setahun"
                                                {{ old('min_pengalaman') === 'kurang dari setahun' ? 'selected' : '' }}>
                                                Kurang dari setahun
                                            </option>
                                            <option value="Lebih dari setahun"
                                                {{ old('min_pengalaman') === 'Lebih dari setahun' ? 'selected' : '' }}>
                                                Lebih dari setahun
                                            </option>
                                        </select>
                                        @error('min_pengalaman')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gaji">Gaji</label>
                                        <div class="d-flex">
                                            <div class="d-flex align-items-center flex-grow-1">
                                                <input type="text"
                                                    class="form-control mr-2 @error('gaji_bawah') is-invalid @enderror"
                                                    id="gaji_bawah" name="gaji_bawah" value="{{ old('gaji_bawah') }}"
                                                    placeholder="contoh: 3000000">
                                                <span class="mr-2">-</span>
                                                <input type="text"
                                                    class="form-control @error('gaji_atas') is-invalid @enderror"
                                                    id="gaji_atas" name="gaji_atas" value="{{ old('gaji_atas') }}"
                                                    placeholder="contoh: 3000000">
                                            </div>
                                        </div>
                                        @if ($errors->has('gaji_bawah') && !$errors->has('gaji_atas'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('gaji_bawah') }}
                                            </div>
                                        @elseif (!$errors->has('gaji_bawah') && $errors->has('gaji_atas'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('gaji_atas') }}
                                            </div>
                                        @elseif ($errors->has('gaji_bawah') && $errors->has('gaji_atas'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('gaji_atas') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi Kerja</label>
                                        <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                            id="lokasi" name="lokasi" placeholder="Masukkan lokasi kerja"
                                            value="{{ old('lokasi') }}">
                                        @error('lokasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah_pelamar">Kuota Pelamar</label>
                                        <input type="number"
                                            class="form-control @error('jumlah_pelamar') is-invalid @enderror"
                                            id="jumlah_pelamar" name="jumlah_pelamar"
                                            placeholder="Masukkan kuota pelamar yang dibutuhkan"
                                            value="{{ old('jumlah_pelamar') }}">
                                        @error('jumlah_pelamar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tutup">Lowongan di tutup</label>
                                        <input type="date" class="form-control @error('tutup') is-invalid @enderror"
                                            id="tutup" name="tutup" value="{{ old('tutup') }}">
                                        @error('tutup')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="Pending">
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                                <a class="btn btn-secondary" href="{{ route('loker.index') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('customScript')
    <script src="{{ asset('assets/js/summernote-bs4.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#requirement').summernote({
                placeholder: 'Masukkan persyaratan pekerjaan',
                height: 195,
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

@push('customStyle')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
