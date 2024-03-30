@extends('layouts.app')
@section('title', 'JobKelasIndustri - Daftar Stop Word')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header" style="border-radius: 15px;">
            <h1>List Stop Word</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Stop Word Management</h2>

            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary" style="border-radius: 15px;">
                        <div class="card-header">
                            <h4>Stop Word List</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('stop-word.create') }}">Tambah
                                    Stop Word Baru</a>
                                <a class="btn btn-info btn-primary active search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Cari Stop Word</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <div class="show-search mb-3"
                                style="display: {{ app('request')->input('kota') ? 'block' : 'none' }};">
                                <form id="search" method="GET" action="{{ route('kota.index') }}">
                                    <div class="form-row text-center">
                                        <div class="form-group col-md-10">
                                            <input type="text" name="kota" class="form-control" id="kota"
                                                placeholder="Cari...." value="{{ app('request')->input('kota') }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button id="submit-button" class="btn btn-primary mr-1"
                                                type="submit">Submit</button>
                                            <a id="reset-button" class="btn btn-secondary"
                                                href="{{ route('kota.index') }}">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Text</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        @if ($stopWord->isEmpty())
                                            <tr>
                                                <td colspan="3" class="text-center">Data tidak tersedia</td>
                                            </tr>
                                        @else
                                            @foreach ($stopWord as $key => $listStopWord)
                                                <tr>
                                                    <td>{{ ($stopWord->currentPage() - 1) * $stopWord->perPage() + $key + 1 }}
                                                    </td>
                                                    <td>{{ $listStopWord->text }}</td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('stop-word.edit', $listStopWord->id) }}"
                                                                class="btn btn-sm btn-info btn-icon "><i
                                                                    class="fas fa-edit"></i>
                                                                Edit</a>
                                                            <form
                                                                action="{{ route('stop-word.destroy', $listStopWord->id) }}"
                                                                method="POST" class="ml-2"
                                                                id="del-<?= $listStopWord->id ?>">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <button type="submit" id="#submit"
                                                                    class="btn btn-sm btn-danger btn-icon "
                                                                    data-confirm="Hapus Stop Word ?|Apakah Kamu Yakin?"
                                                                    data-confirm-yes="submitDel(<?= $listStopWord->id ?>)"
                                                                    data-id="del-{{ $listStopWord->id }}">
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
                                    {{ $stopWord->withQueryString()->links() }}
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
        const inputElement = document.getElementById('kota');
        const searchForm = document.getElementById('search');
        const showSearchElement = document.querySelector('.show-search');

        inputElement.addEventListener('input', function() {
            const inputValue = inputElement.value.trim();
            if (inputValue !== '') {
                showSearchElement.style.display = 'block';
            } else {
                showSearchElement.style.display = 'none';
                searchForm.reset();
            }
        });
    @endpush
