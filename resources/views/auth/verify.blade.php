@extends('landing-page.app')
@section('title', 'JobsKelasIndustri - Registrasi Akun')
@section('main')
    <section>
        <div class="col-md-10 mx-auto my-5 bg-white px-5 py-5 card-contact" style="border-radius: 15px;">
            <h2 class="section-title">Harap Tunggu ! Akun Anda Sedang di Proses Oleh Admin</h2>
            <div>{{ __('Menunggu Verifikasi Akun Oleh Admin') }}</div>
            {{ __('Sebelum melanjutkan, silakan periksa email Anda untuk mengetahui apakah akun Anda telah terverifikasi.') }}
        </div>
    </section>
@endsection
