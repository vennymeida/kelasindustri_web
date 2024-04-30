@extends('landing-page.app')
@section('main')
    <main class="bg-light">
        <section>
            <div class="col md-12 mt-4">
                <p class="font-weight-bolder ml-5" style="font-size: 20px">Lengkapi Data Diri</p>
            </div>
        </section>

        <section>
            <div class="col-md-11 mx-auto mt-4">
                <div class="col md-10 bg-white mx-auto py-4" style="border-radius: 15px;">
                    <div class="col-md-11 mx-auto mt-4">
                        <h6 class="font-weight-bolder">Informasi Umum</h6>
                    </div>
                    <form action="{{ route('profile-lulusan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control select2" id="status" name="status" required>
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
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="no_hp">Nomer HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="ringkasan">Ringkasan</label>
                                <textarea class="form-control summernote" id="ringkasan" name="ringkasan"></textarea>
                                @error('ringkasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
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
    <script src="{{ asset('assets/js/summernote-bs4.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ringkasan').summernote({
                placeholder: 'Masukkan ringkasan',
                height: 200,
            });
        });

        $('.select2').select2({
            placeholder: 'Pilih Status',
        });
    </script>
@endpush
