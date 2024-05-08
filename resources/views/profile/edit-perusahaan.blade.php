<!-- Modal for Logo Preview -->
<div class="modal fade" id="logoPreviewModal" tabindex="-1" role="dialog" aria-labelledby="logoPreviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="logoPreviewModalLabel" style="color: #6777ef; font-weight: bold;">Logo
                    Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="logoPreviewImage" src="" alt="logo Preview" class="img-fluid">
            </div>
        </div>
    </div>
</div>
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
                                                    value="{{ $perusahaan->name }}" placeholder="Masukkan nama anda">
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
                                                    value="{{ $perusahaan->email }}" placeholder="Masukkan email anda">
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
                                        Ubah Data Perusahaan</h5>
                                </div>
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('profile.perusahaan.update') }}"
                                        class="needs-validation" novalidate="" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group col-md-12 col-12" style="display: none">
                                            <label>User ID</label>
                                            <input name="user_id" type="hidden" id="user_id"
                                                class="form-control custom-input @error('user_id') is-invalid @enderror"
                                                value="{{ $perusahaan->userId }}"
                                                placeholder="Masukkan nama pemilik perusahaan">
                                            @error('user_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Nama Pemilik Perusahaan</label>
                                            <input name="nama_pemilik" type="text" id="nama_pemilik"
                                                class="form-control custom-input @error('nama_pemilik') is-invalid @enderror"
                                                value="{{ $perusahaan->nama_pemilik }}"
                                                placeholder="Masukkan nama pemilik perusahaan">
                                            @error('nama_pemilik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Nama Perusahaan</label>
                                            <input name="nama_perusahaan" type="text"
                                                class="form-control custom-input @error('nama_perusahaan') is-invalid @enderror"
                                                value="{{ $perusahaan->nama_perusahaan }}"
                                                placeholder="Masukkan nama perusahaan">
                                            @error('nama_perusahaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label for="alamat_perusahaan">Alamat Perusahaan</label>
                                            <textarea name="alamat_perusahaan" id="alamat_perusahaan"
                                                class="text-loker form-control @error('alamat_perusahaan') is-invalid @enderror" rows="3" type="text"
                                                style="height: 100px;" placeholder="Masukkan alamat perusahaan">{{ $perusahaan->alamat_perusahaan }}</textarea>
                                            @error('alamat_perusahaan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="row col-12">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="kota_id">Kota</label>
                                                <select class="form-control select2 @error('kota_id') is-invalid @enderror"
                                                    name="kota_id" data-id="select-kota" id="kota_id">
                                                    <option value="">Pilih kota</option>
                                                    @foreach ($kotas as $kota)
                                                        <option value="{{ $kota->id }}"
                                                            @if ($perusahaan->kota_id == $kota->id) selected @endif>
                                                            {{ $kota->kota }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kota_id')
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
                                                <input name="email_perusahaan" type="text"
                                                    class="form-control custom-input email @error('email_perusahaan') is-invalid @enderror"
                                                    value="{{ $perusahaan->email_perusahaan }}"
                                                    placeholder="Masukkan email perusahaan">
                                                @error('email_perusahaan')
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
                                                    value="{{ $perusahaan->website }}"
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
                                                <input name="no_telp" type="number"
                                                    class="form-control phone-number custom-input @error('no_telp') is-invalid @enderror"
                                                    value="{{ $perusahaan->no_telp }}" placeholder="Contoh: 08...">
                                                @error('no_telp')
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
                                                    @if (!empty($perusahaan->deskripsi))
{{ $perusahaan->deskripsi }}
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
                                            <input id="logo_perusahaan" name="logo_perusahaan" type="file"
                                                class="form-control custom-input @error('logo_perusahaan') is-invalid @enderror">
                                            @error('logo_perusahaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="text-warning small" style="font-size: 13px; font-weight:bolder;">
                                                (Tipe berkas : jpeg,jpg,png | Max size : 2MB)</div>
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Unggah Surat Kerja Sama / MoU</label>
                                            <input id="surat_mou" name="surat_mou" type="file"
                                                class="form-control custom-input @error('surat_mou') is-invalid @enderror">
                                            @error('surat_mou')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="text-warning small" style="font-size: 13px; font-weight:bolder;">
                                                (Tipe berkas : PDF | Max size : 2MB)</div>
                                        </div>
                                        <div class="row col-12 mb-4">
                                            <div class="form-group col-md-6">
                                                @if ($perusahaan->logo_perusahaan != '')
                                                    <div>
                                                        <a href="#" class="btn btn-sm btn-warning btn-icon"
                                                            data-toggle="modal" data-target="#logoPreviewModal"
                                                            data-pdf="{{ Storage::url($perusahaan->logo_perusahaan) }}"
                                                            style="border-radius: 15px;">
                                                            <i class="fas fa-eye mt-6"></i> Lihat Logo
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                @if ($perusahaan && $perusahaan->surat_mou != '')
                                                    <div>
                                                        <a href="{{ Storage::url($perusahaan->surat_mou) }}"
                                                            onclick="return openResume();" target="_blank"
                                                            class="btn btn-sm btn-warning btn-icon"
                                                            style="border-radius:15px;"><i class="fas fa-eye mt-6"></i>
                                                            Lihat MoU
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
                    {{-- @endif --}}
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
    <script>
        $(document).ready(function() {
            $('#logoPreviewModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var logoUrl = button.data('pdf');

                var modal = $(this);
                modal.find('#logoPreviewImage').attr('src', logoUrl);
            });
        });
    </script>
@endpush
