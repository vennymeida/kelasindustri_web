@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Kota/Kabupaten')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Table Kota/Kabupaten</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Tambah Kota</h2>

            <div class="card" style="border-radius: 15px;">
                <div class="card-header">
                    <h4>Validasi Tambah Kota</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kota.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control @error('kota') is-invalid @enderror"
                                id="kota" name="kota" placeholder="Enter Kota" style="border-radius: 15px;">
                            @error('kota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('kota.index') }}">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
