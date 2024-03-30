@extends('landing-page.app')
@section('main')
    <main class="bg-light">
        <section>
            <div class="col-md-12">
                <div class="card bg-white col-md-10 mx-auto my-3">
                    <ul class="list-unstyled d-flex">
                        <a href="{{ url('/profile-perusahaan') }}" class="font-weight-bolder">
                            <img class="img-fluid mr-4 ml-2 my-4" style="width: 30px; height: 30px;"
                                src="{{ asset('assets/img/Vector.svg') }}">
                        </a>
                        <p class="text-primary font-weight-bolder my-4 " style="font-size: 22px;">Edit Data Diri</p>
                    </ul>
                </div>
            </div>
        </section>
        <section>
            <div class="col-md-10 mx-auto mt-4">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="card border-primary mb-2">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold d-block mx-2" style="color:#6777EF;">
                                    Profile
                                </h5>
                                <div class="row">
                                    <div class="col-md-4 ml-3">
                                            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                                class="rounded-circle profile-widget-picture img-fluid"
                                                style="width: 140px; height: 140px;">
                                    </div>
                                    <div class="col-md-7">
                                        <form method="POST" action="{{ route('user-profile-information.update') }}"
                                            class="needs-validation" novalidate="">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group col-md-12 col-12">
                                                <label>Nama</label>
                                                <input name="name" type="text"
                                                    class="form-control custom-input @error('name', 'updateProfileInformation')
                                                is-invalid
                                                @enderror"
                                                    value="{{ Auth::user()->name }}" placeholder="Masukkan nama anda">
                                                @error('name', 'updateProfileInformation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label>Email</label>
                                                <input name="email" type="email"
                                                    class="form-control custom-input @error('email', 'updateProfileInformation')
                                                is-invalid
                                                @enderror"
                                                    value="{{ Auth::user()->email }}" placeholder="Masukkan email anda">
                                                @error('email', 'updateProfileInformation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12 text-right">
                                                <button class="btn btn-primary mr-1 px-3"
                                                    style="border-radius: 15px; font-size: 14px; font-weight: lighter;"
                                                    type="submit">Ubah Profil</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="card border-primary mb-2">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold d-block mx-2" style="color:#6777EF;">Ubah
                                    Kata Sandi</h5>
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('user-password.update') }}"
                                        class="needs-validation" novalidate="">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label for="current_password">Kata Sandi Saat Ini</label>
                                                <input id="current_password" type="password"
                                                    class="form-control select custom-input @error('current_password', 'updatePassword') is-invalid @enderror"
                                                    data-indicator="pwindicator" name="current_password" tabindex="2"
                                                    placeholder="Masukkan kata sandi saat ini">
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
                                                    class="form-control select custom-input @error('password', 'updatePassword') is-invalid @enderror"
                                                    data-indicator="pwindicator" name="password" tabindex="2"
                                                    placeholder="Masukkan kata sandi baru">
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
                                                    class="form-control select custom-input @error('password_confirmation') is-invalid @enderror"
                                                    data-indicator="pwindicator" name="password_confirmation"
                                                    tabindex="2" placeholder="Masukkan ulang kata sandi baru">
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
                                        <div class="form-group col-md-12 text-right">
                                            <button class="btn btn-primary mr-1 px-3"
                                                style="border-radius: 15px; font-size: 14px; font-weight: lighter;"
                                                type="submit">Ubah Kata Sandi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="card border-primary mb-2">
                                <div class="card-body">
                                    <div class="text-left mb-4 mt-2 ml-2">
                                        <h5 class="card-title font-weight-bold d-block mx-2" style="color:#6777EF;">
                                            Ubah Data Diri</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <form method="POST" action="{{ route('profile.perusahaan.update') }}"
                                            class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group col-md-12 col-12">
                                                <label>Nomor Telepon</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text custom-input">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                    </div>
                                                    <input name="no_hp" type="number"
                                                        class="form-control phone-number custom-input @error('no_hp') is-invalid @enderror"
                                                        value="{{ Auth::user()->perusahaan->no_hp }}"
                                                        placeholder="Contoh: 08...">
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" id="alamat" class="text-loker form-control @error('alamat') is-invalid @enderror"
                                                    type="text" style="height: 100px;" placeholder="Masukkan alamat anda">{{ Auth::user()->perusahaan->alamat_perusahaan }}</textarea>
                                                @error('alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label>Unggah Foto</label>
                                                <input id="foto" name="foto" type="file"
                                                    class="form-control custom-input @error('foto') is-invalid @enderror">
                                                @error('foto')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="text-warning small"
                                                    style="font-size: 13px; font-weight:bolder;">
                                                    (Tipe berkas : jpeg,jpg,png | Max size : 2MB)</div>
                                            </div>
                                            <div class="form-group col-md-12 text-right my-4">
                                                <button class="btn btn-primary mr-1 px-3"
                                                    style="border-radius: 15px; font-size: 14px; font-weight: lighter;"
                                                    type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @if (Auth::user()->hasRole('Pencari Kerja'))
                        <div class="col-md-6">
                            <div class="card border-primary mb-2">
                                <div class="card-body">
                                    <div class="text-left mb-4 mt-2 ml-2">
                                        <h5 class="card-title font-weight-bold d-block mx-2" style="color:#6777EF;">
                                            Tambah Keahlian Yang Dimiliki</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <form action="{{ route('profile.keahlian.update') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group col-md-12 col-12">
                                                <select name="keahlian_ids[]" multiple
                                                    class="form-control select2 keahlian">
                                                    {{-- <option value="" disabled selected></option> --}}
                                                    @foreach ($keahlians as $keahlian)
                                                        <option value="{{ $keahlian->id }}"
                                                            {{ in_array($keahlian->id, $selectedKeahlians) ? 'selected' : '' }}>
                                                            {{ $keahlian->keahlian }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 text-right my-4">
                                                <button class="btn btn-primary mr-1 px-3"
                                                    style="border-radius: 15px; font-size: 14px; font-weight: lighter;"
                                                    type="submit">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->hasRole('Perusahaan'))
                        <div class="col-md-6">
                            <div class="card border-primary mb-2">
                                <div class="card-body">
                                    <div class="text-left mb-4 mt-2 ml-2">
                                        <h5 class="card-title font-weight-bold d-block mx-2" style="color:#6777EF;">
                                            Ubah Data Perusahaan</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <form method="POST" action="{{ route('profile.perusahaan.update') }}"
                                            class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group col-md-12 col-12">
                                                <label>Nama Pemilik Perusahaan</label>
                                                <input name="pemilik" type="text"
                                                    class="form-control custom-input @error('pemilik') is-invalid @enderror"
                                                    value="{{ Auth::user()->perusahaan ? Auth::user()->perusahaan->pemilik : '' }}"
                                                    placeholder="Masukkan nama pemilik perusahaan">
                                                @error('pemilik')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label>Nama Perusahaan</label>
                                                <input name="nama" type="text"
                                                    class="form-control custom-input @error('nama') is-invalid @enderror"
                                                    value="{{ Auth::user()->perusahaan ? Auth::user()->perusahaan->nama : '' }}"
                                                    placeholder="Masukkan nama perusahaan">
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label for="alamat_perusahaan">Alamat Perusahaan</label>
                                                <textarea name="alamat_perusahaan" id="alamat_perusahaan"
                                                    class="text-loker form-control @error('alamat_perusahaan') is-invalid @enderror" rows="3" type="text"
                                                    style="height: 100px;" placeholder="Masukkan alamat perusahaan">{{ Auth::user()->perusahaan ? Auth::user()->perusahaan->alamat_perusahaan : '' }}</textarea>
                                                @error('alamat_perusahaan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row col-12">
                                                <div class="form-group col-md-6 col-12">
                                                    <label for="kecamatan_id">Kecamatan</label>
                                                    <select
                                                        class="form-control select2 @error('kecamatan_id') is-invalid @enderror"
                                                        name="kecamatan_id" data-id="select-kecamatan" id="kecamatan_id">
                                                        <option value="">Pilih Kecamatan</option>
                                                        @foreach ($kecamatans as $kecamatan)
                                                            @if (!empty($perusahaans->kecamatan_id))
                                                                <option @selected($perusahaans->kecamatan_id == $kecamatan->id)
                                                                    value="{{ $kecamatan->id }}">
                                                                    {{ $kecamatan->kecamatan }}</option>
                                                            @else
                                                                <option value="{{ $kecamatan->id }}">
                                                                    {{ $kecamatan->kecamatan }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('kecamatan_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label for="kelurahan_id">Kelurahan</label>
                                                    <select
                                                        class="form-control select2 @error('kelurahan_id') is-invalid @enderror"
                                                        name="kelurahan_id" data-id="select-kelurahan" id="kelurahan_id"
                                                        disabled="disabled ">
                                                        <option value="">Pilih Kelurahan</option>
                                                    </select>
                                                    @error('kelurahan_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label>Email Perusahaan</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                    </div>
                                                    <input name="email" type="text"
                                                        class="form-control custom-input email @error('email') is-invalid @enderror"
                                                        value="{{ Auth::user()->perusahaan ? Auth::user()->perusahaan->email : '' }}"
                                                        placeholder="Masukkan email perusahaan">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label>Website Perusahaan</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-globe"></i>
                                                        </div>
                                                    </div>
                                                    <input name="website" type="text"
                                                        class="form-control custom-input website @error('website') is-invalid @enderror"
                                                        value="{{ Auth::user()->perusahaan ? Auth::user()->perusahaan->website : '' }}"
                                                        placeholder="Masukkan website perusahaan">
                                                    @error('website')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label>No Telp Perusahaan</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text custom-input">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                    </div>
                                                    <input name="no_hp_perusahaan" type="number"
                                                        class="form-control phone-number custom-input @error('no_hp_perusahaan') is-invalid @enderror"
                                                        value="{{ Auth::user()->perusahaan ? Auth::user()->perusahaan->no_hp_perusahaan : '' }}"
                                                        placeholder="Contoh: 08...">
                                                    @error('no_hp_perusahaan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label>Informasi Tentang Perusahaan</label>
                                                <textarea id="deskripsi" name="deskripsi" type="text"
                                                    class="form-control summernote-simple @error('deskripsi') is-invalid @enderror">
                                                    @if (!empty($perusahaans->deskripsi))
{{ $perusahaans->deskripsi }}
@else
@endif
                                                </textarea>
                                                @error('deskripsi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label>Unggah Logo Perusahaan</label>
                                                <input id="logo" name="logo" type="file"
                                                    class="form-control custom-input @error('logo') is-invalid @enderror">
                                                @error('logo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="text-warning small"
                                                    style="font-size: 13px; font-weight:bolder;">
                                                    (Tipe berkas : jpeg,jpg,png | Max size : 2MB)</div>
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label>Unggah Surat Izin Usaha</label>
                                                <input id="siu" name="siu" type="file"
                                                    class="form-control custom-input @error('siu') is-invalid @enderror">
                                                @error('siu')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="text-warning small"
                                                    style="font-size: 13px; font-weight:bolder;">
                                                    (Tipe berkas : PDF | Max size : 2MB)</div>
                                            </div>
                                            <div class="row col-12 mb-4">
                                                <div class="form-group col-md-6">
                                                    @if (Auth::user()->perusahaan && Auth::user()->perusahaan->logo != '')
                                                        <div>
                                                            <a href="#" class="btn btn-sm btn-warning btn-icon"
                                                                data-toggle="modal" data-target="#logoPreviewModal"
                                                                data-pdf="{{ Storage::url(Auth::user()->perusahaan->logo) }}"
                                                                style="border-radius: 15px;">
                                                                <i class="fas fa-eye mt-6"></i> Lihat Logo
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    @if (Auth::user()->perusahaan && Auth::user()->perusahaan->siu != '')
                                                        <div>
                                                            {{-- <a href="#" class="btn btn-sm btn-warning btn-icon"
                                                                data-toggle="modal" data-target="#siuPreviewModal"
                                                                data-pdf="{{ Auth::user()->perusahaan ? Storage::url(Auth::user()->perusahaan->siu) : '' }}"
                                                                style="border-radius: 15px;">
                                                                <i class="fas fa-eye mt-6"></i> Lihat SIU
                                                            </a> --}}
                                                            <a href="{{ Auth::user()->perusahaan ? Storage::url(Auth::user()->perusahaan->siu) : '' }}"
                                                                onclick="return openResume();" target="_blank"
                                                                class="btn btn-sm btn-warning btn-icon"
                                                                style="border-radius:15px;"><i
                                                                    class="fas fa-eye mt-6"></i>
                                                                Lihat SIU
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 text-right my-4">
                                                <button class="btn btn-primary mr-1 px-3"
                                                    style="border-radius: 15px; font-size: 14px; font-weight: lighter;"
                                                    type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection

@push('customStyle')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush
