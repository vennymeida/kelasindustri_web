<!-- Modal for Resume Preview -->
<div class="modal fade fullscreen-modal" id="resumePreviewModal" tabindex="-1" role="dialog"
    aria-labelledby="resumePreviewModalLabel" aria-hidden="true">
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

<!-- Modal Tambah Postingan -->
<div class="modal fade" id="modal-create-postingan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modalTambah1">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Tambah
                    Postingan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('postingan.store') }}" class="needs-validation" novalidate=""
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body">
                                <div class="media mb-4">
                                    @if (Auth::user()->profile && Auth::user()->profile->foto != '')
                                        <img class="mr-3 rounded-circle" style="width: 50px; height: 50px;"
                                            src="{{ Auth::user()->profile ? Storage::url(Auth::user()->profile->foto) : '' }}"
                                            alt="Profile Image">
                                    @else
                                        <img class="mr-3 rounded-circle" style="width: 50px; height: 50px;"
                                            src="{{ asset('assets/img/avatar/avatar-1.png') }}">
                                    @endif
                                    <div class="media-body">
                                        <h5 class="mt-0" style="font-weight: bold;">{{ auth()->user()->name }}</h5>
                                        <p>{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                                <div class="form-group summernoteField">
                                    <label for="konteks">Konten Postingan</label>
                                    <textarea name="konteks" id="konteks" class="form-control summernote @error('konteks') is-invalid @enderror"
                                        type="text" required>{{ old('konteks') }}</textarea>
                                    @error('konteks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <!-- Gunakan label untuk mengaktifkan input file -->
                                            <label for="mediaUploadButton" class="imgUploadButton"
                                                style="cursor: pointer;">
                                                <img class="img-fluid" src="{{ asset('assets/img/Gallery Add.svg') }}">
                                                &nbsp;&nbsp;&nbsp; Media
                                            </label>
                                            <!-- Input file tersembunyi -->
                                            <input type="file" id="mediaUploadButton" class="d-none" accept="image/*"
                                                onchange="displayFileName(this)" name="media">
                                            <!-- Elemen untuk menampilkan nama file yang dipilih -->
                                            <p id="selectedFileName"></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke m-4">
                <button type="button" class="btn btn-primary" onclick="$('form', this.closest('.modal')).submit();"
                    style="border-radius: 15px; font-size: 14px">Posting</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    style="border-radius: 15px; font-size: 14px">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pendidikan -->
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Tambah
                    Pendidikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('pendidikan.store') }}" class="needs-validation"
                    novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="gelar">Gelar</label>
                            <select class="form-control select2 custom-input @error('gelar') is-invalid @enderror"
                                name="gelar" id="gelar">
                                <option value="">Pilih Gelar</option>
                                <option value="SMA/SMK">SMA/SMK</option>
                                <option value="D3">Diploma III</option>
                                <option value="D4">Diploma IV</option>
                                <option value="S1">Sarjana</option>
                                <option value="S2">Magister</option>
                            </select>
                            @error('gelar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Nama Institusi</label>
                            <input name="institusi" type="text"
                                class="form-control custom-input @error('institusi') is-invalid @enderror"
                                value="{{ old('institusi') }}" placeholder="Masukkan nama institusi anda">
                            @error('institusi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Jurusan</label>
                            <input name="jurusan" type="text"
                                class="form-control custom-input @error('jurusan') is-invalid @enderror"
                                value="{{ old('jurusan') }}" placeholder="Masukkan jurusan anda">
                            @error('jurusan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Prestasi Akademik (Opsional)</label>
                            <textarea name="prestasi" class="form-control custom-input @error('prestasi') is-invalid @enderror" rows="4"
                                placeholder="Masukkan prestasi akademik yang anda miliki">{{ old('prestasi') }}</textarea>
                            @error('prestasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="col-md-12 mb-1 form-group">
                            <label for="tahun">Periode Waktu</label>
                        </div>
                        <div class="col-md-3 form-group">
                            <select
                                class="form-control select2 custom-input @error('tahun_mulai') is-invalid @enderror"
                                name="tahun_mulai" id="tahun_mulai">
                                <option value="">Pilih Tahun</option>
                                @for ($tahun = 2017; $tahun <= 2029; $tahun++)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endfor
                            </select>
                            @error('tahun_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <span> - </span>
                        <div class="col-md-3 form-group">
                            <select
                                class="form-control select2 custom-input @error('tahun_berakhir') is-invalid @enderror"
                                name="tahun_berakhir" id="tahun_berakhir">
                                <option value="">Pilih Tahun</option>
                                @for ($tahun = 2017; $tahun <= 2030; $tahun++)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endfor
                                <option value="Saat Ini">Saat Ini</option>
                            </select>
                            @error('tahun_berakhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-1 form-group">
                            <label for="ipk">IPK (Opsional)</label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input name="ipk" type="number" step="0.01"
                                class="form-control custom-input @error('ipk') is-invalid @enderror"
                                value="{{ old('ipk') }}" placeholder="Contoh : 3,75 / 4.00">
                            @error('ipk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke m-4">
                <button type="button" class="btn btn-primary" onclick="$('form', this.closest('.modal')).submit();"
                    style="border-radius: 15px; font-size: 14px">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    style="border-radius: 15px; font-size: 14px">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengalaman -->
<div class="modal fade" id="modal-create-pengalaman" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Tambah
                    Pengalaman Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('pengalaman.store') }}" class="needs-validation"
                    novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="nama_pekerjaan">Nama Pekerjaaan</label>
                            <input name="nama_pekerjaan" type="text"
                                class="form-control custom-input @error('nama_pekerjaan') is-invalid @enderror"
                                value="{{ old('nama_pekerjaan') }}"
                                placeholder="Masukkan nama pekerjaan yang pernah anda lakukan">
                            @error('nama_pekerjaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Nama Perusahaan</label>
                            <input name="nama_perusahaan" type="text"
                                class="form-control custom-input @error('nama_perusahaan') is-invalid @enderror"
                                value="{{ old('nama_perusahaan') }}"
                                placeholder="Masukkan nama perusahaan tempat anda bekerja">
                            @error('nama_perusahaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control custom-input @error('alamat') is-invalid @enderror" rows="4"
                                placeholder="Masukkan alamat perusahaan tempat anda bekerja">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-6 col-12">
                            <label>Tipe Pekerjaan</label>
                            <select class="form-control select2 custom-input @error('tipe') is-invalid @enderror"
                                name="tipe" id="tipe">
                                <option value="">Pilih Tipe Pekerjaan</option>
                                <option value="Fulltime">Fulltime</option>
                                <option value="Parttime">Part Time</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Internship">Internship</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="gaji">Gaji (Opsional)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <a>Rp</a>
                                    </div>
                                </div>
                                <input name="gaji" type="number" step="100000"
                                    class="form-control custom-input @error('gaji') is-invalid @enderror"
                                    value="{{ old('gaji') }}" placeholder="Masukkan gaji anda bekerja">
                                @error('gaji')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-6 col-12">
                            <label>Tanggal Mulai</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input name="tanggal_mulai" type="date"
                                    class="form-control custom-input @error('tanggal_mulai') is-invalid @enderror"
                                    value="{{ old('tanggal_mulai') }}">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-6 col-12">
                            <label>Tanggal Berakhir</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input name="tanggal_berakhir" type="date"
                                    class="form-control custom-input @error('tanggal_berakhir') is-invalid @enderror"
                                    value="{{ old('tanggal_berakhir') }}">
                                @error('tanggal_berakhir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke m-4">
                <button type="button" class="btn btn-primary" onclick="$('form', this.closest('.modal')).submit();"
                    style="border-radius: 15px; font-size: 14px">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    style="border-radius: 15px; font-size: 14px">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pelatihan -->
<div class="modal fade" id="modal-create-pelatihan" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Tambah
                    Pelatihan/Sertifikat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('pelatihan.store') }}" class="needs-validation"
                    novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="nama_sertifikat">Nama</label>
                            <input name="nama_sertifikat" type="text"
                                class="form-control custom-input @error('nama_sertifikat') is-invalid @enderror"
                                value="{{ old('nama_sertifikat') }}"
                                placeholder="Masukkan nama pelatihan/sertifikat anda">
                            @error('nama_sertifikat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control custom-input @error('deskripsi') is-invalid @enderror" rows="4"
                                placeholder="Tuliskan deskripsi mengenai pelatihan/sertifikat anda">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Penerbit</label>
                            <input name="penerbit" type="text"
                                class="form-control custom-input @error('penerbit') is-invalid @enderror"
                                value="{{ old('penerbit') }}" placeholder="Masukkan nama penerbit sertifikat">
                            @error('penerbit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-6 col-12">
                            <label>Tanggal Dikeluarkan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input name="tanggal_dikeluarkan" type="date"
                                    class="form-control custom-input @error('tanggal_dikeluarkan') is-invalid @enderror"
                                    value="{{ old('tanggal_dikeluarkan') }}">
                                @error('tanggal_dikeluarkan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Unggah Sertifikat</label>
                            <input id="sertifikat" name="sertifikat" type="file"
                                class="form-control custom-input @error('sertifikat') is-invalid @enderror">
                            @error('sertifikat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="text-warning small" style="font-size: 13px; font-weight:medium;">
                                (Tipe berkas : pdf | Max size : 2MB)</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke m-4">
                <button type="button" class="btn btn-primary" onclick="$('form', this.closest('.modal')).submit();"
                    style="border-radius: 15px; font-size: 14px">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    style="border-radius: 15px; font-size: 14px">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Rekrut Karyawan oleh Perusahaan -->
<div class="modal fade" id="modal-rekrut-karyawan" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Tambah
                    Jadwal Interview / Tes Lanjutan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('pengalaman.store') }}" class="needs-validation"
                    novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="nama_pekerjaan">Nama Pekerjaaan</label>
                            <input name="nama_pekerjaan" type="text"
                                class="form-control custom-input @error('nama_pekerjaan') is-invalid @enderror"
                                value="{{ old('nama_pekerjaan') }}"
                                placeholder="Masukkan nama pekerjaan yang pernah anda lakukan">
                            @error('nama_pekerjaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Nama Perusahaan</label>
                            <input name="nama_perusahaan" type="text"
                                class="form-control custom-input @error('nama_perusahaan') is-invalid @enderror"
                                value="{{ old('nama_perusahaan') }}"
                                placeholder="Masukkan nama perusahaan tempat anda bekerja">
                            @error('nama_perusahaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control custom-input @error('alamat') is-invalid @enderror" rows="4"
                                placeholder="Masukkan alamat perusahaan tempat anda bekerja">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-6 col-12">
                            <label>Tipe Pekerjaan</label>
                            <select class="form-control select2 custom-input @error('tipe') is-invalid @enderror"
                                name="tipe" id="tipe">
                                <option value="">Pilih Tipe Pekerjaan</option>
                                <option value="Fulltime">Fulltime</option>
                                <option value="Parttime">Part Time</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Internship">Internship</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="gaji">Gaji (Opsional)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <a>Rp</a>
                                    </div>
                                </div>
                                <input name="gaji" type="number" step="100000"
                                    class="form-control custom-input @error('gaji') is-invalid @enderror"
                                    value="{{ old('gaji') }}" placeholder="Masukkan gaji anda bekerja">
                                @error('gaji')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-6 col-12">
                            <label>Tanggal Mulai</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input name="tanggal_mulai" type="date"
                                    class="form-control custom-input @error('tanggal_mulai') is-invalid @enderror"
                                    value="{{ old('tanggal_mulai') }}">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-6 col-12">
                            <label>Tanggal Berakhir</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input name="tanggal_berakhir" type="date"
                                    class="form-control custom-input @error('tanggal_berakhir') is-invalid @enderror"
                                    value="{{ old('tanggal_berakhir') }}">
                                @error('tanggal_berakhir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke m-4">
                <button type="button" class="btn btn-primary" onclick="$('form', this.closest('.modal')).submit();"
                    style="border-radius: 15px; font-size: 14px">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    style="border-radius: 15px; font-size: 14px">Batal</button>
            </div>
        </div>
    </div>
</div>

@extends('landing-page.app')
@section('title', 'JobsKelasIndustri - Profile')
@section('main')
        <main class="bg-light">
            <h4 class="text-center my-4" style="text-align: center; font-weight: bold;">Data Diri</h4>
            <section class="centered-section-1">
                <div class="bg-primary-section card col-lg-10 col-md-10 col-sm-6 py-1 card-profile1">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="profile-widget-description m-4">
                                @if (Auth::user()->lulusan && Auth::user()->lulusan->foto != '')
                                    <img alt="image"
                                        src="{{ Storage::url(Auth::user()->lulusan->foto) }}"
                                        class="rounded-square profile-widget-picture img-fluid card-profile-img"
                                        style="width: 180px; height: 180px; border-radius:15px;">
                                @else
                                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                        class="rounded-square profile-widget-picture img-fluid card-profile-img"
                                        style="width: 180px; height: 180px; border-radius:15px;">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="profile-widget-description ml-4 mr-4 mt-4"
                                style="display: flex; align-items: center;">
                                <div class="flex-grow-1">
                                    <div class="profile-widget-name"
                                        style="font-weight: bold; font-size: 22px; color: #000000">
                                        {{ Auth::user()->name }}</div>
                                    <div class="profile-widget-name" style="font-weight: light; font-size: 16px;">
                                        {{ Auth::user()->email }}</div>
                                    <hr
                                        style="background-color:#ebebeb; height: 1px; border: none; width: 90%; float: left;">
                                </div>
                                <div class="d-flex justify-content-end" style="font-size: 2.00em;">
                                    <button class="btn btn-primary"
                                    style="background-color:#4ED373; font-size:13px; border-radius:15px;
                                    border-color:#4ED373;margin-right: 10px;">{!! Auth::user()->lulusan->status !!}</button>
                                    <a href="{{ route('profile-lulusan.edit', $lulusan) }}">
                                        <img class="img-fluid" style="width: 35px; height: 35px;"
                                            src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-11 ml-2 card-profile2">
                                @if (Auth::user()->lulusan && Auth::user()->lulusan->alamat != '')
                                    <div class="lulusan-widget-description mb-3"
                                        style="display: flex; align-items: center;">
                                        <img class="img-fluid" style="width: 25px; height: 25px;"
                                            src="{{ asset('assets/img/landing-page/location pin.svg') }}">&nbsp&nbsp<a>{{Auth::user()->lulusan->alamat}}</a>
                                    </div>
                                @endif
                                @if (Auth::user()->lulusan && Auth::user()->lulusan->resume != '')
                                    <div class="profile-widget-description lihat-resume" style=" ">
                                        {{-- <a href="#" class="btn btn-primary" id="skill-button" data-toggle="modal"
                                            data-target="#resumePreviewModal"
                                            data-pdf="{{ Auth::user()->profile ? Storage::url(Auth::user()->profile->resume) : '' }}"
                                            style="background-color:#eb9481; font-size:13px; border-radius:15px;">
                                            <i class="fas fa-eye"></i> Lihat Resume
                                        </a> --}}
                                        <a href="{{Storage::url(Auth::user()->lulusan->resume)}}"
                                            onclick="return openResume();" target="_blank" class="btn btn-primary"
                                            style="background-color:#eb9481; font-size:13px; border-radius:15px; border-color:#eb9481; margin-right: 10px;">
                                            Lihat Resume
                                        </a>
                                        <a href="{{Storage::url(Auth::user()->lulusan->resume)}}"
                                            onclick="return openResume();" target="_blank" class="btn btn-primary"
                                            style="background-color:#6777EF; font-size:13px; border-radius:15px; border-color:#6777EF;">
                                            Rekrut Karyawan
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-md-10 mx-auto mt-4 mb-0">
                <div>
                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <div class="text-left mb-4 mt-2 ml-2">
                                        <h5 class="card-title font-weight-bold d-block mx-2"
                                            style="color:#000000; font-size:18px;">
                                            Informasi Pribadi
                                        </h5>
                                        <hr>
                                        <div class="text-left mb-4 mt-2 ml-2">
                                            @if (Auth::user()->lulusan && Auth::user()->lulusan->tgl_lahir != '')
                                                <span style="color: #808080; font-size: 15px; font-weight:bold">Tanggal
                                                    Lahir&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:
                                                    <span
                                                        style="color: #000000; line-height: 2; font-weight:500">&nbsp&nbsp&nbsp&nbsp&nbsp{{ Auth::user()->lulusan->tgl_lahir}}</span>
                                                </span><br><br>
                                            @else
                                                <span style="color: #808080; font-size: 15px; font-weight:bold">Tanggal
                                                    Lahir :</span>
                                                <span
                                                    style="color: #000000; line-height: 2; font-weight:500"><br></span><br>
                                            @endif
                                            @if (Auth::user()->lulusan && Auth::user()->lulusan->jenis_kelamin != '')
                                                <span style="color: #808080; font-size: 15px; font-weight:bold">Jenis
                                                    Kelamin&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp&nbsp&nbsp
                                                    <span style="color: #000000; line-height: 2; font-weight:500">
                                                        @if (Auth::user()->lulusan->jenis_kelamin == 'P')
                                                            Perempuan
                                                        @elseif (Auth::user()->lulusan->jenis_kelamin == 'L')
                                                            Laki-laki
                                                        @else
                                                            {{ Auth::user()->lulusan->jenis_kelamin }}
                                                        @endif
                                                    </span>
                                                </span><br><br>
                                            @else
                                                <span style="color: #808080; font-size: 15px; font-weight:bold">Jenis
                                                    Kelamin :</span>
                                                <span
                                                    style="color: #000000; line-height: 2; font-weight:500"><br></span><br>
                                            @endif
                                            @if (Auth::user()->lulusan && Auth::user()->lulusan->no_hp != '')
                                                <span style="color: #808080; font-size: 15px; font-weight:bold">No
                                                    Telepon&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:<span
                                                        style="color: #000000; line-height: 2; font-weight:500">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{Auth::user()->lulusan->no_hp}}</span></span><br><br>
                                            @else
                                                <span style="color: #808080; font-size: 15px; font-weight:bold">No Telepon
                                                    :</span>
                                                <span
                                                    style="color: #000000; line-height: 2; font-weight:500"><br></span><br>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card border-primary" style="height: 345px; overflow-y: auto;">
                                <div class="card-body">
                                    <div class="text-left mb-4 mt-2 ml-2">
                                        <h5 class="card-title font-weight-bold d-block mx-2"
                                            style="color:#000000; font-size:18px;">
                                            Ringkasan Pribadi
                                        </h5>
                                        <hr>
                                        @if (Auth::user()->lulusan && Auth::user()->lulusan->ringkasan != '')
                                            <div class="text-left mb-4 mt-2 ml-2"
                                                style="color: #000000; line-height: 2; font-weight:500;">
                                                {!! Auth::user()->lulusan->ringkasan !!}</div>
                                        @else
                                            <div class="text-center mb-4 mt-2 ml-2"
                                                style="color: #808080; font-weight:lighter"><br>Belum Ada Ringkasan
                                                Tentang
                                                Diri Anda</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="centered-section container-garis my-0 garisPembatasProfile">
                <div class="lines my-0">
                    <div class="diamond"></div>
                    <div class="circle"></div>
                    <div class="diamond"></div>
                </div>
            </section>
            <section class="centered-section my-0">
                <div class="bg-primary-section card col-md-10 py-3 card-profile3">
                    <div class="profile-widget-description m-3"
                        style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                        <div class="flex-grow-1">
                            <div class="profile-widget-name" style="color:#6777ef;">Cerita Saya</div>
                        </div>
                        <div class="d-flex justify-content-end" style="font-size: 2.00em;" id="fluid">
                            <a href="#" data-toggle="modal" data-target="#modal-create-postingan">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="media mb-2">
                            @if (Auth::user()->lulusan && Auth::user()->lulusan->foto != '')
                                <img class="mr-3 rounded-circle" style="width: 50px; height: 50px;"
                                    src="{{ Storage::url(Auth::user()->lulusan->foto) }}"
                                    alt="Profile Image">
                            @else
                                <img class="mr-3 rounded-circle" style="width: 50px; height: 50px;"
                                    src="{{ asset('assets/img/avatar/avatar-1.png') }}">
                            @endif
                            <div class="form-group col-md-11" data-toggle="modal" data-target="#modal-create-postingan">
                                <input name="postingan" type="text" class="form-control custom-input"
                                    placeholder="Tambahkan Cerita Anda . . .">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="centered-section my-4">
                <div class="bg-primary-section card col-md-10 py-2 card-profile4 ">
                    <div class="profile-widget-description m-3" style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                        <div class="flex-grow-1">
                            <div class="profile-widget-name" style="color:#6777ef;">Cerita / Postingan</div>
                        </div>
                    </div>
                    @if ($postingans && count($postingans) > 0)
                        <div id="postingan-container">
                            <div class="col-md-12">
                                @foreach ($postingans as $post)
                                    <hr>
                                    <div class="font-italic mt-2 time" style="font-size: 14px;">
                                        {{ auth()->user()->name }}
                                        - {{ $post->timeAgo }}
                                    </div>
                                    <br>
                                    <div class="media mb-2 p-postingan">
                                        @if (!empty($post->media))
                                            <img class="mr-3 rounded p-img-media" width="10%;" src="{{ asset('storage/' . $post->media) }}">
                                            <div class="media-body col-md-9 p-postingan-konteks">
                                                {!! $post->konteks !!}
                                            </div>
                                            <div class="d-flex justify-content-end" style="" id="fluid">
                                                <a href="#" data-id="{{ $post->id }}" data-edit-url="{{ route('postingan.edit', ['postingan' => $post->id]) }}" class="modal-edit-trigger-postingan mt-2">
                                                    <img class="img-fluid" style="width: 30px; height: 30px;" src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                                </a>
                                                <form class="m-0" action="{{ route('profile-lulusan.destroy', ['profile_lulusan' => $post->id]) }}" method="POST" id="delete-post{{ $post->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-edu" onclick="confirmPost({{ $post->id }})">
                                                        <img class="img-fluid" style="width: 30px; height: 30px;" src="{{ asset('assets/img/landing-page/delete.svg') }}" alt="Hapus">
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="media-body col-md-10 mr-5">
                                                {!! $post->konteks !!}
                                            </div>
                                            <div class="d-flex justify-content-end ml-4" style="" id="fluid">
                                                <a href="#" data-id="{{ $post->id }}" data-edit-url="{{ route('postingan.edit', ['postingan' => $post->id]) }}" class="modal-edit-trigger-postingan mt-2">
                                                    <img class="img-fluid" style="width: 30px; height: 30px;" src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                                </a>
                                                <form class="m-0" action="{{ route('profile-lulusan.destroy', ['profile_lulusan' => $post->id]) }}" method="POST" id="delete-post{{ $post->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-edu" onclick="confirmPost({{ $post->id }})">
                                                        <img class="img-fluid" style="width: 30px; height: 30px;" src="{{ asset('assets/img/landing-page/delete.svg') }}" alt="Hapus">
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-right my-4 mr-5">
                            <a href="{{ route('postingan.index') }}" class="" style="font-size: 16px;">
                                Lihat Lainnya . . .
                            </a>
                        </div>
                    @else
                        <div class="col-md-12 text-center my-4"><br><br>
                            <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                            <p class="mt-1 text-not">Belum Ada Postingan Anda</p>
                        </div>
                    @endif
                </div>
            </section>

            <section class="centered-section my-4">
                <div class="bg-primary-section card col-md-10 py-1 card-profile5">
                    <div class="profile-widget-description m-3"
                        style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                        <div class="flex-grow-1">
                            <div class="profile-widget-name" style="color:#6777ef;">Keahlian</div>
                        </div>
                        <div class="d-flex justify-content-end" style="font-size: 2.00em;" id="fluid">
                            <a href="{{ url('/profile/keahlian/edit') }}">
                                <img class="img-fluid" style="width: 35px; height: 35px;"
                                    src="{{ asset('assets/img/landing-page/Plus.svg') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="centered-section my-4">
                <div class="bg-primary-section card col-md-10 py-1 card-profile6">
                    <div class="profile-widget-description m-3"
                        style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                        <div class="flex-grow-1">
                            <div class="profile-widget-name" style="color:#6777ef;">Pendidikan</div>
                        </div>
                        <div class="d-flex justify-content-end" style="font-size: 2.00em;" id="fluid">
                            <a href="#" data-toggle="modal" data-target="#modal-create">
                                <img class="img-fluid" style="width: 35px; height: 35px;"
                                    src="{{ asset('assets/img/landing-page/Plus.svg') }}">
                            </a>
                        </div>
                    </div>
                    @if (count($pendidikans) > 0)
                        <div id="pendidikan-container" class="pendidikancardprofile">
                            @foreach ($pendidikans as $item)
                                <hr>
                                <div class="mr-5 ml-5">
                                    <div class="profile-widget-description m-3"
                                        style="font-weight: bold; font-size: 16px; display: flex; align-items: center;">
                                        <div class="flex-grow-1">
                                            <div class="profile-widget-name"
                                                style="font-weight: bold; font-size: 17px; display: flex; align-items: center;">
                                                {{ $item->institusi }}
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center"
                                            style="font-size: 2.00em;" id="fluid">
                                            <a href="#" data-id="{{ $item->id }}"
                                                data-edit-url="{{ route('pendidikan.edit', ['pendidikan' => $item->id]) }}"
                                                class="modal-edit-trigger-pendidikan">
                                                <img class="img-fluid" style="width: 30px; height: 30px;"
                                                    src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                            </a>
                                            <form class="m-0"
                                                action="{{ route('pendidikan.destroy', ['pendidikan' => $item->id]) }}"
                                                method="POST" id="delete-edu{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-edu"
                                                    onclick="confirmDelete({{ $item->id }})">
                                                    <img class="img-fluid" style="width: 30px; height: 30px;"
                                                        src="{{ asset('assets/img/landing-page/delete.svg') }}"
                                                        alt="Hapus">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="list-unstyled ml-2">
                                            <li class="mb-2"><img class="img-fluid"
                                                    src="{{ asset('assets/img/landing-page/Graduation Cap (2).svg') }}">&nbsp&nbsp&nbsp&nbsp
                                                {{ $item->gelar }} - {{ $item->jurusan }}
                                            </li>
                                            <li class="mb-2"><img class="img-fluid"
                                                    src="{{ asset('assets/img/landing-page/Award.svg') }}">&nbsp&nbsp&nbsp
                                                {{ $item->prestasi }}
                                            </li>
                                            <li class="mb-2"><img class="img-fluid"
                                                    src="{{ asset('assets/img/landing-page/timeline.svg') }}">&nbsp&nbsp&nbsp&nbsp
                                                {{ $item->ipk }}
                                            </li>
                                            <li class="mb-2"><img class="img-fluid"
                                                    src="{{ asset('assets/img/landing-page/Time.svg') }}">&nbsp&nbsp&nbsp&nbsp
                                                {{ $item->tahun_mulai }} - {{ $item->tahun_berakhir }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-right mt-4 mr-4">
                            <button id="load-more" class="btn btn-more mb-3"
                                data-page="{{ $pendidikans->currentPage() }}">Muat Lebih Banyak . . .</button>
                        </div>
                    @else
                        <div class="col-md-12 text-center my-4"><br><br>
                            <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                            <p class="mt-1 text-not">Data Pendidikan Masih Kosong</p>
                        </div>
                    @endif
                </div>
            </section>
            <section class="centered-section my-4">
                <div class="bg-primary-section card col-md-10 py-1 card-profile7">
                    <div class="profile-widget-description m-3"
                        style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                        <div class="flex-grow-1">
                            <div class="profile-widget-name" style="color:#6777ef;">Pengalaman Kerja</div>
                        </div>
                        <div class="d-flex justify-content-end" style="font-size: 2.00em;" id="fluid">
                            <a href="#" data-toggle="modal" data-target="#modal-create-pengalaman">
                                <img class="img-fluid" style="width: 35px; height: 35px;"
                                    src="{{ asset('assets/img/landing-page/Plus.svg') }}">
                            </a>
                        </div>
                    </div>
                    @if (count($pengalamans) > 0)
                        <div id="pengalaman-container" class="pendidikancardprofile">
                            @foreach ($pengalamans as $pl)
                                <hr>
                                <div class="mr-5 ml-5">
                                    <div class="profile-widget-description m-3"
                                        style="font-weight: bold; font-size: 16px; display: flex; align-items: center;">
                                        <div class="flex-grow-1">
                                            <div class="profile-widget-name"
                                                style="font-weight: bold; font-size: 17px; display: flex; align-items: center;">
                                                {{ $pl->nama_pekerjaan }}
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center"
                                            style="font-size: 2.00em;" id="fluid">
                                            <a href="#" data-id="{{ $pl->id }}"
                                                data-edit-url="{{ route('pengalaman.edit', ['pengalaman' => $pl->id]) }}"
                                                class="modal-edit-trigger-pengalaman">
                                                <img class="img-fluid" style="width: 30px; height: 30px;"
                                                    src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                            </a>
                                            <form class="m-0"
                                                action="{{ route('pengalaman.destroy', ['pengalaman' => $pl->id]) }}"
                                                method="POST" id="delete-pl{{ $pl->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-edu"
                                                    onclick="confirmPl({{ $pl->id }})">
                                                    <img class="img-fluid" style="width: 30px; height: 30px;"
                                                        src="{{ asset('assets/img/landing-page/delete.svg') }}"
                                                        alt="Hapus">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="flex-grow-1 mb-2">
                                            <div class="profile-widget-name"
                                                style="font-size: 16px; display: flex; align-items: center;">
                                                {{ $pl->nama_perusahaan }} | {{ $pl->alamat }}
                                            </div>
                                        </div>
                                        <ul class="list-unstyled ml-2">
                                            <li class="mb-2"><img class="img-fluid"
                                                    src="{{ asset('assets/img/landing-page/Hourglass.svg') }}">&nbsp&nbsp&nbsp{{ $pl->tipe }}
                                            </li>
                                            <li class="mb-2"><img class="img-fluid"
                                                    src="{{ asset('assets/img/landing-page/money-2.svg') }}">&nbsp&nbsp&nbspIDR
                                                {{ $pl->gaji }}
                                            </li>
                                            <li class="mb-2"><img class="img-fluid"
                                                    src="{{ asset('assets/img/landing-page/Time.svg') }}">&nbsp&nbsp&nbsp{{ $pl->tanggal_mulai }}
                                                - {{ $pl->tanggal_berakhir }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-right mt-4 mr-4">
                            <button id="load-more-pengalaman" class="btn btn-more mb-3"
                                data-page="{{ $pengalamans->currentPage() }}">Muat Lebih Banyak . . .</button>
                        </div>
                    @else
                        <div class="col-md-12 text-center my-4"><br><br>
                            <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                            <p class="mt-1 text-not">Data Pengalaman Kerja Masih Kosong</p>
                        </div>
                    @endif
                </div>
            </section>
            <section class="centered-section my-4">
                <div class="bg-primary-section card col-md-10 py-1 card-profile8">
                    <div class="profile-widget-description m-3"
                        style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                        <div class="flex-grow-1">
                            <div class="profile-widget-name" style="color:#6777ef;">Pelatihan / Sertifikat</div>
                        </div>
                        <div class="d-flex justify-content-end" style="font-size: 2.00em;" id="fluid">
                            <a href="#" data-toggle="modal" data-target="#modal-create-pelatihan">
                                <img class="img-fluid" style="width: 35px; height: 35px;"
                                    src="{{ asset('assets/img/landing-page/Plus.svg') }}">
                            </a>
                        </div>
                    </div>
                    @if (count($pelatihans) > 0)
                        <div id="pelatihan-container" class="pendidikancardprofile">
                            @foreach ($pelatihans as $lat)
                                <hr>
                                <div class="mr-5 ml-5">
                                    <div class="profile-widget-description m-3"
                                        style="font-weight: bold; font-size: 16px; display: flex; align-items: center;">
                                        <div class="flex-grow-1">
                                            <div class="profile-widget-name"
                                                style="font-weight: bold; font-size: 17px; display: flex; align-items: center;">
                                                {{ $lat->nama_sertifikat }}
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center"
                                            style="font-size: 2.00em;" id="fluid">
                                            <a href="#" data-id="{{ $lat->id }}"
                                                data-edit-url="{{ route('pelatihan.edit', ['pelatihan' => $lat->id]) }}"
                                                class="modal-edit-trigger-pelatihan">
                                                <img class="img-fluid" style="width: 30px; height: 30px;"
                                                    src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                            </a>
                                            <form class="m-0"
                                                action="{{ route('pelatihan.destroy', ['pelatihan' => $lat->id]) }}"
                                                method="POST" id="delete-lat{{ $lat->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-edu"
                                                    onclick="confirmLat({{ $lat->id }})">
                                                    <img class="img-fluid" style="width: 30px; height: 30px;"
                                                        src="{{ asset('assets/img/landing-page/delete.svg') }}"
                                                        alt="Hapus">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="flex-grow-1 mb-2">
                                            <div class="profile-widget-name"
                                                style="font-size: 16px; display: flex; align-items: center;">
                                                {{ $lat->deskripsi }}
                                            </div>
                                        </div>
                                        <ul class="list-unstyled ml-2">
                                            <li class="mb-2"><img class="img-fluid"
                                                    src="{{ asset('assets/img/landing-page/Office Building-2.svg') }}">&nbsp&nbsp&nbsp
                                                {{ $lat->penerbit }}
                                            </li>
                                            <li class="mb-2"><img class="img-fluid"
                                                    src="{{ asset('assets/img/landing-page/Time.svg') }}">&nbsp&nbsp&nbsp&nbsp&nbsp
                                                {{ $lat->tanggal_dikeluarkan }}
                                            </li>
                                        </ul>
                                        @if (!empty($lat->sertifikat))
                                            <div style="font-size: 16px;">
                                                <a href="{{ asset('storage/' . $lat->sertifikat) }}" target="_blank">
                                                    <p class="">Lihat Sertifikat</p>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-right mt-4 mr-4">
                            <button id="load-more-pelatihan" class="btn btn-more mb-3"
                                data-page="{{ $pelatihans->currentPage() }}">Muat Lebih Banyak . . .</button>
                        </div>
                    @else
                        <div class="col-md-12 text-center my-4"><br><br>
                            <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                            <p class="mt-1 text-not">Data Pelatihan/Sertifikat Masih Kosong</p>
                        </div>
                    @endif
                </div>
            </section>
        </main>

    <!-- Modal Edit Pendidikan -->
    <div id="modal-edit-pendidikan" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mx-auto" role="document">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header m-4">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Edit
                            Pendidikan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="modal-edit-pendidikan-form" class="needs-validation" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label for="gelar">Gelar</label>
                                    <select class="form-control select2 custom-input @error('gelar') is-invalid @enderror"
                                        name="gelar" id="gelar">
                                        <option value="">Pilih Gelar</option>
                                        <option value="SMA/SMK">SMA/SMK</option>
                                        <option value="D3">Diploma III</option>
                                        <option value="D4">Diploma IV</option>
                                        <option value="S1">Sarjana</option>
                                        <option value="S2">Magister</option>
                                    </select>
                                    @error('gelar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Nama Institusi</label>
                                    <input name="institusi" type="text"
                                        class="form-control custom-input @error('institusi') is-invalid @enderror"
                                        value="{{ old('institusi') }}" placeholder="Masukkan nama institusi anda">
                                    @error('institusi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Jurusan</label>
                                    <input name="jurusan" type="text"
                                        class="form-control custom-input @error('jurusan') is-invalid @enderror"
                                        value="{{ old('jurusan') }}" placeholder="Masukkan jurusan anda">
                                    @error('jurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Prestasi Akademik (Opsional)</label>
                                    <textarea name="prestasi" class="form-control custom-input @error('prestasi') is-invalid @enderror" rows="4"
                                        placeholder="Masukkan prestasi akademik yang anda miliki">{{ old('prestasi') }}</textarea>
                                    @error('prestasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="col-md-12 mb-1 form-group">
                                    <label for="tahun">Periode Waktu</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <select
                                        class="form-control select2 custom-input @error('tahun_mulai') is-invalid @enderror"
                                        name="tahun_mulai" id="tahun_mulai">
                                        <option value="">Pilih Tahun</option>
                                        @for ($tahun = 2017; $tahun <= 2029; $tahun++)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endfor
                                    </select>
                                    @error('tahun_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <span> - </span>
                                <div class="col-md-4 form-group">
                                    <select
                                        class="form-control select2 custom-input @error('tahun_berakhir') is-invalid @enderror"
                                        name="tahun_berakhir" id="tahun_berakhir">
                                        <option value="">Pilih Tahun</option>
                                        @for ($tahun = 2017; $tahun <= 2030; $tahun++)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endfor
                                        <option value="Saat Ini">Saat Ini</option>
                                    </select>
                                    @error('tahun_berakhir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-1 form-group">
                                    <label for="ipk">IPK (Opsional)</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input name="ipk" type="number" step="0.01"
                                        class="form-control custom-input @error('ipk') is-invalid @enderror"
                                        value="{{ old('ipk') }}" placeholder="Contoh : 3,75 / 4.00">
                                    @error('ipk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-whitesmoke m-4">
                        <button type="button" class="btn btn-primary" id="modal-save-button-pendidikan"
                            style="border-radius: 15px; font-size: 14px">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="border-radius: 15px; font-size: 14px">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pengalaman -->
    <div id="modal-edit-pengalaman" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mx-auto" role="document">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header m-4">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Edit
                            Pengalaman Kerja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="modal-edit-pengalaman-form" class="needs-validation" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label for="nama_pekerjaan">Nama Pekerjaaan</label>
                                    <input name="nama_pekerjaan" type="text"
                                        class="form-control custom-input @error('nama_pekerjaan') is-invalid @enderror"
                                        value="{{ old('nama_pekerjaan') }}"
                                        placeholder="Masukkan nama pekerjaan yang pernah anda lakukan">
                                    @error('nama_pekerjaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Nama Perusahaan</label>
                                    <input name="nama_perusahaan" type="text"
                                        class="form-control custom-input @error('nama_perusahaan') is-invalid @enderror"
                                        value="{{ old('nama_perusahaan') }}"
                                        placeholder="Masukkan nama perusahaan tempat anda bekerja">
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control custom-input @error('alamat') is-invalid @enderror" rows="4"
                                        placeholder="Masukkan alamat perusahaan tempat anda bekerja">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-6 col-12">
                                    <label>Tipe Pekerjaan</label>
                                    <select class="form-control select2 custom-input @error('tipe') is-invalid @enderror"
                                        name="tipe" id="tipe">
                                        <option value="">Pilih Tipe Pekerjaan</option>
                                        <option value="Fulltime">Fulltime</option>
                                        <option value="Parttime">Part Time</option>
                                        <option value="Freelance">Freelance</option>
                                        <option value="Internship">Internship</option>
                                    </select>
                                    @error('tipe')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="gaji">Gaji (Opsional)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text custom-input">
                                                <a>Rp</a>
                                            </div>
                                        </div>
                                        <input name="gaji" type="number" step="100000"
                                            class="form-control custom-input @error('gaji') is-invalid @enderror"
                                            value="{{ old('gaji') }}" placeholder="Masukkan gaji anda bekerja">
                                        @error('gaji')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-6 col-12">
                                    <label>Tanggal Mulai</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text custom-input">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input name="tanggal_mulai" type="date"
                                            class="form-control custom-input @error('tanggal_mulai') is-invalid @enderror"
                                            value="{{ old('tanggal_mulai') }}">
                                        @error('tanggal_mulai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-6 col-12">
                                    <label>Tanggal Berakhir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text custom-input">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input name="tanggal_berakhir" type="date"
                                            class="form-control custom-input @error('tanggal_berakhir') is-invalid @enderror"
                                            value="{{ old('tanggal_berakhir') }}">
                                        @error('tanggal_berakhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-whitesmoke m-4">
                        <button type="button" class="btn btn-primary" id="modal-save-button-pengalaman"
                            style="border-radius: 15px; font-size: 14px">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="border-radius: 15px; font-size: 14px">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pelatihan -->
    <div id="modal-edit-pelatihan" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mx-auto" role="document">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header m-4">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Edit
                            Pelatihan Kerja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="modal-edit-pelatihan-form" class="needs-validation" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label for="nama_sertifikat">Nama</label>
                                    <input name="nama_sertifikat" type="text"
                                        class="form-control custom-input @error('nama_sertifikat') is-invalid @enderror"
                                        value="{{ old('nama_sertifikat') }}"
                                        placeholder="Masukkan nama pelatihan/sertifikat anda">
                                    @error('nama_sertifikat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control custom-input @error('deskripsi') is-invalid @enderror"
                                        rows="4" placeholder="Tuliskan deskripsi mengenai pelatihan/sertifikat anda">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Penerbit</label>
                                    <input name="penerbit" type="text"
                                        class="form-control custom-input @error('penerbit') is-invalid @enderror"
                                        value="{{ old('penerbit') }}" placeholder="Masukkan nama penerbit sertifikat">
                                    @error('penerbit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-6 col-12">
                                    <label>Tanggal Dikeluarkan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text custom-input">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input name="tanggal_dikeluarkan" type="date"
                                            class="form-control custom-input @error('tanggal_dikeluarkan') is-invalid @enderror"
                                            value="{{ old('tanggal_dikeluarkan') }}">
                                        @error('tanggal_dikeluarkan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Unggah Sertifikat</label>
                                    <input id="sertifikat" name="sertifikat" type="file"
                                        class="form-control custom-input @error('sertifikat') is-invalid @enderror">
                                    @error('sertifikat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="text-warning small" style="font-size: 13px; font-weight:medium;">
                                        (Tipe berkas : pdf | Max size : 2MB)</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-whitesmoke m-4">
                        <button type="button" class="btn btn-primary" id="modal-save-button-pelatihan"
                            style="border-radius: 15px; font-size: 14px">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="border-radius: 15px; font-size: 14px">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Postingan -->
    <div id="modal-edit-postingan" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mx-auto" role="document">
            <div class="modal-content">
                <div class="modal-header m-4">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Edit
                        Postingan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="modal-edit-postingan-form" class="needs-validation" novalidate=""
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row ml-4 mr-4">
                            <div class="form-group col-md-12 col-12">
                                <div class="card-body">
                                    <div class="media mb-4">
                                        @if (Auth::user()->profile && Auth::user()->profile->foto != '')
                                            <img class="mr-3 rounded-circle" style="width: 50px; height: 50px;"
                                                src="{{ Auth::user()->profile ? Storage::url(Auth::user()->profile->foto) : '' }}"
                                                alt="Profile Image">
                                        @else
                                            <img class="mr-3 rounded-circle" style="width: 50px; height: 50px;"
                                                src="{{ asset('assets/img/avatar/avatar-1.png') }}">
                                        @endif
                                        <div class="media-body">
                                            <h5 class="mt-0" style="font-weight: bold;">{{ auth()->user()->name }}
                                            </h5>
                                            <!-- Informasi tambahan mengenai user, seperti bio atau status -->
                                            <p>{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="konteks">Konten Postingan</label>
                                        <textarea name="konteks" id="konteks" class="form-control summernote @error('konteks') is-invalid @enderror"
                                            required rows="5" cols="50">
                                            @isset($post)
{!! $post->konteks !!}
@endisset
                                        </textarea>
                                        @if ($errors->has('konteks') && isset($post))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="media mb-4">
                                        <!-- Tampilkan media yang ingin diedit -->
                                        <img id="media-preview" class="mr-3 rounded p-m-media" width="100%">
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <label for="mediaUploadButton" style="cursor: pointer;">
                                                    <img class="img-fluid"
                                                        src="{{ asset('assets/img/Gallery Add.svg') }}">
                                                    &nbsp;&nbsp;&nbsp; Ganti
                                                </label>
                                                <input type="file" id="mediaUploadButton" class="d-none"
                                                    accept="image/*">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke m-4">
                    <button type="button" class="btn btn-primary" id="modal-save-button-postingan"
                        style="border-radius: 15px; font-size: 14px">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="border-radius: 15px; font-size: 14px">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(itemId) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-confirm',
                    cancelButton: 'btn btn-cancel',
                },
                buttonsStyling: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-edu' + itemId).submit();
                }
            });
        }
    </script>
    <script>
        function confirmPl(itemId) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-confirm',
                    cancelButton: 'btn btn-cancel',
                },
                buttonsStyling: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-pl' + itemId).submit();
                }
            });
        }
    </script>
    <script>
        function confirmLat(itemId) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-confirm',
                    cancelButton: 'btn btn-cancel',
                },
                buttonsStyling: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-lat' + itemId).submit();
                }
            });
        }
    </script>
    <script>
        function confirmPost(itemId) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-confirm',
                    cancelButton: 'btn btn-cancel',
                },
                buttonsStyling: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-post' + itemId).submit();
                }
            });
        }
    </script>
    <script>
        @if (session('success') === 'success-delete')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil dihapus.',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    <script>
        @if (session('success') === 'success-create')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil ditambahkan.',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    <script>
        @if (session('success-update') === 'success-update')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil diperbarui.',
                confirmButtonText: 'OK'
            });
        @endif
        @if (session('error-update') === 'error-update')
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat memperbarui data.',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection

@push('customScript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
@endpush

@push('customScript')
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ asset('assets/js/summernote-bs4.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            var editModal = $('#modal-edit-pendidikan');

            function showError(field, message) {
                var inputField = editModal.find('[name="' + field + '"]');
                inputField.addClass('is-invalid');
                inputField.closest('.form-group').find('.invalid-feedback').text(message)
            }

            // Menambahkan aturan kustom untuk memvalidasi tahun mulai dan tahun berakhir
            $.validator.addMethod("tahunBerakhirLebihBesar", function(value, element) {
                var tahunMulai = parseInt($('#modal-edit-pendidikan select[name="tahun_mulai"]').val(), 10);
                var tahunBerakhir = parseInt($('#modal-edit-pendidikan select[name="tahun_berakhir"]')
                    .val(), 10);
                return tahunMulai <= tahunBerakhir;
            }, "Tahun mulai tidak boleh melebihi tahun berakhir.");

            // Validasi form
            $("#modal-edit-pendidikan-form").validate({
                rules: {
                    gelar: {
                        required: true
                    },
                    institusi: {
                        required: true,
                        maxlength: 255
                    },
                    jurusan: {
                        required: true,
                        maxlength: 255
                    },
                    prestasi: {
                        maxlength: 225
                    },
                    tahun_mulai: {
                        required: true,
                        tahunBerakhirLebihBesar: true // Menggunakan aturan kustom
                    },
                    tahun_berakhir: {
                        required: true
                    },
                    ipk: {
                        range: [0, 4],
                    }
                },
                messages: {
                    gelar: {
                        required: "Gelar Tidak Boleh Kosong"
                    },
                    institusi: {
                        required: "Institusi Tidak Boleh Kosong",
                        maxlength: "Nama Institusi Melebihi Batas Maksimal"
                    },
                    jurusan: {
                        required: "Jurusan Tidak Boleh Kosong",
                        maxlength: "Nama Jurusan Melebihi Batas Maksimal"
                    },
                    prestasi: {
                        maxlength: "Inputan Prestasi Akademik Melebihi Batas Maksimal"
                    },
                    tahun_mulai: {
                        required: "Tahun Mulai Tidak Boleh Kosong"
                    },
                    tahun_berakhir: {
                        required: "Tahun Berakhir Tidak Boleh Kosong"
                    },
                    ipk: {
                        range: "Inputan IPK harus berada dalam rentang 0 hingga 4"

                    }
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').next('.invalid-feedback').show();
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass('is-invalid').next('.invalid-feedback').hide();
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    formData.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                editModal.modal('hide');
                                location.reload();
                            } else {
                                alert('Error! ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Terjadi error ketika update data!');
                        }
                    });
                }
            });

            function openEditModal(itemId) {
                var editUrl = "{{ route('pendidikan.edit', ['pendidikan' => '_id']) }}".replace('_id', itemId);
                var updateUrl = "{{ route('pendidikan.update', ['pendidikan' => '_id']) }}".replace('_id',
                    itemId);

                $('#modal-edit-pendidikan-form').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#modal-edit-pendidikan select[name="gelar"]').val(data.gelar).change();
                        $('#modal-edit-pendidikan input[name="institusi"]').val(data.institusi);
                        $('#modal-edit-pendidikan input[name="jurusan"]').val(data.jurusan);
                        $('#modal-edit-pendidikan textarea[name="prestasi"]').val(data.prestasi);
                        $('#modal-edit-pendidikan select[name="tahun_mulai"]').val(data.tahun_mulai)
                            .change();
                        $('#modal-edit-pendidikan select[name="tahun_berakhir"]').val(data
                            .tahun_berakhir).change();
                        $('#modal-edit-pendidikan input[name="ipk"]').val(data.ipk);

                        editModal.modal('show');
                    }
                });
            }

            $('#pendidikan-container').on('click', '.modal-edit-trigger-pendidikan', function() {
                var itemId = $(this).data('id');
                openEditModal(itemId);
            });

            $('#modal-save-button-pendidikan').on('click', function() {
                var form = $('#modal-edit-pendidikan-form');

                // Hanya melakukan submit jika formulir valid
                if (form.valid()) {
                    var formData = new FormData(form[0]);
                    formData.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                editModal.modal('hide');
                                location.reload();
                            } else {
                                alert('Error! ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Terjadi error ketika update data!');
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var editModal = $('#modal-edit-pengalaman');

            function showError(field, message) {
                var inputField = editModal.find('[name="' + field + '"]');
                inputField.addClass('is-invalid');
                inputField.closest('.form-group').find('.invalid-feedback').text(message);
            }

            // Validasi custom
            $.validator.addMethod("greaterThanStartDate", function(value, element) {
                var startDate = $('#modal-edit-pengalaman input[name="tanggal_mulai"]').val();
                return new Date(value) > new Date(startDate);
            }, "Tanggal berakhir harus setelah tanggal mulai .");

            // Validasi form
            $("#modal-edit-pengalaman-form").validate({
                rules: {
                    nama_pekerjaan: {
                        required: true,
                        maxlength: 255
                    },
                    nama_perusahaan: {
                        required: true,
                        maxlength: 255
                    },
                    alamat: {
                        maxlength: 2000
                    },
                    tipe: {
                        required: true,
                    },
                    gaji: {
                        maxlength: 8
                    },
                    tanggal_mulai: {
                        required: true,
                        date: true
                    },
                    tanggal_berakhir: {
                        required: true,
                        date: true,
                        greaterThanStartDate: true
                    }
                },
                messages: {
                    nama_pekerjaan: {
                        required: "Nama Pekerjaan Tidak Boleh Kosong",
                        maxlength: "Inputan Nama Pekerjaan Melebihi Batas Maksimal"
                    },
                    nama_perusahaan: {
                        required: "Nama Perusahaan Tidak Boleh Kosong",
                        maxlength: "Inputan Nama Perusahaan Melebihi Batas Maksimal"
                    },
                    alamat: {
                        maxlength: "Inputan Alamat Melebihi Batas Maksimal"
                    },
                    tipe: {
                        required: "Tipe Tidak Boleh Kosong"
                    },
                    gaji: {
                        maxlength: "Inputan Gaji Maximal Puluhan Juta. Contoh Masukkan 50000000 tanpa titik/koma"
                    },
                    tanggal_mulai: {
                        required: "Tanggal mulai harus diisi.",
                        date: "Format tanggal tidak valid."
                    },
                    tanggal_berakhir: {
                        required: "Tanggal berakhir harus diisi.",
                        date: "Format tanggal tidak valid.",
                        greaterThanStartDate: "Tanggal berakhir harus setelah tanggal mulai."
                    }
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').next('.invalid-feedback').show();
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass('is-invalid').next('.invalid-feedback').hide();
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    formData.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                editModal.modal('hide');
                                location.reload();
                            } else {
                                alert('Error! ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Terjadi error ketika update data!');
                        }
                    });
                }
            });

            function openEditModal(plId) {
                var editUrl = "{{ route('pengalaman.edit', ['pengalaman' => '_id']) }}".replace('_id', plId);
                var updateUrl = "{{ route('pengalaman.update', ['pengalaman' => '_id']) }}".replace('_id',
                    plId);

                $('#modal-edit-pengalaman-form').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#modal-edit-pengalaman input[name="nama_pekerjaan"]').val(data
                            .nama_pekerjaan);
                        $('#modal-edit-pengalaman input[name="nama_perusahaan"]').val(data
                            .nama_perusahaan);
                        $('#modal-edit-pengalaman textarea[name="alamat"]').val(data.alamat);
                        $('#modal-edit-pengalaman select[name="tipe"]').val(data.tipe).change();
                        $('#modal-edit-pengalaman input[name="gaji"]').val(data.gaji);
                        $('#modal-edit-pengalaman input[name="tanggal_mulai"]').val(data
                            .tanggal_mulai);
                        $('#modal-edit-pengalaman input[name="tanggal_berakhir"]').val(data
                            .tanggal_berakhir);

                        editModal.modal('show');
                    }
                });
            }

            $('#pengalaman-container').on('click', '.modal-edit-trigger-pengalaman', function() {
                var plId = $(this).data('id');
                openEditModal(plId);
            });

            $('#modal-save-button-pengalaman').on('click', function() {
                var form = $('#modal-edit-pengalaman-form');

                // Hanya melakukan submit jika formulir valid
                if (form.valid()) {
                    var formData = new FormData(form[0]);
                    formData.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                editModal.modal('hide');
                                location.reload();
                            } else {
                                alert('Error! ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Error while updating data!');
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var editModal = $('#modal-edit-pelatihan');

            function showError(field, message) {
                var inputField = editModal.find('[name="' + field + '"]');
                inputField.addClass('is-invalid');
                inputField.closest('.form-group').find('.invalid-feedback').text(message);
            }

            // Validasi form
            $("#modal-edit-pelatihan-form").validate({
                rules: {
                    nama_sertifikat: {
                        required: true,
                        maxlength: 255
                    },
                    deskripsi: {
                        maxlength: 2000
                    },
                    penerbit: {
                        required: true,
                        maxlength: 255
                    },
                    tanggal_dikeluarkan: {
                        required: true
                    },
                    sertifikat: {
                        required: true
                    },
                },
                messages: {
                    nama_sertifikat: {
                        required: "Nama Sertifikat Tidak Boleh Kosong",
                        maxlength: "Nama Sertifikat Melebihi Batas Maksimal"
                    },
                    deskripsi: {
                        maxlength: "Inputan Deskripsi Melebihi Batas Maksimal"
                    },
                    penerbit: {
                        required: "Nama Penerbit Tidak Boleh Kosong",
                        maxlength: "Nama Penerbit Melebihi Batas Maksimal"
                    },
                    tanggal_dikeluarkan: {
                        required: "Tanggal Dikeluarkan Tidak Boleh Kosong"
                    },
                    sertifikat: {
                        required: "Sertifikat Tidak Boleh Kosong, Dokumen Hanya Mendukung Format pdf"
                    }
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').next('.invalid-feedback').show();
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass('is-invalid').next('.invalid-feedback').hide();
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    formData.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                editModal.modal('hide');
                                location.reload();
                            } else {
                                alert('Error! ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Terjadi error ketika update data!');
                        }
                    });
                }
            });

            function openEditModal(latId) {
                var editUrl = "{{ route('pelatihan.edit', ['pelatihan' => '_id']) }}".replace('_id', latId);
                var updateUrl = "{{ route('pelatihan.update', ['pelatihan' => '_id']) }}".replace('_id', latId);

                $('#modal-edit-pelatihan-form').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#modal-edit-pelatihan input[name="nama_sertifikat"]').val(data
                            .nama_sertifikat);
                        $('#modal-edit-pelatihan textarea[name="deskripsi"]').val(data.deskripsi);
                        $('#modal-edit-pelatihan input[name="penerbit"]').val(data.penerbit);
                        $('#modal-edit-pelatihan input[name="tanggal_dikeluarkan"]').val(data
                            .tanggal_dikeluarkan);
                        // $('#modal-edit-pelatihan input[name="sertifikat"]').val(data.sertifikat);

                        editModal.modal('show');
                    }
                });
            }

            $('#pelatihan-container').on('click', '.modal-edit-trigger-pelatihan', function() {
                var latId = $(this).data('id');
                openEditModal(latId);
            });

            $('#modal-save-button-pelatihan').on('click', function() {
                var form = $('#modal-edit-pelatihan-form');

                // Hanya melakukan submit jika formulir valid
                if (form.valid()) {
                    var formData = new FormData(form[0]);
                    formData.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                editModal.modal('hide');
                                location.reload();
                            } else {
                                alert('Error! ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Error while updating data!');
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var editModal = $('#modal-edit-postingan');
            var originalKonteks = ''; // Menyimpan konteks asli

            // Menangani perubahan pada input file untuk pengunggahan gambar
            $('#mediaUploadButton').on('change', function(event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#media-preview').attr('src', e.target.result);
                        $('#media-preview').show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#media-preview').removeAttr('src');
                    $('#media-preview').hide();
                }
            });

            function openEditModal(postId) {
                var editUrl = "{{ route('postingan.edit', ['postingan' => '_id']) }}".replace('_id', postId);
                var updateUrl = "{{ route('postingan.update', ['postingan' => '_id']) }}".replace('_id', postId);

                $('#modal-edit-postingan-form').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        originalKonteks = data.konteks; // Simpan konteks asli
                        $('#modal-edit-postingan textarea[name="konteks"]').summernote('code', data
                            .konteks); // Set konteks menggunakan Summernote
                        $('#modal-edit-postingan input[name="media"]').val(data.media);
                        $('#media-preview').attr('src', '{{ asset('storage/') }}/' + data.media);
                        editModal.modal('show');
                    }
                });
            }

            $('#postingan-container').on('click', '.modal-edit-trigger-postingan', function() {
                var postId = $(this).data('id');
                openEditModal(postId);
            });

            $('#modal-save-button-postingan').on('click', function() {
                var form = $('#modal-edit-postingan-form');
                var formData = new FormData(form[0]);
                formData.append('_token', "{{ csrf_token() }}");

                var mediaFile = $('#mediaUploadButton')[0].files[0];
                if (mediaFile) {
                    formData.append('media', mediaFile);
                }

                // Get the edited content from Summernote
                var editedKonteks = $('#modal-edit-postingan textarea[name="konteks"]').summernote('code');
                formData.set('konteks', editedKonteks); // Set edited content

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response); // For debugging
                        if (response.success) {
                            editModal.modal('hide');
                            location.reload();
                        } else {
                            alert('Error! ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // For debugging
                        var err = JSON.parse(xhr.responseText);
                        alert('Error! ' + err.message);
                    }
                });
            });
            $('#konteks').summernote({
                disableLinkTarget: true
            });
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        let isLoadingMore = false;
        let hasMoreData = true;

        $(document).ready(function() {
            $('#load-more').on('click', function(e) {
                e.preventDefault();

                if (!isLoadingMore && hasMoreData) {
                    isLoadingMore = true;
                    let nextPage = parseInt($(this).data('page')) + 1;

                    $.get('{{ route('profile-lulusan.index') }}?page=' + nextPage, function(data) {
                        let content = $(data).find('#pendidikan-container').html();
                        if (content) {
                            $('#pendidikan-container').append(content);
                            isLoadingMore = false;
                            $('#load-more').data('page', nextPage);

                            if ($.trim(content).length === 0) {
                                $('#load-more').css('display', 'none');
                                hasMoreData = false;
                            }
                        } else {
                            $('#load-more').css('display', 'none');
                            hasMoreData = false;
                        }
                    });
                }
            });
        });
    </script>
    <script>
        let isLoadingMorePengalaman = false;
        let hasMoreDataPengalaman = true;

        $(document).ready(function() {
            $('#load-more-pengalaman').on('click', function(e) {
                e.preventDefault();

                if (!isLoadingMorePengalaman && hasMoreDataPengalaman) {
                    isLoadingMorePengalaman = true;
                    let nextPage = parseInt($(this).data('page')) + 1;

                    $.get('{{ route('profile-lulusan.index') }}?page=' + nextPage, function(data) {
                        let content = $(data).find('#pengalaman-container').html();
                        if (content) {
                            $('#pengalaman-container').append(content);
                            isLoadingMorePengalaman = false;
                            $('#load-more-pengalaman').data('page', nextPage);

                            if ($.trim(content).length === 0) {
                                $('#load-more-pengalaman').css('display', 'none');
                                hasMoreDataPengalaman = false;
                            }
                        } else {
                            $('#load-more-pengalaman').css('display', 'none');
                            hasMoreDataPengalaman = false;
                        }
                    });
                }
            });
        });
    </script>
    <script>
        let isLoadingMorePelatihan = false;
        let hasMoreDataPelatihan = true;

        $(document).ready(function() {
            $('#load-more-pelatihan').on('click', function(e) {
                e.preventDefault();

                if (!isLoadingMorePelatihan && hasMoreDataPelatihan) {
                    isLoadingMorePelatihan = true;
                    let nextPage = parseInt($(this).data('page')) + 1;

                    $.get('{{ route('profile-lulusan.index') }}?page=' + nextPage, function(data) {
                        let content = $(data).find('#pelatihan-container').html();
                        if (content) {
                            $('#pelatihan-container').append(content);
                            isLoadingMorePelatihan = false;
                            $('#load-more-pelatihan').data('page', nextPage);

                            if ($.trim(content).length === 0) {
                                $('#load-more-pelatihan').css('display', 'none');
                                hasMoreDataPelatihan = false;
                            }
                        } else {
                            $('#load-more-pelatihan').css('display', 'none');
                            hasMoreDataPelatihan = false;
                        }
                    });
                }
            });
        });
    </script>
    <script>
        let isLoadingMorePostingan = false;
        let hasMoreDataPostingan = true;

        function resetView() {
            $('#reset-message').show();


            $('#postingan-container').html('');


            $('#load-more-postingan').css('display', '');


            isLoadingMorePostingan = false;
            hasMoreDataPostingan = true;
            $('#load-more-postingan').data('page', 1);
        }

        $(document).ready(function() {
            $('#load-more-postingan').on('click', function(e) {
                e.preventDefault();

                if (!isLoadingMorePostingan && hasMoreDataPostingan) {
                    isLoadingMorePostingan = true;
                    let nextPage = parseInt($(this).data('page')) + 1;

                    $.get('{{ route('profile-lulusan.index') }}?page=' + nextPage, function(data) {
                        let content = $(data).find('#postingan-container').html();
                        if (content) {
                            $('#postingan-container').append(content);
                            isLoadingMorePostingan = false;
                            $('#load-more-postingan').data('page', nextPage);

                            if ($.trim(content).length === 0) {
                                $('#load-more-postingan').css('display', 'none');
                                hasMoreDataPostingan = false;
                                resetView();
                            }
                        } else {
                            $('#load-more-postingan').css('display', 'none');
                            hasMoreDataPostingan = false;
                            resetView();
                        }
                    });
                }
            });
        });
    </script>
    <script>
        function displayFileName(input) {
            if (input.files.length > 0) {
                var fileName = input.files[0].name;
                document.getElementById('selectedFileName').textContent = 'File yang dipilih: ' + fileName;
            } else {
                document.getElementById('selectedFileName').textContent = '';
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#konteks').summernote({
                height: 300,
                placeholder: 'Masukkan konten Anda di sini',
                lang: 'id-ID'
            });
        });
    </script>
@endpush
@push('customStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.css" rel="stylesheet">

    <style>
        .error {
            color: #ff0000;
        }
    </style>
@endpush
