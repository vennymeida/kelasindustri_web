<!-- Modal Rekrut Karyawan oleh Perusahaan -->
<div class="modal fade" id="modal-rekrut-karyawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                <form method="POST" action="{{ route('create.rekrut', $lulusan->id) }}" class="needs-validation" novalidate=""
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-4 mr-4">
                        <div class="form-group col-md-12 col-12">
                            <label for="loker_id">Lowongan Pekerjaan Yang Tersedia</label>
                            <select class="form-control select2 @error('loker_id') is-invalid @enderror" name="loker_id" id="loker_id">
                                <option value="">Pilih Posisi Pekerjaan</option>
                                @foreach ($lowonganPekerjaans as $loker)
                                    <option value="{{$loker->id}}" @selected(old('loker_id') == $loker->id)>
                                        {{$loker->nama_loker}}
                                    </option>
                                @endforeach
                                {{-- <p>{{$perusahaan}}</p> --}}
                            </select>
                            @error('loker_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
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
                        <div class="form-group col-md-6 col-12">
                            <label>Tanggal Interview</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text custom-input">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input name="tanggal_interview" type="date"
                                    class="form-control custom-input @error('tanggal_interview') is-invalid @enderror"
                                    value="{{ old('tanggal_interview') }}">
                                @error('tanggal_interview')
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
            <div class="bg-primary-section card col-lg-10 col-md-10 col-sm-6 py-1 card-profile1">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-widget-description m-4">
                            @if ($lulusan && $lulusan->foto)
                                <img alt="image" src="{{ Storage::url($lulusan->foto) }}"
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
                        <div class="profile-widget-description ml-4 mr-4 mt-4" style="display: flex; align-items: center;">
                            <div class="flex-grow-1">
                                <div class="profile-widget-name" style="font-weight: bold; font-size: 22px; color: #000000">
                                    {{ $lulusan->name }}</div>
                                <div class="profile-widget-name" style="font-weight: light; font-size: 16px;">
                                    {{ $lulusan->email }}</div>
                                <hr style="background-color:#ebebeb; height: 1px; border: none; width: 90%; float: left;">
                            </div>
                            <div class="d-flex justify-content-end" style="font-size: 2.00em;">
                                <button class="btn btn-primary"
                                    style="background-color:#4ED373; font-size:13px; border-radius:15px;
                                    border-color:#4ED373;margin-right: 10px;">{!! $lulusan->status !!}</button>
                            </div>
                        </div>
                        <div class="col-md-11 ml-2 card-profile2">
                            <div style="display: flex; flex-direction: column;">
                                @if ($lulusan)
                                    @if ($lulusan->alamat != '')
                                        <div class="lulusan-widget-description mb-3"
                                            style="display: flex; align-items: center;">
                                            <img class="img-fluid" style="width: 25px; height: 25px;"
                                                src="{{ asset('assets/img/landing-page/location pin.svg') }}">&nbsp&nbsp<a>{{ $lulusan->alamat }}</a>
                                        </div>
                                    @endif
                                    @if ($lulusan->resume != '')
                                        <div class="profile-widget-description lihat-resume" style=" ">
                                            <a href="{{ Storage::url($lulusan->resume) }}" onclick="return openResume();"
                                                target="_blank" class="btn btn-primary"
                                                style="background-color:#eb9481; font-size:13px; border-radius:15px; border-color:#eb9481; margin-right: 10px;">
                                                Lihat Resume
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                @role('perusahaan')
                                    <div>
                                        <a href="#" class="btn btn-primary"
                                            style="background-color:#6777EF; font-size:13px; border-radius:15px; border-color:#6777EF;"
                                            data-toggle="modal" data-target="#modal-rekrut-karyawan">
                                            Rekrut Karyawan
                                        </a>
                                    </div>
                                @endrole
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
                                        @if ($lulusan && $lulusan->tgl_lahir != '')
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">Tanggal
                                                Lahir&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:
                                                <span
                                                    style="color: #000000; line-height: 2; font-weight:500">&nbsp&nbsp&nbsp&nbsp&nbsp{{ $lulusan->tgl_lahir }}</span>
                                            </span><br><br>
                                        @else
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">Tanggal
                                                Lahir :</span>
                                            <span style="color: #000000; line-height: 2; font-weight:500"><br></span><br>
                                        @endif
                                        @if ($lulusan && $lulusan->jenis_kelamin != '')
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">Jenis
                                                Kelamin&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp&nbsp&nbsp
                                                <span style="color: #000000; line-height: 2; font-weight:500">
                                                    @if ($lulusan->jenis_kelamin == 'P')
                                                        Perempuan
                                                    @elseif ($lulusan->jenis_kelamin == 'L')
                                                        Laki-laki
                                                    @else
                                                        {{ $lulusan->jenis_kelamin }}
                                                    @endif
                                                </span>
                                            </span><br><br>
                                        @else
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">Jenis
                                                Kelamin :</span>
                                            <span style="color: #000000; line-height: 2; font-weight:500"><br></span><br>
                                        @endif
                                        @if ($lulusan && $lulusan->no_hp != '')
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">No
                                                Telepon&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:<span
                                                    style="color: #000000; line-height: 2; font-weight:500">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $lulusan->no_hp }}</span></span><br><br>
                                        @else
                                            <span style="color: #808080; font-size: 15px; font-weight:bold">No Telepon
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
                                    @if ($lulusan && $lulusan->ringkasan != '')
                                        <div class="text-left mb-4 mt-2 ml-2"
                                            style="color: #000000; line-height: 2; font-weight:500;">
                                            {!! $lulusan->ringkasan !!}</div>
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
        <section class="centered-section my-4">
            <div class="bg-primary-section card col-md-10 py-2 card-profile4 ">
                <div class="profile-widget-description m-3"
                    style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                    <div class="flex-grow-1">
                        <div class="profile-widget-name" style="color:#6777ef;">Cerita / Postingan</div>
                    </div>
                </div>
                @if ($userPosts && count($userPosts) > 0)
                    <div id="postingan-container">
                        <div class="col-md-12">
                            @foreach ($userPosts as $post)
                                <hr>
                                <div class="font-italic mt-2 time" style="font-size: 14px;">
                                    {{ $post->user->name }} - {{ $post->timeAgo }}
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
                                        </div>
                                    @else
                                        <div class="media-body col-md-10 mr-5">
                                            {!! $post->konteks !!}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-right my-4 mr-5">
                        <a href="{{ route('postingan.index') }}" class="" style="font-size: 16px;">Lihat Lainnya .
                            . .</a>
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
            <div class="bg-primary-section card col-md-10 py-1 card-profile6">
                <div class="profile-widget-description m-3"
                    style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                    <div class="flex-grow-1">
                        <div class="profile-widget-name" style="color:#6777ef;">Pendidikan</div>
                    </div>
                </div>
                @if (count($pendidikan) > 0)
                    <div id="pendidikan-container" class="pendidikancardprofile">
                        @foreach ($pendidikan as $item)
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
                        @endforeach
                    </div>
                    <div class="text-right mt-4 mr-4">
                        <button id="load-more" class="btn btn-more mb-3"
                            data-page="{{ $pendidikan->currentPage() }}">Muat Lebih Banyak . . .</button>
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
                    </div>
                </div>
                @if (count($pengalaman) > 0)
                    <div id="pengalaman-container" class="pendidikancardprofile">
                        @foreach ($pengalaman as $pl)
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
                                </div>
                                <div class="col-md-12">
                                    <div class="flex-grow-1 mb-2">
                                        <div class="profile-widget-name"
                                            style="font-size: 16px; display: flex; align-items: center;">
                                            {{ $pl->nama_instansi }} | {{ $pl->alamat }}
                                        </div>
                                    </div>
                                    <ul class="list-unstyled ml-2">
                                        <li class="mb-2"><img class="img-fluid"
                                                src="{{ asset('assets/img/landing-page/Hourglass.svg') }}">&nbsp&nbsp&nbsp{{ $pl->tipe }}
                                        </li>
                                        <li class="mb-2"><img class="img-fluid"
                                                src="{{ asset('assets/img/landing-page/Time.svg') }}">&nbsp&nbsp&nbsp{{ $pl->tgl_mulai }}
                                            - {{ $pl->tgl_selesai }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-right mt-4 mr-4">
                        <button id="load-more-pengalaman" class="btn btn-more mb-3"
                            data-page="{{ $pengalaman->currentPage() }}">Muat Lebih Banyak . . .</button>
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
                </div>
                @if (count($pelatihan) > 0)
                    <div id="pelatihan-container" class="pendidikancardprofile">
                        @foreach ($pelatihan as $lat)
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
                            data-page="{{ $pelatihan->currentPage() }}">Muat Lebih Banyak . . .</button>
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
