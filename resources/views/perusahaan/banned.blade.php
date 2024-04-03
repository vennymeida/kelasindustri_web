@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Perusahaan Banned')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Perusahaan User List</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Perusahaan Management</h2>

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
                                <h4>List Perusahaan Banned</h4>
                            </div>
                            <div class="card-body">
                                <form id="search-form" method="GET" action="{{ route('perusahaan.index') }}">
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
                                                href="{{ route('perusahaan.index') }}">Reset</a>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pemilik</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>No Telp</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($perusahaanData->isEmpty())
                                                <tr>
                                                    <td colspan="7" class="text-center">Data tidak tersedia</td>
                                                </tr>
                                            @else
                                                @foreach ($perusahaanData as $key => $perusahaan)
                                                    <tr>
                                                        <td>{{ ($perusahaanData->currentPage() - 1) * $perusahaanData->perPage() + $key + 1 }}
                                                        </td>
                                                        <td>{{ $perusahaan->nama_pemilik }}</td>
                                                        <td>{{ optional($perusahaan)->nama_perusahaan ?: '-' }}</td>
                                                        <td>{{ optional($perusahaan)->email_perusahaan ?: '-' }}</td>
                                                        <td>{{ optional($perusahaan)->alamat_perusahaan ?: '-' }}
                                                        </td>
                                                        <td>{{ optional($perusahaan)->no_telp ?: '-' }}
                                                        <td>
                                                            <form
                                                                action="{{ route('perusahaan-status.update', $perusahaan->id) }}"
                                                                method="post" id="rej-<?= $perusahaan->id ?>"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-warning btn-icon"
                                                                    data-confirm="Verifikasi Biodata | Apakah data biodata belum bisa diverifikasi dan kirim pesan kesalahan ?"
                                                                    data-confirm-yes="sumbitRej(<?= $perusahaan->id ?>)"
                                                                    data-id="rej-{{ $perusahaan->id }}">
                                                                    Unbanned
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                {{ $perusahaanData->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customStyle')
    <script>
        function sumbitRej(id) {
            $('#rej-' + id).submit()
        }
    </script>
@endpush
