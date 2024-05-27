<!-- Modal for Foto Preview -->
<div class="modal fade" id="fotoPreviewModal" tabindex="-1" role="dialog" aria-labelledby="fotoPreviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="fotoPreviewModalLabel" style="color: #6777ef; font-weight: bold;">Foto
                    Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="fotoPreviewImage" src="" alt="Foto Preview" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Modal for Resume Preview -->
<div class="modal fade" id="resumePreviewModal" tabindex="-1" role="dialog" aria-labelledby="resumePreviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="resumePreviewModalLabel" style="color: #6777ef; font-weight: bold;">Resume
                    Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="resumePreviewFrame" src="" frameborder="0" width="100%" height="500"></iframe>
            </div>
        </div>
    </div>
</div>

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

<!-- Modal for SIU Preview -->
<div class="modal fade fullscreen-modal" id="siuPreviewModal" tabindex="-1" role="dialog"
    aria-labelledby="siuPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="siuPreviewModalLabel" style="color: #6777ef; font-weight: bold;">Surat Izin
                    Usaha
                    Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="siuPreviewFrame" src="" frameborder="0" width="100%" height="500"></iframe>
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
                        <a href="{{ url('/profile-lulusan') }}" class="font-weight-bolder">
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
                                        @if (Auth::user()->lulusan && Auth::user()->lulusan->foto != '')
                                            <img alt="image"
                                                src="{{ Auth::user()->lulusan ? Storage::url(Auth::user()->lulusan->foto) : '' }}"
                                                class="rounded-circle lulusan-widget-picture img-fluid"
                                                style="width: 140px; height: 140px;">
                                        @else
                                            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                                class="rounded-circle lulusan-widget-picture img-fluid"
                                                style="width: 140px; height: 140px;">
                                        @endif
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
                    <div class="col-md-12">
                        <div class="card border-primary mb-2">
                            <div class="card-body">
                                <div class="text-left mb-4 mt-2 ml-2">
                                    <h5 class="card-title font-weight-bold d-block mx-2" style="color:#6777EF;">
                                        Ubah Data Diri</h5>
                                </div>
                                <div class="col-md-12">
                                    <form method="POST"
                                        action="{{ route('profile-lulusan.update', ['profile_lulusan' => $lulusan->id]) }}"
                                        class="needs-validation" novalidate="" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group col-md-12 col-12">
                                            <label for="status">Status</label>
                                            <select
                                                class="form-control select2 custom-input @error('status') is-invalid @enderror"
                                                name="status" id="status">
                                                <option value="">Pilih Status</option>
                                                <option value="Aktif Mencari Kerja"
                                                    {{ Auth::user()->lulusan && Auth::user()->lulusan->status === 'Aktif Mencari Kerja' ? 'selected' : '' }}>
                                                    Aktif Mencari Kerja</option>
                                                <option value="Sudah Bekerja"
                                                    {{ Auth::user()->lulusan && Auth::user()->lulusan->status === 'Sudah Bekerja' ? 'selected' : '' }}>
                                                    Sudah Bekerja</option>
                                                <option value="Melanjutkan Kuliah"
                                                    {{ Auth::user()->lulusan && Auth::user()->lulusan->status === 'Melanjutkan Kuliah' ? 'selected' : '' }}>
                                                    Melanjutkan Kuliah</option>
                                                @error('status')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label for="angkatan_tahun">Angkatan Tahun</label>
                                            <div class="input-group">
                                                <input name="angkatan_tahun" type="text" id="angkatan_tahun"
                                                    class="form-control phone-number custom-input @error('angkatan_tahun') is-invalid @enderror"
                                                    value="{{ Auth::user()->lulusan->angkatan_tahun }}">
                                                @error('angkatan_tahun')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label for="divisi">Divisi</label>
                                            <div class="input-group">
                                                <input name="divisi" type="text" id="divisi"
                                                    class="form-control phone-number custom-input @error('divisi') is-invalid @enderror"
                                                    value="{{ Auth::user()->lulusan->divisi }}">
                                                @error('divisi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Tanggal Lahir</label>
                                            <div class="input-group">
                                                <input name="tgl_lahir" type="date" id="tgl_lahir"
                                                    class="form-control phone-number custom-input @error('tgl_lahir') is-invalid @enderror"
                                                    value="{{ Auth::user()->lulusan->tgl_lahir }}">
                                                @error('tgl_lahir')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 col-12">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select
                                                class="form-control select2 custom-input @error('jenis_kelamin') is-invalid @enderror"
                                                name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="laki-laki"
                                                    {{ Auth::user()->lulusan && Auth::user()->lulusan->jenis_kelamin === 'laki-laki' ? 'selected' : '' }}>
                                                    Laki-Laki</option>
                                                <option value="perempuan"
                                                    {{ Auth::user()->lulusan && Auth::user()->lulusan->jenis_kelamin === 'perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                                @error('jenis_kelamin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </select>
                                        </div>
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
                                                    value="{{ Auth::user()->lulusan->no_hp }}"
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
                                                type="text" style="height: 100px;" placeholder="Masukkan alamat anda">{{ Auth::user()->lulusan->alamat }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label for="ringkasan">Ringkasan</label>
                                            <textarea name="ringkasan" id="ringkasan"
                                                class="form-control summernote-simple @error('ringkasan') is-invalid @enderror" type="text"
                                                placeholder="Masukkan ringkasan tentang diri anda">{{ Auth::user()->lulusan ? Auth::user()->lulusan->ringkasan : '' }}</textarea>
                                            @error('ringkasan')
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
                                            <div class="text-warning small" style="font-size: 13px; font-weight:bolder;">
                                                (Tipe berkas : jpeg,jpg,png | Max size : 2MB)</div>
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Unggah Resume</label>
                                            <input id="resume" name="resume" type="file"
                                                class="form-control custom-input @error('resume') is-invalid @enderror">
                                            @error('resume')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="text-warning small" style="font-size: 13px; font-weight:bolder;">
                                                (Tipe berkas : pdf | Max size : 2MB)</div>
                                        </div>
                                        <div class="row col-12 mb-4">
                                            <div class="form-group col-md-6">
                                                @if (Auth::user()->lulusan && Auth::user()->lulusan->foto != '')
                                                    <div>
                                                        <a href="#" class="btn btn-sm btn-warning btn-icon"
                                                            data-toggle="modal" data-target="#fotoPreviewModal"
                                                            data-pdf="{{ Storage::url(Auth::user()->lulusan->foto) }}"
                                                            style="border-radius: 15px;">
                                                            <i class="fas fa-eye mt-6"></i> Lihat Foto
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                @if (Auth::user()->lulusan && Auth::user()->lulusan->resume != '')
                                                    <div>
                                                        <a href="{{ Storage::url(Auth::user()->lulusan->resume) }}"
                                                            onclick="return openResume();" target="_blank"
                                                            class="btn btn-sm btn-warning btn-icon"
                                                            style="border-radius:15px;"><i class="fas fa-eye mt-6"></i>
                                                            Lihat Resume
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
        document.addEventListener('DOMContentLoaded', (event) => {
            const tglLahirInput = document.getElementById('tgl_lahir');

            if (tglLahirInput) {
                const today = new Date();
                const minDate = new Date(today.getFullYear() - 17, today.getMonth(), today.getDate());

                const minDateString = minDate.toISOString().split('T')[0];

                tglLahirInput.setAttribute('max', minDateString);
            }
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
            return formatted;
        }

        document.getElementById('harapan_gaji').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#resumePreviewModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var pdfUrl = button.data('pdf');

                var modal = $(this);
                modal.find('.modal-body iframe').attr('src', pdfUrl);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#fotoPreviewModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var fotoUrl = button.data('pdf');

                var modal = $(this);
                modal.find('#fotoPreviewImage').attr('src', fotoUrl);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#siuPreviewModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var pdfUrl = button.data('pdf');

                var modal = $(this);
                modal.find('.modal-body iframe').attr('src', pdfUrl);
            });
        });
    </script>

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

    {{-- <script>
        $(document).ready(function() {
            $('#kecamatan_id').change(function() {
                if ($(this).val() == '') {
                    $('#kelurahan_id').attr('disabled', true);
                } else {
                    $('#kelurahan_id').removeAttr('disabled', false);
                }

                var kecamatanId = $(this).val();
                $.ajax({
                    url: '{{ route('getKelurahans') }}',
                    type: 'GET',
                    data: {
                        kecamatan_id: kecamatanId
                    },
                    success: function(response) {
                        $('#kelurahan_id').html('<option value="">Pilih Kelurahan</option>');
                        $.each(response.kelurahans, function(key, kelurahan) {
                            $('#kelurahan_id').append('<option value="' + kelurahan.id +
                                '">' + kelurahan.kelurahan + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
        var selectKecamatanId = "{{ $perusahaans ? $perusahaans->kecamatan_id : '' }}";
        var selectKelurahanId =
            "{{ auth()->user()->perusahaans ? optional(auth()->user()->perusahaans->kelurahan)->id : '' }}";

        // Mengisi dropdown Kelurahan sesuai dengan Kecamatan yang terpilih
        if (selectKecamatanId != null) {
            if ($("#kecamatan_id").val() != null) {
                $('#kelurahan_id').removeAttr('disabled', true);
            }
            var selectkelProfile = "{{ $perusahaans ? $perusahaans->kelurahan_id : '' }}";
            var idKecamatanSelected = $("#kecamatan_id").val();
            console.log(idKecamatanSelected);
            $.ajax({
                url: '/load-filter',
                method: 'POST',
                data: {
                    id: idKecamatanSelected,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#kelurahan_id').empty();
                    $('#kelurahan_id').append('<option value="">Pilih Kelurahan</option>');
                    $.each(response['kelurahans'], function(key, value) {
                        $('#kelurahan_id').append('<option value="' + value.id + '">' +
                            value.kelurahan + '</option>');
                    });
                    $("#kelurahan_id option[value='" + selectkelProfile + "']").attr("selected",
                        "selected");
                }
            });
        }
    </script> --}}

    <script>
        $(document).ready(function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            @endif
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            @endif
            @if (session('message'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: '{{ session('message') }}',
                    confirmButtonText: 'OK'
                });
            @endif
            @if (session('message-data'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: '{{ session('message-data') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.keahlian').select2({
                placeholder: 'Pilih Keahlian',
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
@endpush
