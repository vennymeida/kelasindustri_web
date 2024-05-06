@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Keahlian Pekerjaan')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>Menu Keahlian</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Keahlian</h2>

            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary" style="border-radius: 15px;">
                        <div class="card-header">
                            <h4>Tabel Keahlian</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('keahlian.create') }}">Tambah
                                    Keahlian Baru</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('keahlian.index') }}">
                                <div class="form-row text-center">
                                    <div class="form-group col-md-10">
                                        <input type="text" name="keahlian" class="form-control" id="keahlian"
                                            placeholder="Cari...." value="{{ app('request')->input('keahlian') }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button id="submit-button" class="btn btn-primary mr-1"
                                            type="submit">Submit</button>
                                        <a id="reset-button" class="btn btn-secondary"
                                            href="{{ route('keahlian.index') }}">Reset</a>
                                    </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Keahlian</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    @if ($keahlians->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">Data tidak tersedia</td>
                                        </tr>
                                    @else
                                        @foreach ($keahlians as $key => $keahlian)
                                            <tr>
                                                <td>{{ ($keahlians->currentPage() - 1) * $keahlians->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $keahlian->keahlian }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('keahlian.edit', $keahlian->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "><i
                                                                class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <form action="{{ route('keahlian.destroy', $keahlian->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Hapus </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $keahlians->withQueryString()->links() }}
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
