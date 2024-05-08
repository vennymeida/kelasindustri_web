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
        @if (Auth::user()->perusahaan && $perusahaan)
            <section>
                <div class="col-md-12 detail-header">
                    <div class="col-md-10 mx-auto">
                        <ul class="list-unstyled">
                            <ul class="list-unstyled d-flex justify-content-start title-detail">
                                <li class="col-md-4 d-flex justify-content-start mr-5 mt-3">
                                    <img class="img-fluid img-icon mr-2"
                                        src="{{ asset('assets/img/landing-page/phone.svg') }}">
                                    <p class="mb-3 detail-left" style="font-size: 15px;">
                                        {{ $perusahaan->no_telp ?? 'Tidak tersedia' }}
                                    </p>
                                </li>
                                <li class="col-md-8 mt-3 detail-right">
                                    <h5 class="font-weight-bolder">
                                        {{ $perusahaan->nama_perusahaan ?? 'Nama Perusahaan Tidak Tersedia' }} -
                                        {{ $perusahaan->nama_pemilik ?? 'Nama Pemilik Tidak Tersedia' }}</h5>
                                </li>
                            </ul>
                            <ul class="list-unstyled d-flex justify-content-start text-justify title-detail">
                                <li class="col-md-4 d-flex justify-content-start mr-5">
                                    <img class="img-fluid img-icon mr-2"
                                        src="{{ asset('assets/img/landing-page/Email.svg') }}">
                                    <p class="mb-3 detail-left" style="font-size: 15px;">
                                        {{ $perusahaan->email_perusahaan ?? 'Email Tidak Tersedia' }}</p>
                                </li>
                                <li class="col-md-8">
                                    <p class="detail-right" style="font-size: 15px;">
                                        {!! $perusahaan->deskripsi ?? 'Deskripsi Tidak Tersedia' !!}
                                    </p>
                                </li>
                            </ul>
                            <ul class="list-unstyled d-flex justify-content-start title-detail">
                                <li class="col-md-2 d-flex justify-content-start mr-5 detail-web">
                                    <img class="img-fluid img-icon mr-2"
                                        src="{{ asset('assets/img/landing-page/global.svg') }}">
                                    <p class="mb-3 detail-left" style="font-size: 15px;">
                                        {{$perusahaan->website ?? 'Website Tidak Tersedia' }}</p>
                                </li>
                            </ul>
                            <li class="  col-md-12 d-flex justify-content-end ml-5 detail-alamat">
                                <img class="img-fluid img-icon mr-1"
                                    src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                <p class="mb-5 detail-alamat-bottom" style="font-size: 15px;">
                                    {{$perusahaan->alamat_perusahaan ?? 'Alamat Tidak Tersedia' }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <div class="col-md-10 mx-auto mb-4">
                <div class="col-md-3">
                    <img class="img-fluid bg-white mt-4 img-detail-profile"
                        src="{{ asset('storage/' . ($perusahaan->logo_perusahaan ?? 'assets/img/avatar/avatar-1.png')) }}"
                        style="width: 100%; background: linear-gradient(to bottom, rgb(196, 204, 213, 0.2), rgb(196, 204, 213, 0.7)); border-radius: 30px;">
                </div>
            </div>
        @else
            <div class="col-md-12 text-center">
                <p class="mt-5" style="font-size: 18px;">Data perusahaan belum diisi.</p>
                <img src="{{ asset('assets/img/landing-page/no-data.svg') }}" alt="No Data" style="width: 200px; height: 200px;">
            </div>
        @endif
    </div>
</main>
@endsection
