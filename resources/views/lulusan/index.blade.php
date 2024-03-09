@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Lulusan')

@section('content')
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>User Lulusan List</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Lulusan Management</h2>

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
                                <h4>Lulusan List</h4>
                            </div>
                            <div class="card-body">
                                <form id="search-form" method="GET" action="{{ route('lulusan.index') }}">
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
                                                href="{{ route('lulusan.index') }}">Reset</a>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>Jenis Kelamin</th>
                                                <th>No Telp</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($lulusan->isEmpty())
                                                <tr>
                                                    <td colspan="7" class="text-center">Data tidak tersedia</td>
                                                </tr>
                                            @else
                                                @foreach ($lulusan as $key => $user)
                                                    <tr>
                                                        <td>{{ ($lulusan->currentPage() - 1) * $lulusan->perPage() + $key + 1 }}
                                                        </td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ optional($user->profile)->alamat ?: '-' }}</td>
                                                        <td>
                                                            @if ($user->profile)
                                                                @if ($user->profile->jenis_kelamin === 'L')
                                                                    Laki-Laki
                                                                @elseif ($user->profile->jenis_kelamin === 'P')
                                                                    Perempuan
                                                                @else
                                                                    {{ $user->profile->jenis_kelamin }}
                                                                @endif
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{ optional($user->profile)->no_hp ?: '-' }}</td>
                                                        <td>
                                                            <a href="{{ route('lulusan.show', $user) }}"
                                                                class="btn btn-sm btn-primary btn-icon">
                                                                <i class="fas fa-eye"></i> Details
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                {{ $lulusan->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
