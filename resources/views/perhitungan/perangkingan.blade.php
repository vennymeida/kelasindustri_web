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
                                <button class="btn btn-secondary" onclick="printTable()">Print</button>
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
                                            <a id="reset-button" class="btn btn-secondary" href="">Reset</a>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Ringkasan Lulusan</th>
                                                <th>Keahlian</th>
                                                <th>Loker Persayaratan</th>
                                                <th>Loker Deskripsi</th>
                                                <th>Loker Keunggulan</th>
                                                <th>Action Nilai</th>
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
                                                        <td>{{ ($perangkingans->currentPage() - 1) * $perangkingans->perPage() + $key + 1 }}</td>
                                                        <td>{{ $perangkingan->ringkasan }}</td>
                                                        <td>{{ $perangkingan->keahlian }}</td>
                                                        <td>{{ $perangkingan->persyaratan }}</td>
                                                        <td>{{ $perangkingan->deskripsi }}</td>
                                                        <td>{{ $perangkingan->syaratkeahlian }}</td>
                                                        <td>
                                                            <button class="btn btn-primary" onclick="toggleDetails({{ $key }})">Details nilai</button>
                                                        </td>
                                                    </tr>
                                                    <tr id="details{{ $key }}" style="display:none;">
                                                        <td colspan="7">
                                                            <h4 class="mt-4" style="font-size:15px;">Nilai Perangkingan</h4>
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th>Score Lulusan </th>
                                                                    <th>Score Keahlian </th>
                                                                    <th>Lulusan</th>
                                                                    <th>Keahlian</th>
                                                                    <th>Loker</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{ number_format($perangkingan->score_similarity_lulusan * 100, 2) }}%</td>
                                                                    <td>{{ number_format($perangkingan->score_similarity_keahlian * 100, 2) }}%</td>
                                                                    <td>{{ $perangkingan->lulusan_id }}</td>
                                                                    <td>{{ $perangkingan->keahlian_id }}</td>
                                                                    <td>{{ $perangkingan->loker_id }}</td>
                                                                </tr>
                                                            </table>
                                                        </td>
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

@push('customScript')

<script>
    let lastOpened = null;
    
    function toggleDetails(key) {
        var detailsRow = document.getElementById('details' + key);
    
        if (lastOpened && lastOpened !== detailsRow) {
            lastOpened.style.display = 'none';
        }
    
        if (detailsRow.style.display === 'none') {
            detailsRow.style.display = '';
            lastOpened = detailsRow;
        } else {
            detailsRow.style.display = 'none';
            lastOpened = null;
        }
    }
    
    function printTable() {
        var content = document.querySelector('.card-body').innerHTML;
        var originalContent = document.body.innerHTML;
    
        document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = originalContent;
    }
    </script>
    
        
@endpush

@push('customStyle')
<style>
    @media print {
        button, .form-row {
            display: none;
        }
    }
    </style>
    
@endpush
