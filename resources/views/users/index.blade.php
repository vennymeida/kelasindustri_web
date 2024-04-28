@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Seluruh Pengguna')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Daftar Pengguna</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Manajemen Pengguna</h2>

            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary" style="border-radius: 15px;">
                        <div class="card-header">
                            <h4>User List</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('user.create') }}">Create New
                                    User</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.index') }}" method="GET" class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="name">Search by Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ request()->query('name') }}" style="border-radius: 15px;">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="roles">Filter by Roles</label>
                                        <div class="d-flex">
                                            <select name="roles[]" class="form-control select2">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}"
                                                        {{ in_array($role->name, request()->query('roles', [])) ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="ml-2 d-flex">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                                <a href="{{ route('user.index') }}" class="btn btn-secondary ml-2">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th class="text-right">Verify Email</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($users->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">Data tidak tersedia</td>
                                            </tr>
                                        @else
                                            @foreach ($users as $key => $user)
                                                <tr>
                                                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}
                                                    </td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @foreach ($user->roles as $role)
                                                            {{ $role->name }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end">
                                                            @if (is_null($user->email_verified_at))
                                                                <form action="{{ route('user.verify-email', ['id' => $user->id, 'hash' => sha1($user->email)]) }}" method="POST" class="d-inline-block" id="vel-<?= $user->id ?>">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-primary ml-2" data-confirm="Verifikasi Data User |Apakah Kamu Yakin Verifikasi ?" data-confirm-yes="submitVeri(<?= $user->id ?>)" data-id="vel-{{ $user->id }}">Verify Email</button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('user.verify-email', ['id' => $user->id, 'hash' => sha1($user->email)]) }}" method="POST" class="d-inline-block" id="vel-<?= $user->id ?>">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger ml-2" data-confirm="Verifikasi Data User |Apakah Kamu Yakin Batalkan Verifikasi ?" data-confirm-yes="submitVeri(<?= $user->id ?>)" data-id="vel-{{ $user->id }}">Hapus Verify Email</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="d-flex justify-content-end">
                                                            <!-- Show button to view user details -->
                                                            <a href="#"
                                                                class="btn btn-sm btn-primary btn-icon show-user-details"
                                                                data-toggle="modal"
                                                                data-target="#detailsModal{{ $user->id }}">
                                                                <i class="fas fa-eye"></i> Show
                                                            </a>
                                                            <!-- Move the delete button form here -->
                                                            <form action="{{ route('user.destroy', $user->id) }}"
                                                                method="POST" class="ml-2">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                    <i class="fas fa-times"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $users->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($users as $user)
    <div class="modal fade" id="detailsModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel{{ $user->id }}">Detail Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th>Name Pengguna</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Bergabung Sejak</th>
                            <td>
                                @if ($user->email_verified_at)
                                    {{ date('j F Y', strtotime($user->email_verified_at)) }}
                                @else
                                    Akses Ditolak
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Roles</th>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Bukti Lulusan</th>
                            <td>
                                @if ($user->document)
                                    <a href="{{ asset('documents/' . $user->document) }}" target="_blank">Lihat Dokumen</a> <!-- Tautan ke dokumen -->
                                @else
                                    Tidak ada dokumen
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@push('customScript')
    <script>
        $(document).ready(function() {
            $('.search').click(function(event) {
                event.stopPropagation();
                $(".show-search").slideToggle("fast");
                $(".show-import").hide();
            });

            // Show user details in modal
            $('.show-user-details').click(function(event) {
                event.preventDefault();
                var targetModal = $(this).data('target');
                $(targetModal).modal('show');
            });

            // ganti label berdasarkan nama file
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });
    </script>
@endpush

@push('customStyle')
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }

        function submitVeri(id) {
            $('#vel-' + id).submit()
        }

    </script>
@endpush

@push('customStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
