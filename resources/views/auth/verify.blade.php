@extends('landing-page.app')
@section('title', 'WaktuSaku - Verifikasi Akun Anda')
@section('main')
    <section>
        <div class="col-md-10 mx-auto my-5 bg-white px-5 py-5 card-contact" style="border-radius: 15px;">
            <h2 class="section-title">Harap Verifikasi Email Anda</h2>
            <div>{{ __('Verifikasi alamat email Anda') }}</div>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                </div>
            @endif

            {{ __('Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.') }}
            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk verifikasi lagi') }}</button>.
            </form>
        </div>
    </section>
@endsection
