@extends('layouts.app')
@section('title', 'JobKelasIndustri - Perhitungan Rekomendasi TF-IDF')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Tabel Perhitungan Rekomendasi</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hasil Perhitungan TF-IDF</h2>

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
                                <h4>Data Lulusan</h4>
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
                                                <th>Term</th>
                                                <th>Nilai TF</th>
                                                <th>Nilai TF-IDF</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($rekomendasiLulusans->isEmpty())
                                                <tr>
                                                    <td colspan="7" class="text-center">Data tidak tersedia</td>
                                                </tr>
                                            @else
                                                @foreach ($rekomendasiLulusans as $key => $rekomendasiLulusan)
                                                    <tr>
                                                        <td>{{ ($rekomendasiLulusans->currentPage() - 1) * $rekomendasiLulusans->perPage() + $key + 1 }}
                                                        </td>
                                                        <td>{{ $rekomendasiLulusan->document_id }}</td>
                                                        <td>{{ $rekomendasiLulusan->word }}</td>
                                                        <td>{{ $rekomendasiLulusan->tf_value }}</td>
                                                        <td>{{ $rekomendasiLulusan->tfidf_value }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                {{ $rekomendasiLulusans->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection