@extends('layouts.app2')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Ubah Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Hai, {{ Auth::user()->name }}!</h2>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')

                    @if (session('message'))
                        <div class="alert alert-warning">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <p class="section-lead">
                Ubah informasi tentang diri Anda di halaman ini.
            </p>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="border-radius: 15px;">
                            <form method="POST" action="{{ route('profile.admin.update') }}"
                                class="needs-validation" novalidate="">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-5 col-12">
                                            @if (Auth::user()->superadmin && Auth::user()->superadmin->foto != '')
                                                <img alt="image"
                                                    src="{{ asset('images/' . Auth::user()->superadmin->foto) }}"
                                                    class="rounded-circle profile-widget-picture img-fluid"
                                                    style="width: 150px; height: 150px;">
                                            @else
                                                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                                    class="rounded-circle profile-widget-picture img-fluid"
                                                    style="width: 150px; height: 150px;">
                                            @endif
                                        </div>
                                        <div class="col-md-7 col-12">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input name="name" type="text"
                                                    class="form-control @error('name', 'updateProfileInformation')
                                            is-invalid
                                            @enderror"
                                                    value="{{ Auth::user()->name }}" style="border-radius: 15px;">
                                                @error('name', 'updateProfileInformation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div id="pwindicator" class="pwindicator">
                                                    <div class="bar"></div>
                                                    <div class="label"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input name="email" type="email"
                                                    class="form-control @error('email', 'updateProfileInformation')
                                            is-invalid
                                            @enderror"
                                                    value="{{ Auth::user()->email }}" style="border-radius: 15px;">
                                                @error('email', 'updateProfileInformation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div id="pwindicator" class="pwindicator">
                                                    <div class="bar"></div>
                                                    <div class="label"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit" style="border-radius: 15px;">Ubah
                                        Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card" style="border-radius: 15px;">
                            <form method="POST" action="{{ route('user-password.update') }}" class="needs-validation"
                                novalidate="">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Ubah Kata Sandi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label for="current_password">Kata Sandi Saat Ini</label>
                                            <input id="current_password" type="password"
                                                class="form-control select @error('current_password', 'updatePassword') is-invalid @enderror"
                                                data-indicator="pwindicator" name="current_password" tabindex="2"
                                                style="border-radius: 15px;">
                                            @error('current_password', 'updatePassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label for="password">Kata Sandi Baru</label>
                                            <input id="password" type="password"
                                                class="form-control select @error('password', 'updatePassword') is-invalid @enderror"
                                                data-indicator="pwindicator" name="password" tabindex="2"
                                                style="border-radius: 15px;">
                                            @error('password', 'updatePassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                                            <input id="password_confirmation" type="password"
                                                class="form-control select @error('password_confirmation') is-invalid @enderror"
                                                data-indicator="pwindicator" name="password_confirmation" tabindex="2"
                                                style="border-radius: 15px;">
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit" style="border-radius: 15px;">Ubah Kata
                                        Sandi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card" style="border-radius: 15px;">
                    <form method="POST" action="{{ route('profile.admin.update') }}" class="needs-validation"
                        novalidate="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Ubah Data Diri</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Alamat</label>
                                    <input name="alamat" type="text"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        value="{{ Auth::user()->superadmin ? Auth::user()->superadmin->alamat : '' }}"
                                        style="border-radius: 15px;">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control select2 @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L"
                                            {{ Auth::user()->superadmin && Auth::user()->superadmin->jenis_kelamin === 'L' ? 'selected' : '' }}>
                                            Laki-Laki</option>
                                        <option value="P"
                                            {{ Auth::user()->superadmin && Auth::user()->superadmin->jenis_kelamin === 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>No HP</label>
                                    <div class="input-group">
                                        <div class="input-group-text" style="border-radius: 15px 0px 0px 15px;">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <input name="no_hp" type="text"
                                            class="form-control phone-number @error('no_hp') is-invalid @enderror"
                                            value="{{ Auth::user()->superadmin ? Auth::user()->superadmin->no_hp : '' }}"
                                            style="border-radius: 0px 15px 15px 0px;">
                                        @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Unggah Foto</label>
                                    <input name="foto" type="file"
                                        class="form-control @error('foto') is-invalid @enderror"
                                        style="border-radius: 15px;">
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="text-warning small">(File type : jpeg,png,jpg | Max size : 2MB)</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit" style="border-radius: 15px;">Perbarui Data
                                Diri</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('customStyle')
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
