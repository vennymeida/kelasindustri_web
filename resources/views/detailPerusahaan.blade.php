@extends('landing-page.app')
@section('title', 'JobKelasIndustri - Detail Informasi Perusahaan')
@section('main')
    <main class="bg-light">
        <div class="col-md-12">
            <div class="col-md-11 mx-auto">
                <a href="{{ route('all-jobs.index') }}">
                    <img class="img-fluid img-icon mt-3" src="{{ asset('assets/img/landing-page/back.svg') }}"
                        style="width: 30px; height: auto;">
                </a>
            </div>
        </div>

        <section>
            <div class="col-md-12 detail-header">
                <div class="col-md-10 mx-auto">
                    <ul class="list-unstyled">
                        <ul class="list-unstyled d-flex justify-content-start title-detail">
                            <li class="col-md-4 d-flex justify-content-start mr-5 mt-3">
                                <img class="img-fluid img-icon mr-2" src="{{ asset('assets/img/landing-page/phone.svg') }}">
                                <p class="mb-3 detail-left" style="font-size: 15px;">{{ $detail->no_hp_perusahaan }} </p>
                            </li>
                            <li class="col-md-8 mt-3 detail-right">
                                <h5 class="font-weight-bolder">{{ $detail->nama }} </h5>
                            </li>
                        </ul>
                        <ul class="list-unstyled d-flex justify-content-start text-justify title-detail">
                            <li class="col-md-4 d-flex justify-content-start mr-5">
                                <img class="img-fluid img-icon mr-2" src="{{ asset('assets/img/landing-page/Email.svg') }}">
                                <p class="mb-3 detail-left" style="font-size: 15px;">{{ $detail->email }} </p>
                            </li>
                            <li class="col-md-8">
                                <p class="detail-right" style="font-size: 15px;">
                                    {!! $detail->deskripsi !!} </p>
                            </li>
                        </ul>
                        <ul class="list-unstyled d-flex justify-content-start title-detail">
                            <li class="col-md-2 d-flex justify-content-start mr-5 detail-web">
                                <img class="img-fluid img-icon mr-2"
                                    src="{{ asset('assets/img/landing-page/global.svg') }}">
                                <p class="mb-3 detail-left" style="font-size: 15px;">{{ $detail->website }} </p>
                            </li>
                        </ul>
                        <li class="col-md-7 d-flex justify-content-end text-justify detail-alamat"
                            style="margin-left: 45%;">
                            <img class="img-fluid img-icon mr-1"
                                src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                            <p class="mb-5 detail-alamat-bottom" style="font-size: 15px;">{{ $detail->alamat_perusahaan }},
                                {{ $detail->kelurahan->kelurahan }},
                                {{ $detail->kecamatan->kecamatan }} </p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="col-md-10 mx-auto">
            <div class="col-md-3">
                <div class="logo-container">
                    <img class="img-fluid bg-white mt-4 img-detail" src="{{ asset('storage/' . $detail->logo) }}"
                        style="width: 75%; background: linear-gradient(to bottom, rgb(196, 204, 213, 0.2), rgb(196, 204, 213, 0.7)); border-radius: 30px;">
                </div>
            </div>
        </div>

        <section>
            <div class="col-md-12 mt-5 detail-all">
                <div class="col-md-10 mx-auto">
                    <ul class="list-unstyled">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <h5 class="font-weight-bolder">Lowongan Kerja</h5>
                            <a class="text-primary font-weight-bolder" href="{{ route('all-jobs.index') }}">Lihat
                                lainnya</a>
                        </ul>
                    </ul>
                </div>
            </div>
        </section>

        @if (Auth::guest() || (Auth::check() && Auth::user()->hasRole('Pencari Kerja')))
            <section>
                <div class="col-md-12 mt-4 mx-auto d-flex flex-wrap justify-content-center">
                    @foreach ($lokers as $loker)
                        <div class="card col-md-3 mb-4 mx-4">
                            <div class="card-body d-flex flex-column">
                                <div class="position-relative">
                                    <div class="gradient-overlay"></div>
                                    <img class="img-fluid mb-3 fixed-height-image position-absolute top-0 start-50 translate-middle-x"
                                        src="{{ asset('storage/' . $detail->logo) }}" alt="Company Logo">
                                    <p class="text-white card-title font-weight-bold mb-0 ml-2 overlap-text"
                                        style="font-size: 20px;">
                                        {{ $loker->judul }}
                                    </p>
                                    <a class="text-white ml-2 overlap-text-2" style="font-size: 14px;">
                                        {{ $detail->nama }}
                                    </a>
                                </div>
                                <div class="card-text mt-4">
                                    <ul class="list-unstyled ml-2">
                                        <ul class="list-unstyled d-flex justify-content-between">
                                            <li class="d-flex justify-content-start">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/list.svg') }}">
                                                <p class="mb-2">{{ $loker->kategori }}</p>
                                            </li>
                                            <li class="mb-2">
                                                @if (auth()->check() &&
                                                        auth()->user()->hasRole('Pencari Kerja'))
                                                    <a href="javascript:void(0);"
                                                        class="bookmark-icon text-right"data-loker-id="{{ $loker->id }}">
                                                        <i class="far fa-bookmark" style="font-size: 20px;"></i>
                                                    </a>
                                                @endif
                                            </li>
                                        </ul>
                                        <li class="d-flex justify-content-start">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/money.svg') }}">
                                            <p class="mb-2">{{ 'IDR ' . $loker->gaji_bawah }}
                                                <span>-</span>
                                                {{ $loker->gaji_atas }}
                                            </p>
                                        </li>
                                        <li class="d-flex justify-content-start">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/job.svg') }}">
                                            <p class="mb-2">{{ $loker->min_pengalaman }}</p>
                                        </li>
                                        <li class="d-flex justify-content-start">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                            <p class="mb-2">Minimal {{ $loker->min_pendidikan }}</p>
                                        </li>
                                        <li class="d-flex justify-content-start">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                            <p class="mb-2">{{ $loker->lokasi }}</p>
                                        </li>
                                        <li class="d-flex justify-content-start">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/Office Building.svg') }}">
                                            <p class="mb-2">{{ $detail->alamat_perusahaan }},
                                                {{ $detail->kelurahan->kelurahan }},
                                                {{ $detail->kecamatan->kecamatan }}</p>
                                        </li>
                                    </ul>
                                </div>
                                @role('Pencari Kerja')
                                    <div class="text-center mb-3">
                                        <a id="detail-button" class="btn btn-primary px-4 py-2" style="border-radius: 25px;"
                                            href="{{ route('all-jobs.show', $loker->id) }}">Lihat Detail</a>
                                    </div>
                                @endrole
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <div class="d-flex justify-content-center mt-5">
                {{ $lokers->withQueryString()->links() }}
            </div>
        @endif
        @role('Perusahaan')
            <section>
                <div class="col-md-12 mt-4 mx-auto d-flex flex-wrap justify-content-center">
                    @if ($lowonganPekerjaan->isEmpty())
                        <p class="mt-4">Data Tidak Tersedia</p>
                    @else
                        @foreach ($lowonganPekerjaan as $loker)
                            <div class="card col-md-5 mb-3 mx-2">
                                <div class="card-body d-flex flex-column">
                                    <ul class="list-unstyled">
                                        <ul class="list-unstyled d-flex justify-content-between align-items-center">
                                            <li class="font-weight-bold p-loker">Posisi : {{ $loker->judul }}</li>
                                        </ul>
                                        <li class="mb-2"><img class="img-fluid img-icon"
                                                src="{{ asset('assets/img/landing-page/money.svg') }}">
                                            {{ 'IDR ' . $loker->gaji_bawah }}
                                            <span>-</span>
                                            {{ $loker->gaji_atas }}
                                        </li>
                                        <li class="mb-2"><img class="img-fluid img-icon"
                                                src="{{ asset('assets/img/landing-page/job.svg') }}">
                                            {{ $loker->min_pengalaman }}
                                        </li>
                                        <li class="mb-2"><img class="img-fluid img-icon"
                                                src="{{ asset('assets/img/landing-page/hourglass.svg') }}">
                                            {{ $loker->tipe_pekerjaan }}
                                        </li>
                                        <li class="mb-2"><img class="img-fluid img-icon"
                                                src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                            Minimal {{ $loker->min_pendidikan }}
                                        </li>
                                        <li class="mb-2">
                                            Keahlian : {{ $loker->keahlian }}
                                        </li>
                                        <a href="{{ route('all-jobs.show', $loker->id) }}" class="mb-2 font-italic"
                                            style="font-size: 14px">
                                            Lihat Selengkapnya...
                                        </a>
                                        <ul class="list-unstyled d-flex justify-content-between align-items-center mt-2">
                                            <button
                                                class="px-4 mt-2 mr-1 btn btn-status
                                        @if ($loker->status === 'Pending') btn-warning
                                        @elseif ($loker->status === 'Dibuka') btn-success
                                        @elseif ($loker->status === 'Ditutup') btn-secondary @endif">
                                                {{ $loker->status }}
                                            </button>
                                            <li class="font-italic time" style="font-size: 14px;"><img
                                                    class="img-fluid img-icon"
                                                    src="{{ asset('assets/img/landing-page/Time.svg') }}">
                                                {{ $loker->timeAgo }}
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
            <div class="d-flex justify-content-center mt-5">
                {{ $lowonganPekerjaan->withQueryString()->links() }}
            </div>
        @endrole
    </main>
@endsection
