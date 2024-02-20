@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Lowongan Pekerjaan</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Detail Data Lowongan Pekerjaan</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="user">Nama User</label>
                    <input type="text" class="form-control" id="user" name="user"
                        value="{{ $loker->user }}" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $loker->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori"
                        value="{{ $loker->kategori }}" disabled>
                </div>
                <div class="form-group">
                    <label for="judul">Judul Lowongan</label>
                    <input type="text" class="form-control" id="judul" name="judul"
                        value="{{ $loker->judul }}" disabled>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Pekerjaan</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                        value="{{ $loker->deskripsi }}" disabled>
                </div>
                <div class="form-group">
                    <label for="requirement">Persyaratan Pekerjaan</label>
                    <input type="text" class="form-control" id="requirement" name="requirement"
                        value="{{ $loker->requirement }}" disabled>
                </div>
                <div class="form-group">
                    <label for="tipe">Tipe Pekerjaan</label>
                    <input type="text" class="form-control" id="tipe" name="tipe"
                        value="{{ $loker->tipe === 'onsite' ? 'Onsite' : 'Remote' }}" disabled>
                </div>
                <div class="form-group">
                    <label for="gaji">Gaji Pekerjaan</label>
                    <input type="text" class="form-control" id="gaji" name="gaji"
                        value="{{ $loker->gaji }}" disabled>
                </div>
                <div class="form-group">
                    <label for="kuota">Kuota yang Dibutuhkan</label>
                    <input type="text" class="form-control" id="kuota" name="kuota"
                        value="{{ $loker->kuota }}" disabled>
                </div>
                <div class="form-group">
                    <label for="status">Status Pekerjaan</label>
                    <input type="text" class="form-control" id="status" name="status"
                        value="{{ $loker->status === 'pending' ? 'Pending' : ($loker->status === 'dibuka' ? 'Dibuka' : 'Ditutup') }}" disabled>
                </div>
            </div>
            <div class="card-footer text-right">
                <a class="btn btn-secondary" href="{{ route('loker.index') }}">Back</a>
            </div>
        </div>
    </div>
</section>
@endsection
