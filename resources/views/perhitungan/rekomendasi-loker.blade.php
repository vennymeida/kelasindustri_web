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
                                <h4>Data Lowongan Pekerjaan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Lowongan Pekerjaan</th>
                                                <th>Term</th>
                                                <th>Nilai TF</th>
                                                <th>Nilai TF-IDF</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($rekomendasiLokers->isEmpty())
                                                <tr>
                                                    <td colspan="7" class="text-center">Data tidak tersedia</td>
                                                </tr>
                                            @else
                                                @foreach ($rekomendasiLokers as $key => $rekomendasiLoker)
                                                    <tr>
                                                        <td>{{ ($rekomendasiLokers->currentPage() - 1) * $rekomendasiLokers->perPage() + $key + 1 }}
                                                        </td>
                                                        <td>{{ $rekomendasiLoker->document_id }}</td>
                                                        <td>{{ $rekomendasiLoker->word }}</td>
                                                        <td>{{ $rekomendasiLoker->tf_value }}</td>
                                                        <td>{{ $rekomendasiLoker->tfidf_value }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                {{ $rekomendasiLokers->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
