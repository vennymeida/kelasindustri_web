@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Tambah User</h2>

            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Enter User Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Enter User Email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Enter User Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_type">Assign Roles</label>
                            <select class="select2 form-control @error('user_type') is-invalid @enderror" id="user_type"
                                name="user_type">
                                <option value="">Pilih Role</option>
                                <option value="lulusan" {{ old('user_type') === 'lulusan' ? 'selected' : '' }}>
                                    Lulusan</option>
                                <option value="perusahaan" {{ old('user_type') === 'perusahaan' ? 'selected' : '' }}>
                                    Perusahaan</option>
                            </select>
                            @error('user_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group" id="upload-doc" style="display: none;">
                            <label for="document">Unggah Dokumen</label>
                            <input type="file" class="form-control-file @error('document') is-invalid @enderror" id="document" name="document">
                            @error('document')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('user.index') }}">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('customScript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userTypeSelect = document.getElementById('user_type');  // Dropdown role
        const uploadDoc = document.getElementById('upload-doc');  // Kolom unggah dokumen

        // Fungsi untuk menampilkan atau menyembunyikan kolom unggah dokumen
        function toggleUploadDoc() {
            if (userTypeSelect.value === 'lulusan') {
                uploadDoc.style.display = 'block';  // Tampilkan kolom jika "Lulusan"
            } else {
                uploadDoc.style.display = 'none';  // Sembunyikan kolom jika bukan "Lulusan"
            }
        }

        // Jalankan fungsi untuk memastikan kondisi awal yang benar
        toggleUploadDoc();

        // Tambahkan event listener untuk memantau perubahan pada dropdown role
        userTypeSelect.addEventListener('change', toggleUploadDoc);
    });
</script>
@endpush
