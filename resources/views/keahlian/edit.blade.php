@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Keahlian Pekerjaan')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Table</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Edit Keahlian</h2>
            <div class="card" style="border-radius: 15px;">
                <form action="{{ route('keahlian.update', $keahlian) }}" method="POST">
                    <div class="card-header">
                        <h4>Validasi Edit Data Keahlian</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="keahlian">keahlian</label>
                            <input type="text" class="form-control @error('keahlian') is-invalid @enderror"
                                id="keahlian"name="keahlian" value="{{ $keahlian->keahlian }}"
                                style="border-radius: 15px;">
                            @error('keahlian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('keahlian.index') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
