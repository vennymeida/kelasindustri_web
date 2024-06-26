{{-- Modal View PDF --}}
<div id="pdfModal" class="modal">
    <div class="modal-overlay"
        style="display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div class="row">
                        <div class="col-md-6">
                            <img id="pdfViewer" style="width: 100%; height: auto;">
                        </div>
                        <div class="col-md-6">
                            <h4 id="portofolioTitle"></h4>
                            <p>deskripsi : </p>
                            <p id="portofolioDescription"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
<!-- Modal Tambah Keahlian -->
<div class="modal fade" id="modal-create-keahlian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Tambah
                    Keahlian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('keahlian.store') }}" class="needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="keahlian">Keahlian</label>
                            <input name="keahlian" type="text"
                                class="form-control custom-input @error('keahlian') is-invalid @enderror"
                                value="{{ old('keahlian') }}" placeholder="Masukkan nama keahlian">
                            @error('keahlian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke m-4">
                    <button type="button" class="btn btn-primary" onclick="$('form', this.closest('.modal')).submit();"
                        style="border-radius: 15px; font-size: 14px">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="border-radius: 15px; font-size: 14px">Batal</button>
                </div>
            </form>
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
                                    @if (Auth::user()->lulusan && Auth::user()->lulusan->foto != '')
                                        <img class="mr-3 rounded-circle" style="width: 50px; height: 50px;"
                                            src="{{ Storage::url(Auth::user()->lulusan->foto) }}" alt="Profile Image">
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
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/img/Gallery Add.svg') }}">
                                                &nbsp;&nbsp;&nbsp; Media
                                            </label>
                                            <!-- Input file tersembunyi -->
                                            <input type="file" id="mediaUploadButton" class="d-none"
                                                accept="image/*" onchange="displayFileName(this)" name="media">
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
                            <label for="tingkatan">Tingkatan</label>
                            <select class="form-control select2 custom-input @error('tingkatan') is-invalid @enderror"
                                name="tingkatan" id="tingkatan">
                                <option value="">Pilih Tingkatan</option>
                                <option value="SMK">SMK</option>
                                <option value="D3">Diploma III</option>
                                <option value="D4">Diploma IV</option>
                                <option value="S1">Sarjana</option>
                                <option value="S2">Magister</option>
                            </select>
                            @error('tingkatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Nama Institusi</label>
                            <input name="nama_institusi" type="text"
                                class="form-control custom-input @error('nama_institusi') is-invalid @enderror"
                                value="{{ old('nama_institusi') }}" placeholder="Masukkan nama nama_institusi anda">
                            @error('nama_institusi')
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
                                class="form-control select2 custom-input @error('tahun_selesai') is-invalid @enderror"
                                name="tahun_selesai" id="tahun_selesai">
                                <option value="">Pilih Tahun</option>
                                @for ($tahun = 2017; $tahun <= 2030; $tahun++)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endfor
                                <option value="Saat Ini">Saat Ini</option>
                            </select>
                            @error('tahun_selesai')
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
                            <label for="nama_pengalaman">Nama Pengalaman</label>
                            <input name="nama_pengalaman" type="text"
                                class="form-control custom-input @error('nama_pengalaman') is-invalid @enderror"
                                value="{{ old('nama_pengalaman') }}"
                                placeholder="Masukkan nama pengalaman yang pernah anda lakukan">
                            @error('nama_pengalaman')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Nama Instansi</label>
                            <input name="nama_instansi" type="text"
                                class="form-control custom-input @error('nama_instansi') is-invalid @enderror"
                                value="{{ old('nama_instansi') }}" placeholder="Masukkan nama instansi">
                            @error('nama_instansi')
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
                                placeholder="Masukkan Lokasi">{{ old('alamat') }}</textarea>
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
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                <input name="tgl_mulai" type="date"
                                    class="form-control custom-input @error('tgl_mulai') is-invalid @enderror"
                                    value="{{ old('tgl_mulai') }}">
                                @error('tgl_mulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-6 col-12">
                            <label>Tanggal Selesai</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input name="tgl_selesai" type="date"
                                    class="form-control custom-input @error('tgl_selesai') is-invalid @enderror"
                                    value="{{ old('tgl_selesai') }}">
                                @error('tgl_selesai')
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
                                <input name="tgl_dikeluarkan" type="date"
                                    class="form-control custom-input @error('tgl_dikeluarkan') is-invalid @enderror"
                                    value="{{ old('tgl_dikeluarkan') }}">
                                @error('tgl_dikeluarkan')
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

<!-- Modal Create Portofolio -->
<div class="modal fade" id="modal-create-portofolio" tabindex="-1" role="dialog"
    aria-labelledby="createPortofolioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header m-4">
                <h5 class="modal-title" id="createPortofolioLabel" style="color: #6777ef; font-weight: bold;">Tambah
                    Portofolio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('portofolio.store') }}" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf
                    <!-- Nama Portofolio -->
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="nama_portofolio">Nama Portofolio</label>
                            <input name="nama_portofolio" type="text"
                                class="form-control custom-input @error('nama_portofolio') is-invalid @enderror"
                                value="{{ old('nama_portofolio') }}" placeholder="Masukkan nama portofolio" required>
                            @error('nama_portofolio')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="deskripsi_portofolio">Deskripsi</label>
                            <input name="deskripsi_portofolio" type="text"
                                class="form-control custom-input @error('deskripsi_portofolio') is-invalid @enderror"
                                value="{{ old('deskripsi_portofolio') }}" placeholder="Masukkan nama portofolio"
                                required>
                            @error('deskripsi_portofolio')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Unggah Portofolio</label>
                            <input id="dokumen_portofolio" name="dokumen_portofolio" type="file"
                                class="form-control custom-input @error('dokumen_portofolio') is-invalid @enderror">
                            @error('dokumen_portofolio')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="text-warning small" style="font-size: 13px; font-weight:medium;">
                                (Tipe berkas : png, jpeg, jpg | Max size : 2MB)</div>
                        </div>
                    </div>
                    <!-- Link Portofolio -->
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="link_portofolio">Link Portofolio</label>
                            <input name="link_portofolio" type="url"
                                class="form-control custom-input @error('link_portofolio') is-invalid @enderror"
                                value="{{ old('link_portofolio') }}" placeholder="Masukkan link portofolio">
                            @error('link_portofolio')
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
                <form method="POST" action="" class="needs-validation" novalidate=""
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="subject">Subject</label>
                            <input name="subject" type="text"
                                class="form-control custom-input @error('subject') is-invalid @enderror"
                                value="{{ old('subject') }}" placeholder="Pengumuman Tahapan Interview">
                            @error('subject')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label>Tempat Interview</label>
                            <input name="tempat_interview" type="text"
                                class="form-control custom-input @error('tempat_interview') is-invalid @enderror"
                                value="{{ old('tempat_interview') }}" placeholder="Masukkan Tempat Interview">
                            @error('tempat_interview')
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
                            <label>Tanggal Interview</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input name="tgl_interview" type="date"
                                    class="form-control custom-input @error('tgl_interview') is-invalid @enderror"
                                    value="{{ old('tgl_interview') }}">
                                @error('tgl_interview')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-12">
                            <label>Catatan (Opsional)</label>
                            <textarea name="catatan" class="form-control custom-input @error('catatan') is-invalid @enderror" rows="4"
                                placeholder="Masukkan catatan">{{ old('catatan') }}</textarea>
                            @error('catatan')
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

@extends('landing-page.app')
@section('title', 'JobsKelasIndustri - Profile')
@section('main')
    <main class="bg-light">
        <h4 class="text-center my-4" style="text-align: center; font-weight: bold;">Data Diri</h4>
        <section class="centered-section-1">
            @if (session('success'))
                <script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Success!',
                            text: '{{ session('success') }}',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        })
                    }
                </script>
            @endif
            <div class="bg-primary-section card col-lg-10 col-md-10 col-sm-6 py-1 card-profile1">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-widget-description m-4">
                            @if (Auth::user()->lulusan && Auth::user()->lulusan->foto != '')
                                <img alt="image" src="{{ Storage::url(Auth::user()->lulusan->foto) }}"
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
                                <hr style="background-color:#ebebeb; height: 1px; border: none; width: 90%; float: left;">
                            </div>
                            <div class="d-flex justify-content-end" style="font-size: 2.00em;">
                                @if (Auth::user()->lulusan)
                                    <button class="btn btn-primary"
                                        style="background-color:#4ED373; font-size:13px; border-radius:15px; border-color:#4ED373;margin-right: 10px;">
                                        {!! Auth::user()->lulusan->status !!}
                                    </button>
                                    <a
                                        href="{{ route('profile-lulusan.edit', ['profile_lulusan' => Auth::user()->lulusan->id]) }}">
                                        <img class="img-fluid" style="width: 35px; height: 35px;"
                                            src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                    </a>
                                @else
                                    <a href="{{ route('profile-lulusan.create') }}" class="btn btn-primary"
                                        style="background-color:#4e81d3; font-size:13px; border-radius:15px; border-color:#4ED373;margin-right: 10px;">
                                        Lengkapi Profile
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-11 ml-2 card-profile2">
                            <div style="display: flex; flex-direction: column;">
                                @if (Auth::user()->lulusan)
                                    @if (Auth::user()->lulusan->alamat != '')
                                        <div class="lulusan-widget-description mb-3"
                                            style="display: flex; align-items: center; margin-bottom: 10px;">
                                            <img class="img-fluid" style="width: 25px; height: 25px;"
                                                src="{{ asset('assets/img/landing-page/location pin.svg') }}">&nbsp&nbsp<a>{{ Auth::user()->lulusan->alamat }}</a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->lulusan->resume != '')
                                        <div class="profile-widget-description lihat-resume" style="margin-bottom: 10px;">
                                            <a href="{{ Storage::url(Auth::user()->lulusan->resume) }}"
                                                onclick="return openResume();" target="_blank" class="btn btn-primary"
                                                style="background-color:#eb9481; font-size:13px; border-radius:15px; border-color:#eb9481;">
                                                Lihat Resume
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            </div>
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
                                                    style="color: #000000; line-height: 2; font-weight:500">&nbsp&nbsp&nbsp&nbsp&nbsp{{ Auth::user()->lulusan->tgl_lahir }}</span>
                                            </span><br><br>
                                        @else
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">Tanggal
                                                Lahir :</span>
                                            <span style="color: #000000; line-height: 2; font-weight:500"><br></span><br>
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
                                            <span style="color: #000000; line-height: 2; font-weight:500"><br></span><br>
                                        @endif
                                        @if (Auth::user()->lulusan && Auth::user()->lulusan->no_hp != '')
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">No
                                                Telepon&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:<span
                                                    style="color: #000000; line-height: 2; font-weight:500">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ Auth::user()->lulusan->no_hp }}</span></span><br><br>
                                        @else
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">No Telepon
                                                :</span>
                                            <span style="color: #000000; line-height: 2; font-weight:500"><br></span><br>
                                        @endif
                                        @if (Auth::user()->lulusan && Auth::user()->lulusan->angkatan_tahun != '')
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">Angkatan
                                                tahun&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:<span
                                                    style="color: #000000; line-height: 2; font-weight:500">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ Auth::user()->lulusan->angkatan_tahun }}</span></span><br><br>
                                        @else
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">Angkatan Tahun
                                                :</span>
                                            <span style="color: #000000; line-height: 2; font-weight:500"><br></span><br>
                                        @endif
                                        @if (Auth::user()->lulusan && Auth::user()->lulusan->divisi != '')
                                            <span
                                                style="color: #808080; font-size: 15px; font-weight:bold">Divisi&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:<span
                                                    style="color: #000000; line-height: 2; font-weight:500">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ Auth::user()->lulusan->divisi }}</span></span><br><br>
                                        @else
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">Divisi
                                                :</span>
                                            <span style="color: #000000; line-height: 2; font-weight:500"><br></span><br>
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
                                src="{{ Storage::url(Auth::user()->lulusan->foto) }}" alt="Profile Image">
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
                <div class="profile-widget-description m-3"
                    style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
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
                                        <img class="mr-3 rounded p-img-media" width="10%;"
                                            src="{{ asset('storage/' . $post->media) }}">
                                        <div class="media-body col-md-9 p-postingan-konteks">
                                            {!! $post->konteks !!}
                                        </div>
                                        <div class="d-flex justify-content-end" style="" id="fluid">
                                            <a href="#" data-id="{{ $post->id }}"
                                                data-edit-url="{{ route('postingan.edit', ['postingan' => $post->id]) }}"
                                                class="modal-edit-trigger-postingan mt-2">
                                                <img class="img-fluid" style="width: 30px; height: 30px;"
                                                    src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                            </a>
                                            <form class="m-0"
                                                action="{{ route('postingan.destroy', ['postingan' => $post->id]) }}"
                                                method="POST" id="delete-post{{ $post->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-edu"
                                                    onclick="confirmPost({{ $post->id }})">
                                                    <img class="img-fluid" style="width: 30px; height: 30px;"
                                                        src="{{ asset('assets/img/landing-page/delete.svg') }}"
                                                        alt="Hapus">
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="media-body col-md-10 mr-5">
                                            {!! $post->konteks !!}
                                        </div>
                                        <div class="d-flex justify-content-end ml-4" style="" id="fluid">
                                            <a href="#" data-id="{{ $post->id }}"
                                                data-edit-url="{{ route('postingan.edit', ['postingan' => $post->id]) }}"
                                                class="modal-edit-trigger-postingan mt-2">
                                                <img class="img-fluid" style="width: 30px; height: 30px;"
                                                    src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                            </a>
                                            <form class="m-0"
                                                action="{{ route('postingan.destroy', ['postingan' => $post->id]) }}"
                                                method="POST" id="delete-post{{ $post->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-edu"
                                                    onclick="confirmPost({{ $post->id }})">
                                                    <img class="img-fluid" style="width: 30px; height: 30px;"
                                                        src="{{ asset('assets/img/landing-page/delete.svg') }}"
                                                        alt="Hapus">
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
                        <a href="#" data-toggle="modal" data-target="#modal-create-keahlian">
                            <img class="img-fluid" style="width: 35px; height: 35px;"
                                src="{{ asset('assets/img/landing-page/Plus.svg') }}">
                        </a>
                    </div>
                </div>
                @if (count(auth()->user()->keahlians) > 0)
                    <div class="col-md-12 mb-4">
                        <div class="flex-grow-1 mb-2">
                            <div class="card-header-action keahlianPelamar d-flex flex-wrap">
                                @foreach (auth()->user()->keahlians as $keahlian)
                                    <div class="d-flex align-items-center mb-2 mr-2">
                                        <button class="btn btn-skill keahlianPelamar1"
                                            style="font-size: 14px">{{ $keahlian->keahlian }}</button>
                                        <form class="m-0" action="{{ route('keahlian.destroy', $keahlian->id) }}"
                                            method="POST" id="delete-keahlian{{ $keahlian->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger ml-2"
                                                onclick="confirmKeahlian({{ $keahlian->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12 text-center my-4"><br><br>
                        <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                        <p class="mt-1 text-not">Data Keahlian Masih Kosong</p>
                    </div>
                @endif
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
                        <div class="row">
                            @foreach ($pendidikans as $item)
                                <div class="col-md-6">
                                    <hr>
                                    <div class="mr-5 ml-5">
                                        <div class="profile-widget-description m-3"
                                            style="font-weight: bold; font-size: 16px; display: flex; align-items: center;">
                                            <div class="flex-grow-1">
                                                <div class="profile-widget-name"
                                                    style="font-weight: bold; font-size: 17px; display: flex; align-items: center;">
                                                    {{ $item->nama_institusi }}
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
                                                    {{ $item->tingkatan }} - {{ $item->jurusan }}
                                                </li>
                                                <li class="mb-2"><img class="img-fluid"
                                                        src="{{ asset('assets/img/landing-page/Time.svg') }}">&nbsp&nbsp&nbsp&nbsp
                                                    {{ $item->tahun_mulai }} - {{ $item->tahun_selesai }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                        <div class="row">
                            @foreach ($pengalamans as $pl)
                                <div class="col-md-6">
                                    <hr>
                                    <div class="mr-5 ml-5">
                                        <div class="profile-widget-description m-3"
                                            style="font-weight: bold; font-size: 16px; display: flex; align-items: center;">
                                            <div class="flex-grow-1">
                                                <div class="profile-widget-name"
                                                    style="font-weight: bold; font-size: 17px; display: flex; align-items: center;">
                                                    {{ $pl->nama_pengalaman }}
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
                                                    {{ $pl->nama_instansi }} | {{ $pl->alamat }}
                                                </div>
                                            </div>
                                            <ul class="list-unstyled ml-2">
                                                <li class="mb-2">
                                                    <img class="img-fluid"
                                                        src="{{ asset('assets/img/landing-page/hourglass.svg') }}">
                                                    &nbsp&nbsp&nbsp{{ $pl->tipe }}
                                                </li>
                                                <li class="mb-2">
                                                    <img class="img-fluid"
                                                        src="{{ asset('assets/img/landing-page/Time.svg') }}">
                                                    &nbsp&nbsp&nbsp{{ $pl->tgl_mulai }} - {{ $pl->tgl_selesai }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                        <div class="row">
                            @foreach ($pelatihans as $lat)
                                <div class="col-md-6">
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
                                                    {{ $lat->tgl_dikeluarkan }}
                                                </li>
                                            </ul>
                                            @if (!empty($lat->sertifikat))
                                                <div style="font-size: 16px;">
                                                    <a href="{{ asset('storage/' . $lat->sertifikat) }}"
                                                        target="_blank">
                                                        <p class="">Lihat Sertifikat</p>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
        <section style="display: flex; justify-content: center; margin-top: 20px; margin-bottom: 20px;">
            <div class="bg-primary-section card col-md-10 py-1 card-profile8">
                <div style="font-weight: bold; font-size: 18px; display: flex; align-items: center; margin: 10px;">
                    <div style="flex-grow: 1; color: #6777ef;">Portofolio</div>
                    <div style="display: flex; justify-content: end; font-size: 2em;">
                        <a href="#" data-toggle="modal" data-target="#modal-create-portofolio">
                            <img src="{{ asset('assets/img/landing-page/Plus.svg') }}"
                                style="width: 35px; height: 35px;">
                        </a>
                    </div>
                </div>
                <style>
                    .article-header {
                        padding: 10px;
                        background: #fff;
                        border: 1px solid #ddd;
                    }

                    .card-ldporto {
                        position: relative;
                        overflow: hidden;
                    }

                    .card-ldporto img {
                        transition: transform 0.3s ease;
                        width: 100%;
                        height: 250px;
                        object-fit: cover;
                    }

                    .card-ldporto:hover img {
                        transform: scale(1.1);
                    }

                    .porto-infox {
                        position: absolute;
                        bottom: -100px;
                        left: 0;
                        width: 100%;
                        background-color: rgb(255 255 255 / 66%);
                        padding: 10px;
                        color: #fff;
                        transition: bottom 0.3s ease;
                        text-align: center;
                    }

                    .card-ldporto:hover .porto-infox {
                        bottom: 0;
                    }
                </style>
                @if ($portofolios->count() > 0)
                    <div id="portofolio-container" style="display: flex; flex-wrap: wrap; justify-content: center;">
                        @foreach ($portofolios as $portofolio)
                            {{-- <div
                                style="border: 1px solid #e0e0e0; border-radius: 8px; margin: 15px; width: 300px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                <div style="padding: 15px;">
                                    <div
                                        style="font-weight: bold; font-size: 16px; display: flex; align-items: center; margin-bottom: 10px;">
                                        <div style="flex-grow: 1;">
                                            <div style="font-size: 17px;">{{ $portofolio->nama_portofolio }}</div>
                                        </div>
                                        <div
                                            style="display: flex; justify-content: end; align-items: center; font-size: 2em;">
                                            <a href="#" data-id="{{ $portofolio->id }}"
                                                data-edit-url="{{ route('portofolio.edit', ['portofolio' => $portofolio->id]) }}"
                                                class="modal-edit-trigger-portofolio">
                                                <img src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}"
                                                    style="width: 30px; height: 30px;">
                                            </a>
                                            <form
                                                action="{{ route('portofolio.destroy', ['portofolio' => $portofolio->id]) }}"
                                                method="POST" id="delete-portofolio{{ $portofolio->id }}"
                                                style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    style="background: none; border: none; padding: 0; cursor: pointer;"
                                                    onclick="confirmPortofolio({{ $portofolio->id }})">
                                                    <img src="{{ asset('assets/img/landing-page/delete.svg') }}"
                                                        style="width: 30px; height: 30px;" alt="Hapus">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div onclick="openModal(this)"
                                        data-url="{{ route('portofolio.show', ['portofolio' => $portofolio->id]) }}"
                                        style="cursor: pointer; text-align: center;">
                                        @if ($portofolio->dokumen_portofolio == null)
                                            <img src="{{ asset('assets/img/landing-page/folder.png') }}"
                                                style="max-width: 100%; max-height: 150px;">
                                        @else
                                            <img src="{{ asset('storage/' . $portofolio->dokumen_portofolio) }}"
                                                style="max-width: 100%; max-height: 150px;">
                                        @endif
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-4 mb-2">
                                <div class="article-header">
                                    <h5 class="text-center text-dark">{{ $portofolio->nama_portofolio }}</h5>
                                    <div class="card-ldporto mb-4">
                                        @if ($portofolio->dokumen_portofolio == null)
                                            <img src="{{ asset('assets/img/landing-page/folder.png') }}"
                                                alt="img-fluid">
                                        @else
                                            <img src="{{ asset('storage/' . $portofolio->dokumen_portofolio) }}"
                                                alt="img-fluid">
                                        @endif
                                        <div class="porto-infox"
                                            style="display: flex;
                                        justify-content: center;">
                                            <div class="row">
                                                <button data-id="{{ $portofolio->id }}"
                                                    data-edit-url="{{ route('portofolio.edit', ['portofolio' => $portofolio->id]) }}"
                                                    class="btn btn-warning view-disease modal-edit-trigger-portofolio mr-2">Edit</button>
                                                <form
                                                    action="{{ route('portofolio.destroy', ['portofolio' => $portofolio->id]) }}"
                                                    method="POST" id="delete-portofolio{{ $portofolio->id }}"
                                                    style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="confirmPortofolio({{ $portofolio->id }})"
                                                        class="btn btn-danger view-disease">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-right mt-5 mr-4">
                        <button id="load-more-portofolio" class="btn btn-more mb-3"
                            data-page="{{ $portofolios->currentPage() }}">Muat Lebih Banyak . . .</button>
                    </div>
                @else
                    <div style="text-align: center; margin: 40px;">
                        <img src="{{ asset('assets/img/landing-page/folder.png') }}" alt="Folder">
                        <p style="margin-top: 10px; color: #999;">Data Portofolio Masih Kosong</p>
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
                                    <label for="tingkatan">Tingkatan</label>
                                    <select
                                        class="form-control select2 custom-input @error('tingkatan') is-invalid @enderror"
                                        name="tingkatan" id="tingkatan">
                                        <option value="">Pilih Tingkatan</option>
                                        <option value="SMK">SMK</option>
                                        <option value="D3">Diploma III</option>
                                        <option value="D4">Diploma IV</option>
                                        <option value="S1">Sarjana</option>
                                        <option value="S2">Magister</option>
                                    </select>
                                    @error('tingkatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Nama Institusi</label>
                                    <input name="nama_institusi" type="text"
                                        class="form-control custom-input @error('nama_institusi') is-invalid @enderror"
                                        value="{{ old('nama_institusi') }}"
                                        placeholder="Masukkan nama nama_institusi anda">
                                    @error('nama_institusi')
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
                                        class="form-control select2 custom-input @error('tahun_selesai') is-invalid @enderror"
                                        name="tahun_selesai" id="tahun_selesai">
                                        <option value="">Pilih Tahun</option>
                                        @for ($tahun = 2017; $tahun <= 2030; $tahun++)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endfor
                                        <option value="Saat Ini">Saat Ini</option>
                                    </select>
                                    @error('tahun_selesai')
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
                            Pengalaman</h5>
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
                                    <label for="nama_pengalaman">Nama Pengalaman</label>
                                    <input name="nama_pengalaman" type="text"
                                        class="form-control custom-input @error('nama_pengalaman') is-invalid @enderror"
                                        value="{{ old('nama_pengalaman') }}"
                                        placeholder="Masukkan nama pengalaman yang pernah anda lakukan">
                                    @error('nama_pengalaman')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Nama Instansi</label>
                                    <input name="nama_instansi" type="text"
                                        class="form-control custom-input @error('nama_instansi') is-invalid @enderror"
                                        value="{{ old('nama_instansi') }}" placeholder="Masukkan nama instansi">
                                    @error('nama_instansi')
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
                                        placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
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
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    @error('tipe')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
                                        <input name="tgl_mulai" type="date"
                                            class="form-control custom-input @error('tgl_mulai') is-invalid @enderror"
                                            value="{{ old('tgl_mulai') }}">
                                        @error('tgl_mulai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-6 col-12">
                                    <label>Tanggal Selesai</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text custom-input">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input name="tgl_selesai" type="date"
                                            class="form-control custom-input @error('tgl_selesai') is-invalid @enderror"
                                            value="{{ old('tgl_selesai') }}">
                                        @error('tgl_selesai')
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
                            Pelatihan</h5>
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
                                        <input name="tgl_dikeluarkan" type="date"
                                            class="form-control custom-input @error('tgl_dikeluarkan') is-invalid @enderror"
                                            value="{{ old('tgl_dikeluarkan') }}">
                                        @error('tgl_dikeluarkan')
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

    <!-- Modal Edit Portofolio -->
    <div id="modal-edit-portofolio" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mx-auto" role="document">
            <div class="modal-content">
                <div class="modal-header m-4">
                    <h5 class="modal-title" style="color: #6777ef; font-weight: bold;">Edit Portofolio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="modal-edit-portofolio-form" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row ml-4 mr-4">
                            <div class="form-group col-md-12 col-12">
                                <label for="nama_portofolio">Nama Portofolio</label>
                                <input name="nama_portofolio" type="text"
                                    class="form-control custom-input @error('nama_portofolio') is-invalid @enderror"
                                    value="{{ old('nama_portofolio') }}" placeholder="Masukkan nama portofolio">
                                @error('nama_portofolio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row ml-4 mr-4">
                            <div class="form-group col-md-12 col-12">
                                <label for="deskripsi_portofolio">Deskripsi</label>
                                <input name="deskripsi_portofolio" type="text"
                                    class="form-control custom-input @error('deskripsi_portofolio') is-invalid @enderror"
                                    value="{{ old('deskripsi_portofolio') }}" placeholder="Masukkan nama portofolio"
                                    required>
                                @error('deskripsi_portofolio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row ml-4 mr-4">
                            <div class="form-group col-md-12 col-12">
                                <label>Unggah Portofolio</label>
                                <input id="dokumen_portofolio" name="dokumen_portofolio" type="file"
                                    class="form-control custom-input @error('dokumen_portofolio') is-invalid @enderror"
                                    value="{{ old('dokumen_portofolio') }}">
                                @error('dokumen_portofolio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-warning small" style="font-size: 13px; font-weight:bolder;">
                                    (Tipe berkas : pdf | Max size : 2MB)</div>
                            </div>
                        </div>

                        <div class="row ml-4 mr-4">
                            <div class="form-group col-md-12 col-12">
                                <label for="link_portofolio">Link Portofolio</label>
                                <input name="link_portofolio" type="url"
                                    class="form-control custom-input @error('link_portofolio') is-invalid @enderror"
                                    value="{{ old('link_portofolio') }}" placeholder="Masukkan link portofolio">
                                @error('link_portofolio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke m-4">
                    <button type="button" class="btn btn-primary" id="modal-save-button-portofolio"
                        style="border-radius: 15px; font-size: 14px">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="border-radius: 15px; font-size: 14px">Batal</button>
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
                                        @if (Auth::user()->lulusan && Auth::user()->lulusan->foto != '')
                                            <img class="mr-3 rounded-circle" style="width: 50px; height: 50px;"
                                                src="{{ Storage::url(Auth::user()->lulusan->foto) }}"
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
                                        <textarea name="konteks" id="konteks2" class="form-control summernote @error('konteks') is-invalid @enderror"
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
        function confirmPortofolio(itemId) {
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
                    document.getElementById('delete-portofolio' + itemId).submit();
                }
            });
        }
    </script>
    <script>
        function confirmKeahlian(itemId) {
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
                    document.getElementById('delete-keahlian' + itemId).submit();
                }
            });
        }
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
            $('#konteks').summernote({
                height: 200,
                placeholder: 'Masukkan konten Anda di sini',
                lang: 'id-ID',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['picture']]
                ]
            });
        });

        $('#konteks2').summernote({
            height: 250,
            disableLinkTarget: true,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture']]
            ]
        });

        $(document).ready(function() {
            var editModal = $('#modal-edit-pendidikan');
            var isSubmitting = false;

            function showError(field, message) {
                var inputField = editModal.find('[name="' + field + '"]');
                inputField.addClass('is-invalid');
                inputField.closest('.form-group').find('.invalid-feedback').text(message);
            }

            // Menambahkan aturan kustom untuk memvalidasi tahun mulai dan tahun selesai
            $.validator.addMethod("tahunSelesaiLebihBesar", function(value, element) {
                var tahunMulai = parseInt($('#modal-edit-pendidikan select[name="tahun_mulai"]').val(), 10);
                var tahunSelesai = parseInt($('#modal-edit-pendidikan select[name="tahun_selesai"]').val(),
                    10);
                return tahunMulai <= tahunSelesai;
            }, "Tahun mulai tidak boleh melebihi tahun selesai.");

            // Validasi form
            $("#modal-edit-pendidikan-form").validate({
                rules: {
                    tingkatan: {
                        required: true
                    },
                    nama_institusi: {
                        required: true,
                        maxlength: 255
                    },
                    jurusan: {
                        required: true,
                        maxlength: 255
                    },
                    tahun_mulai: {
                        required: true,
                        tahunSelesaiLebihBesar: true
                    },
                    tahun_selesai: {
                        required: true
                    },
                },
                messages: {
                    tingkatan: {
                        required: "Tingkatan Tidak Boleh Kosong"
                    },
                    nama_institusi: {
                        required: "Institusi Tidak Boleh Kosong",
                        maxlength: "Nama Institusi Melebihi Batas Maksimal"
                    },
                    jurusan: {
                        required: "Jurusan Tidak Boleh Kosong",
                        maxlength: "Nama Jurusan Melebihi Batas Maksimal"
                    },
                    tahun_mulai: {
                        required: "Tahun Mulai Tidak Boleh Kosong"
                    },
                    tahun_selesai: {
                        required: "Tahun Selesai Tidak Boleh Kosong"
                    },
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').next('.invalid-feedback').show();
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass('is-invalid').next('.invalid-feedback').hide();
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
                        $('#modal-edit-pendidikan select[name="tingkatan"]').val(data.tingkatan)
                            .change();
                        $('#modal-edit-pendidikan input[name="nama_institusi"]').val(data
                            .nama_institusi);
                        $('#modal-edit-pendidikan input[name="jurusan"]').val(data.jurusan);
                        $('#modal-edit-pendidikan select[name="tahun_mulai"]').val(data.tahun_mulai)
                            .change();
                        $('#modal-edit-pendidikan select[name="tahun_selesai"]').val(data.tahun_selesai)
                            .change();

                        editModal.modal('show');
                    }
                });
            }

            $('#pendidikan-container').on('click', '.modal-edit-trigger-pendidikan', function() {
                var itemId = $(this).data('id');
                openEditModal(itemId);
            });

            $('#modal-save-button-pendidikan').on('click', function(e) {
                e.preventDefault();
                $('#modal-edit-pendidikan-form').submit();
            });

            $('#modal-edit-pendidikan-form').off('submit').on('submit', function(e) {
                e.preventDefault();

                if (isSubmitting) {
                    return;
                }
                isSubmitting = true;

                var form = $(this);

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
                            isSubmitting = false;
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Data berhasil diperbarui.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    editModal.modal('hide');
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat memperbarui data.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        error: function() {
                            isSubmitting = false;
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat memperbarui data.',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                } else {
                    isSubmitting = false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var editModal = $('#modal-edit-pengalaman');
            var isSubmitting = false;

            function showError(field, message) {
                var inputField = editModal.find('[name="' + field + '"]');
                inputField.addClass('is-invalid');
                inputField.closest('.form-group').find('.invalid-feedback').text(message);
            }

            // Validasi custom
            $.validator.addMethod("greaterThanStartDate", function(value, element) {
                var startDate = $('#modal-edit-pengalaman input[name="tgl_mulai"]').val();
                return new Date(value) > new Date(startDate);
            }, "Tanggal selesai harus setelah tgl mulai .");

            // Validasi form
            $("#modal-edit-pengalaman-form").validate({
                rules: {
                    nama_pengalaman: {
                        required: true,
                        maxlength: 255
                    },
                    nama_instansi: {
                        required: true,
                        maxlength: 255
                    },
                    alamat: {
                        maxlength: 2000
                    },
                    tipe: {
                        required: true,
                    },
                    tgl_mulai: {
                        required: true,
                        date: true
                    },
                    tgl_selesai: {
                        required: true,
                        date: true,
                        greaterThanStartDate: true
                    }
                },
                messages: {
                    nama_pengalaman: {
                        required: "Nama Pengalaman Tidak Boleh Kosong",
                        maxlength: "Inputan Nama Pengalaman Melebihi Batas Maksimal"
                    },
                    nama_instansi: {
                        required: "Nama Instansi Tidak Boleh Kosong",
                        maxlength: "Inputan Nama Instansi Melebihi Batas Maksimal"
                    },
                    alamat: {
                        maxlength: "Inputan Alamat Melebihi Batas Maksimal"
                    },
                    tipe: {
                        required: "Tipe Tidak Boleh Kosong"
                    },
                    tgl_mulai: {
                        required: "Tanggal mulai harus diisi.",
                        date: "Format tgl tidak valid."
                    },
                    tgl_selesai: {
                        required: "Tanggal selesai harus diisi.",
                        date: "Format tgl tidak valid.",
                        greaterThanStartDate: "Tanggal selesai harus setelah tgl mulai."
                    }
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').next('.invalid-feedback').show();
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass('is-invalid').next('.invalid-feedback').hide();
                }
            });

            function openEditModal(plId) {
                var editUrl = "{{ route('pengalaman.edit', ['pengalaman' => '_id']) }}".replace('_id', plId);
                var updateUrl = "{{ route('pengalaman.update', ['pengalaman' => '_id']) }}".replace('_id', plId);

                $('#modal-edit-pengalaman-form').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#modal-edit-pengalaman input[name="nama_pengalaman"]').val(data
                            .nama_pengalaman);
                        $('#modal-edit-pengalaman input[name="nama_instansi"]').val(data.nama_instansi);
                        $('#modal-edit-pengalaman textarea[name="alamat"]').val(data.alamat);
                        $('#modal-edit-pengalaman select[name="tipe"]').val(data.tipe).change();
                        $('#modal-edit-pengalaman input[name="tgl_mulai"]').val(data.tgl_mulai);
                        $('#modal-edit-pengalaman input[name="tgl_selesai"]').val(data.tgl_selesai);

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
                form.submit();
            });

            $('#modal-edit-pengalaman-form').off('submit').on('submit', function(e) {
                e.preventDefault();

                if (isSubmitting) {
                    return;
                }
                isSubmitting = true;

                var form = $(this);

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
                            isSubmitting = false;
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Data berhasil diperbarui.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    editModal.modal('hide');
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat memperbarui data.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        error: function() {
                            isSubmitting = false;
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat memperbarui data.',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                } else {
                    isSubmitting = false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var editModal = $('#modal-edit-pelatihan');
            var isSubmitting = false;

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
                    tgl_dikeluarkan: {
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
                    tgl_dikeluarkan: {
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
                        $('#modal-edit-pelatihan input[name="tgl_dikeluarkan"]').val(data
                            .tgl_dikeluarkan);

                        editModal.modal('show');
                    }
                });
            }

            $('#pelatihan-container').on('click', '.modal-edit-trigger-pelatihan', function() {
                var latId = $(this).data('id');
                openEditModal(latId);
            });

            $('#modal-save-button-pelatihan').on('click', function(e) {
                e.preventDefault();
                $('#modal-edit-pelatihan-form').submit();
            });

            $('#modal-edit-pelatihan-form').off('submit').on('submit', function(e) {
                e.preventDefault();

                if (isSubmitting) {
                    return;
                }
                isSubmitting = true;

                var form = $(this);

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
                            isSubmitting = false;
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Data berhasil diperbarui.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    editModal.modal('hide');
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat memperbarui data.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        error: function() {
                            isSubmitting = false;
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat memperbarui data.',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                } else {
                    isSubmitting = false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var editModal = $('#modal-edit-portofolio');

            // Fungsi untuk menampilkan pesan kesalahan pada field yang spesifik
            function showError(field, message) {
                var inputField = editModal.find('[name="' + field + '"]');
                inputField.addClass('is-invalid');
                inputField.closest('.form-group').find('.invalid-feedback').text(message);
            }

            // Validasi form dengan jQuery Validate
            $("#modal-edit-portofolio-form").validate({
                rules: {
                    nama_portofolio: {
                        required: true,
                        maxlength: 255
                    },
                    link_portofolio: {
                        url: true,
                        maxlength: 255
                    },
                    deskripsi_portofolio: {
                        required: true
                    },
                },
                messages: {
                    nama_portofolio: {
                        required: "Nama Portofolio tidak boleh kosong",
                        maxlength: "Nama Portofolio melebihi batas maksimal"
                    },
                    link_portofolio: {
                        // required: "Link Portofolio tidak boleh kosong",
                        // url: "Masukkan URL yang valid",
                        maxlength: "Link Portofolio melebihi batas maksimal"
                    },
                    deskripsi_portofolio: {
                        required: "Deskripsi portofolio melebihi batas maksimal"
                    },
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').next('.invalid-feedback').show();
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass('is-invalid').next('.invalid-feedback').hide();
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);

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

            // Assuming you have a modal with the ID 'modal-edit-portofolio'
            var editModal = $('#modal-edit-portofolio');

            // Function to open the edit modal
            function openEditModal(portofolioId) {
                var editUrl = "{{ route('portofolio.edit', ['portofolio' => '_id']) }}".replace('_id',
                    portofolioId);
                var updateUrl = "{{ route('portofolio.update', ['portofolio' => '_id']) }}".replace('_id',
                    portofolioId);

                // Set the form action to the update URL
                $('#modal-edit-portofolio-form').attr('action', updateUrl);


                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        $('#modal-edit-portofolio input[name="nama_portofolio"]').val(data
                            .nama_portofolio);
                        $('#modal-edit-portofolio input[name="link_portofolio"]').val(data
                            .link_portofolio);
                        $('#modal-edit-portofolio input[name="deskripsi_portofolio"]').val(data
                            .deskripsi_portofolio);


                        editModal.modal('show');
                    },
                    error: function(xhr, status, error) {

                        console.error("Error: " + status + " " + error);
                    }
                });
            }


            $('#portofolio-container').on('click', '.modal-edit-trigger-portofolio', function() {
                var portofolioId = $(this).data('id');
                openEditModal(portofolioId);
            });


            $('#modal-save-button-portofolio').on('click', function() {
                var form = $('#modal-edit-portofolio-form');

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
                            Swal.fire({}).then(function() {
                                window.location.href =
                                    "{{ route('profile-lulusan.index') }}";
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // For debugging
                        var err = JSON.parse(xhr.responseText);
                        alert('Error! ' + (err.message || error));
                    }
                });
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
        let isLoadingMorePortofolio = false;
        let hasMoreDataPortofolio = true;

        $(document).ready(function() {
            $('#load-more-portofolio').on('click', function(e) {
                e.preventDefault();

                if (!isLoadingMorePortofolio && hasMoreDataPortofolio) {
                    isLoadingMorePortofolio = true;
                    let nextPage = parseInt($(this).data('page')) + 1;

                    $.get('{{ route('profile-lulusan.index') }}?page=' + nextPage, function(data) {
                        let content = $(data).find('#portofolio-container').html();
                        if (content && $.trim(content).length > 0) {
                            $('#portofolio-container').append(content);
                            isLoadingMorePortofolio = false;
                            $('#load-more-portofolio').data('page', nextPage);
                        } else {
                            $('#load-more-portofolio').hide();
                            hasMoreDataPortofolio = false;
                        }
                    }).fail(function() {
                        isLoadingMorePortofolio = false;
                        alert('Gagal memuat lebih banyak data. Silakan coba lagi.');
                    });
                }
            });
        });
    </script>
    <script>
        let isLoadingMorePostingan = false;
        let hasMoreDataPostingan = true;

        function resetView() {
            console.log('Resetting view...');
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
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.error('Load more failed:', textStatus, errorThrown);
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while loading more posts.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    });
                }
            });

            $('#modal-save-button-portofolio').on('click', function() {
                var form = $('#modal-edit-portofolio-form');
                var formData = new FormData(form[0]);
                formData.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log('Response:', response); // For debugging
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', xhr, status, error); // For debugging
                        try {
                            var err = JSON.parse(xhr.responseText);
                            Swal.fire({
                                title: 'Error!',
                                text: err.message || error,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        } catch (e) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'An unexpected error occurred.',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    }
                });
            });

            // menghapus alert
            window.alert = function(message) {
                console.log('Alert called with message:', message);

            };
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
    {{-- <script>
        $(document).ready(function() {
            $('#konteks').summernote({
                height: 300,
                placeholder: 'Masukkan konten Anda di sini',
                lang: 'id-ID'
            });
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('pdfModal');
            const pdfViewer = document.getElementById('pdfViewer');
            const modalOverlay = document.querySelector('.modal-overlay');
            const portofolioTitle = document.getElementById('portofolioTitle');
            // const portofolioDescription = document.getElementById('portofolioDescription');

            document.addEventListener('click', function(event) {
                if (event.target.hasAttribute('data-url')) {
                    const url = event.target.getAttribute('data-url');
                    openModal(url);
                }
            });

            function openModal(url) {
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        pdfViewer.src = data.image;
                        portofolioTitle.textContent = data.title;
                        portofolioDescription.textContent = data.deskripsi;
                        modal.style.display = 'block';
                        modalOverlay.style.display = 'block';
                    });
            }

            function closeModal() {
                modal.style.display = 'none';
                modalOverlay.style.display = 'none';
            }

            const closeButton = document.querySelector('.close');
            closeButton.addEventListener('click', closeModal);

            window.onclick = function(event) {
                if (event.target == modal) {
                    closeModal();
                }
            };
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.13.216/build/pdf.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.13.216/build/pdf.worker.js"></script>
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
