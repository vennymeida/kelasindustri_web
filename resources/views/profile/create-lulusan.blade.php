@extends('landing-page.app')
@section('main')
    <main class="bg-light">
        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
        <section>
            <div class="col-md-12 mt-4">
                <p class="font-weight-bolder ml-5" style="font-size: 20px">Lengkapi Data Diri</p>
            </div>
        </section>

        <section>
            <div class="col-md-11 mx-auto mt-4">
                <div class="col-md-10 bg-white mx-auto py-4" style="border-radius: 15px;">
                    <div class="col-md-11 mx-auto mt-4">
                        <h6 class="font-weight-bolder">Informasi Umum</h6>
                    </div>
                    <form action="{{ route('profile-lulusan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control select2 @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif Mencari Kerja">Aktif Mencari Kerja</option>
                                    <option value="Sudah Bekerja">Sudah Bekerja</option>
                                    <option value="Melanjutkan Kuliah">Melanjutkan Kuliah</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control select2 @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="laki-laki" {{ old('jenis_kelamin', Auth::user()->lulusan->jenis_kelamin ?? '') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="perempuan" {{ old('jenis_kelamin', Auth::user()->lulusan->jenis_kelamin ?? '') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="angkatan_tahun">Angkatan Tahun</label>
                                <input type="text" name="angkatan_tahun" id="angkatan_tahun" class="form-control @error('angkatan_tahun') is-invalid @enderror" value="{{ old('angkatan_tahun') }}" required>
                                @error('angkatan_tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="divisi">Divisi</label>
                                <input type="text" name="divisi" id="divisi" class="form-control @error('divisi') is-invalid @enderror" value="{{ old('divisi') }}" required>
                                @error('divisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" required>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="no_hp">Nomor Telepon</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="ringkasan">Ringkasan</label>
                                <textarea class="form-control summernote @error('ringkasan') is-invalid @enderror" id="ringkasan" name="ringkasan" required>{{ old('ringkasan') }}</textarea>
                                @error('ringkasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" required>
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-11 text-right my-4">
                            <button type="submit" class="btn btn-primary mr-1 px-3" style="border-radius: 15px;">Submit</button>
                            <a class="btn btn-secondary px-4" href="{{ route('profile-lulusan.index') }}" style="border-radius: 15px;">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('customStyle')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ringkasan').summernote({
                placeholder: 'Masukkan ringkasan',
                height: 200,
            });

            $('.select2').select2({
                placeholder: 'Pilih Status',
            });

            const tglLahirInput = document.getElementById('tgl_lahir');
            if (tglLahirInput) {
                const today = new Date();
                const minDate = new Date(today.getFullYear() - 17, today.getMonth(), today.getDate());
                const minDateString = minDate.toISOString().split('T')[0];
                tglLahirInput.setAttribute('max', minDateString);
            }
        });
    </script>
@endpush
