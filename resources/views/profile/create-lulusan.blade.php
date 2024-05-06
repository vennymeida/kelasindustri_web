@extends('landing-page.app')
@section('main')
    <div class="container">
        <h1>Lengkapi Data Diri</h1>
        <form action="{{ route('profile-lulusan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="display: none">
                <label for="user_id">user</label>
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $user->id }}">
                @error('user_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">status</label>
                {{-- select2 --}}
                <select class="form-control select2" id="status" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="Aktif Mencari Kerja">Aktif Mencari Kerja</option>
                    <option value="Sudah Bekerja">Sudah Bekerja</option>
                    <option value="Melanjutkan Kuliah">Melanjutkan Kuliah</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat">alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="no_hp">Nomer Hp</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                @error('no_hp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ringkasan">ringkasan</label>
                <textarea class="form-control summernote" id="ringkasan" name="ringkasan"></textarea>
                @error('ringkasan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
         

            <div class="form-group">
                <label for="foto">foto</label>
                <input type="file" class="form-control" id="foto" name="foto" >
                @error('foto')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="resume">resume</label>
                <input type="file" class="form-control" id="resume" name="resume" >
                @error('resume')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tgl_lahir">tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" >
                @error('tgl_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
