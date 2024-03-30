@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Stop Word')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Table Stop Word</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Edit Stop Word</h2>

            <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                    <form action="{{ route('stop-word.update', $stopWord) }}" method="POST">
                        <div class="card-header">
                            <h4>Validasi Edit Data Kota</h4>
                        </div>
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="stop word">Stop Word</label>
                                <input type="text" class="form-control @error('text') is-invalid @enderror"
                                    id="text" name="text" value="{{ $stopWord->text }}"
                                    style="border-radius: 15px;">
                                @error('text')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                                <a class="btn btn-secondary" href="{{ route('stop-word.index') }}">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>
    </section>
@endsection
