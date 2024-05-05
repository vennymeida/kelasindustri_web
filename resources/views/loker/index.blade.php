@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Lowongan Pekerjaan')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Menu Lowongan Pekerjaan</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Lowongan Pekerjaan</h2>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary" style="border-radius: 15px;">
                        <div class="card-header">
                            <h4>Tabel Lowongan Pekerjaan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('loker.index') }}" method="GET">
                                <div class="form-row text-center">
                                    <div class="form-group col-md-4">
                                        <select name="status" class="form-control" id="statusSelect">
                                            <option value="" selected>-- Pilih Status --</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status }}"
                                                    @if ($status == $selectedStatus) selected @endif>
                                                    {{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="search" placeholder="Cari..."
                                            value="{{ app('request')->input('search') }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('loker.index') }}" class="btn btn-secondary ml-2">Reset</a>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Tipe Pekerjaan</th>
                                                <th>Gaji</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        @if ($allResults->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">Data tidak tersedia</td>
                                            </tr>
                                        @else
                                            @foreach ($allResults as $key => $loker)
                                                <tr>
                                                    <td>
                                                        {{ ($allResults->currentPage() - 1) * $allResults->perPage() + $key + 1 }}
                                                    </td>
                                                    <td>{{ $loker->nama_perusahaan }}</td>
                                                    <td class="text-center">{{ $loker->tipe_pekerjaan }}</td>
                                                    <td>
                                                        {{ 'IDR ' . $loker->gaji_bawah }}<span> - </span>
                                                        {{ $loker->gaji_atas }}
                                                    </td>
                                                    <td>{{ $loker->status }}</td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('loker.edit', $loker->id) }}"
                                                                class="btn btn-sm btn-info btn-icon "><i
                                                                    class="fas fa-edit"></i>
                                                                Edit</a>
                                                            <form action="{{ route('loker.destroy', $loker->id) }}"
                                                                method="POST" class="ml-2" id="del-<?= $loker->id ?>">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <button type="submit" id="#submit"
                                                                    class="btn btn-sm btn-danger btn-icon "
                                                                    data-confirm="Hapus Stop Word ?|Apakah Kamu Yakin?"
                                                                    data-confirm-yes="submitDel(<?= $loker->id ?>)"
                                                                    data-id="del-{{ $loker->id }}">
                                                                    <i class="fas fa-times"> </i> Hapus </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $allResults->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
    <script>
        $(document).ready(function() {
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
                $(".show-search").hide();
            });
            $('.search').click(function(event) {
                event.stopPropagation();
                $(".show-search").slideToggle("fast");
                $(".show-import").hide();
            });
            //ganti label berdasarkan nama file
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });


        });

        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
    <script>
        const statusSelect = document.getElementById('statusSelect');

        statusSelect.addEventListener('change', function() {
            const selectedStatus = statusSelect.value;

            window.location.href = '{{ route('loker.index') }}?status=' + selectedStatus;
        });
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
@push('customScript')
    <script>
        document.getElementById('statusSelect').addEventListener('change', function() {
            document.getElementById('search').submit();
        });
    </script>
@endpush
