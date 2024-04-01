@extends('landing-page.app')
@section('title', 'JobsKelasIndustri - Profile Perusahaan')
@section('main')
        <main class="bg-light">
            <br><br>
            <div class="col-md-11 bg-white mx-auto py-4 mb-0" style="border-radius: 20px;">
                <h4 class="text-center mt-4" style="text-align: center; font-weight: bold;">Data Perusahaan</h4>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-11 d-flex justify-content-end" style="font-size: 2.00em;" id="fluid">
                            <a href="{{ url('/profile-perusahaan-edit') }}">
                                <img class="img-fluid" style="width: 35px; height: 35px;"
                                    src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                            </a>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="col-md-12 detail-header">
                        <div class="col-md-10 mx-auto">
                            <ul class="list-unstyled">
                                <ul class="list-unstyled d-flex justify-content-start title-detail">
                                    @if (Auth::user()->perusahaan && Auth::user()->perusahaan->no_telp != '')
                                        <li class="col-md-4 d-flex justify-content-start mr-5 mt-3">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/phone.svg') }}">
                                            <p class="mb-3 detail-left" style="font-size: 15px;">
                                                {{ Auth::user()->perusahaan->no_telp }}
                                            </p>
                                        </li>
                                    @else
                                        <li class="col-md-4 d-flex justify-content-start mr-5 mt-3">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/phone.svg') }}">
                                            <p class="mb-3 detail-left" style="font-size: 15px;"></p>
                                        </li>
                                    @endif
                                    <li class="col-md-8 mt-3 detail-right">
                                        <h5 class="font-weight-bolder">
                                            {{ Auth::user()->perusahaan->nama_perusahaan }} -
                                            {{ Auth::user()->perusahaan->nama_pemilik }}</h5>
                                    </li>
                                </ul>
                                <ul class="list-unstyled d-flex justify-content-start text-justify title-detail">
                                    @if (Auth::user()->perusahaan && Auth::user()->perusahaan->email_perusahaan != '')
                                        <li class="col-md-4 d-flex justify-content-start mr-5">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/Email.svg') }}">
                                            <p class="mb-3 detail-left" style="font-size: 15px;">
                                                {{ Auth::user()->perusahaan->email_perusahaan }}</p>
                                        </li>
                                    @else
                                        <li class="col-md-4 d-flex justify-content-start mr-5">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/Email.svg') }}">
                                            <p class="mb-3 detail-left" style="font-size: 15px;">&nbsp</p>
                                        </li>
                                    @endif
                                    <li class="col-md-8">
                                        <p class="detail-right" style="font-size: 15px;">
                                            {!! Auth::user()->perusahaan->deskripsi !!}
                                        </p>
                                    </li>
                                </ul>
                                <ul class="list-unstyled d-flex justify-content-start title-detail">
                                    @if (Auth::user()->perusahaan && Auth::user()->perusahaan->website != '')
                                        <li class="col-md-2 d-flex justify-content-start mr-5 detail-web">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/global.svg') }}">
                                            <p class="mb-3 detail-left" style="font-size: 15px;">
                                                {{ Auth::user()->perusahaan->website }}</p>
                                        </li>
                                    @else
                                        <li class="col-md-2 d-flex justify-content-start mr-5 detail-web">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/global.svg') }}">
                                            <p class="mb-3 detail-left" style="font-size: 15px;">&nbsp</p>
                                        </li>
                                    @endif
                                </ul>
                                @if (Auth::user()->perusahaan && Auth::user()->perusahaan->alamat_perusahaan != '')
                                    <li class="col-md-12 d-flex justify-content-end ml-5 detail-alamat">
                                        <img class="img-fluid img-icon mr-1"
                                            src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                        <p class="mb-5 detail-alamat-bottom" style="font-size: 15px;">
                                            {{ Auth::user()->perusahaan->alamat_perusahaan }}
                                        </p>
                                    </li>
                                @else
                                    <li class="col-md-12 d-flex justify-content-end ml-5 detail-alamat">
                                        <img class="img-fluid img-icon mr-1"
                                            src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                        <p class="mb-5 detail-alamat-bottom" style="font-size: 15px;">&nbsp&nbsp&nbsp</p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </section>
                <div class="col-md-10 mx-auto mb-4">
                    <div class="col-md-3">
                        @if (Auth::user()->perusahaan && Auth::user()->perusahaan->logo_perusahaan != '')
                            <img class="img-fluid bg-white mt-4 img-detail-profile"
                            src="{{ asset('storage/' . Auth::user()->perusahaan->logo_perusahaan) }}"
                                style="width: 100%; background: linear-gradient(to bottom, rgb(196, 204, 213, 0.2), rgb(196, 204, 213, 0.7)); border-radius: 30px;">
                        @else
                            <img class="img-fluid bg-white mt-4 img-detail-profile"
                                src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                style="width: 100%; background: linear-gradient(to bottom, rgb(196, 204, 213, 0.2), rgb(196, 204, 213, 0.7)); border-radius: 30px;">
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </main>
@endsection
