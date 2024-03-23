@extends('layouts.app')
@section('title', 'JobKelasIndustri - Perhitungan Rekomendasi TF-IDF')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Tabel Perhitungan Rekomendasi</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hasil Perhitungan Cosine Similarity</h2>

            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card card-primary" style="border-radius: 15px;">
                            <div class="card-header">
                                <h4>Data Perangkingan Rekomendasi</h4>
                            </div>
                            <div class="card-body">
                                <form id="search-form" method="GET" action="">
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Search...." value="{{ app('request')->input('name') }}"
                                                style="border-radius: 15px;">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button id="search-button" class="btn btn-primary mr-1"
                                                type="submit">Search</button>
                                            <a id="reset-button" class="btn btn-secondary"
                                                href="">Reset</a>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Lulusan</th>
                                                <th>ID Loker</th>
                                                <th>Nilai Similarity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($perangkingans->isEmpty())
                                                <tr>
                                                    <td colspan="7" class="text-center">Data tidak tersedia</td>
                                                </tr>
                                            @else
                                                @foreach ($perangkingans as $key => $perangkingan)
                                                    <tr>
                                                        <td>{{ ($perangkingans->currentPage() - 1) * $perangkingans->perPage() + $key + 1 }}
                                                        </td>
                                                        <td>{{ $perangkingan->lulusan_id }}</td>
                                                        <td>{{ $perangkingan->loker_id }}</td>
                                                        <td>{{ $perangkingan->score_similarity}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                {{ $perangkingans->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
