@extends('landing-page.app')
@section('title', 'JobKelasIndustri - Buka Lowongan Pekerjaan')
@section('main')
    <main class="bg-light">
        <section>
            <div class="col-md-12 py-3 mb-4">
                <div class="col-md-11 mt-4 mx-auto">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-title mt-4 mb-0 ml-5">
                            <h4 class="font-weight-bold">Data Lowongan Pekerjaan</h4>
                        </div>
                        <div class="card-body ml-4 div-lowongan">
                            <form id="search-form" class="form-row cardDatalowongan" method="GET"
                                action="{{ route('loker-perusahaan.index') }}" onsubmit="handleFormSubmit()">
                                <div class="form-group col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text icon-form">
                                                <i class="fas fa-search ml-2"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="judul"
                                            class="form-control form-jobs clearable inputSearch" id="judul"
                                            placeholder="Cari posisi pekerjaan"
                                            value="{{ app('request')->input('judul') }}">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                style="border-left: none; border-radius: 0px 15px 15px 0px;">
                                                <i class="fas fa-times-circle" id="clear-judul" style="display: none;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="input-group">
                                        <button id="search-button" class="btn btn-primary mr-1 px-4" type="submit"
                                            style="border-radius: 15px;">Cari
                                        </button>
                                        <a href={{ route('loker-perusahaan.create') }}
                                            class="btn btn-primary px-4 text-white" type="submit"
                                            style="border-radius: 15px;">Tambah Loker</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="col-md-12 mx-auto d-flex flex-wrap justify-content-center">
                @if ($loggedInUserResults->isEmpty())
                    {{-- <p class="mt-4">Data Tidak Tersedia</p> --}}
                    <div class="col-md-12 text-center my-2">
                        <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                        <p class="mt-1 text-not">Data tidak tersedia</p>
                    </div>
                @else
                    @foreach ($loggedInUserResults as $key => $loker)
                        <div class="card col-md-5 mb-3 mx-2">
                            <div class="card-body d-flex flex-column">
                                <ul class="list-unstyled">
                                    <ul class="list-unstyled d-flex justify-content-between align-items-center">
                                        <li class="font-weight-bold p-loker">Posisi : {{ $loker->judul }}</li>
                                        <a href="{{ route('loker-perusahaan.edit', $loker->id) }}"
                                            class="btn btn-info btn-icon py-1 px-4" style="border-radius: 15px;">
                                            Edit
                                        </a>
                                    </ul>
                                    <li class="mb-2"><img class="img-fluid img-icon"
                                            src="{{ asset('assets/img/landing-page/money.svg') }}">
                                        {{ 'IDR ' . $loker->gaji_bawah }}
                                        <span>-</span>
                                        {{ $loker->gaji_atas }}
                                    </li>
                                    <li class="mb-2"><img class="img-fluid img-icon"
                                            src="{{ asset('assets/img/landing-page/job.svg') }}">
                                        {{ $loker->min_pengalaman }}
                                    </li>
                                    <li class="mb-2"><img class="img-fluid img-icon"
                                            src="{{ asset('assets/img/landing-page/hourglass.svg') }}">
                                        {{ $loker->tipe_pekerjaan }}
                                    </li>
                                    <li class="mb-2"><img class="img-fluid img-icon"
                                            src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                        Minimal {{ $loker->min_pendidikan }}
                                    </li>
                                    <li class="mb-2">
                                        Keahlian : {{ $loker->keahlian }}
                                    </li>
                                    <a href="{{ route('loker-perusahaan.show', $loker->id) }}" class="mb-2 font-italic"
                                        style="font-size: 14px">
                                        Lihat Selengkapnya...
                                    </a>
                                    <ul
                                        class="list-unstyled d-flex justify-content-between align-items-center mt-2 status-loker">
                                        <button
                                            class="px-4 mt-2 mr-1 btn btn-status
                                        @if ($loker->status === 'Pending') btn-warning
                                        @elseif ($loker->status === 'Dibuka') btn-success
                                        @elseif ($loker->status === 'Ditutup') btn-secondary @endif">
                                            {{ $loker->status }}
                                        </button>

                                        <li class="font-italic time" style="font-size: 14px;"><img
                                                class="img-fluid img-icon"
                                                src="{{ asset('assets/img/landing-page/Time.svg') }}">
                                            {{ $loker->timeAgo }}
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
        <div class="d-flex justify-content-center mt-5">
            {{ $loggedInUserResults->withQueryString()->links() }}
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputsAndIcons = [{
                inputId: "judul",
                clearIconId: "clear-judul"
            }, ];

            const inputValues = {
                judul: ""
            };

            inputsAndIcons.forEach(item => {
                const input = document.getElementById(item.inputId);
                const clearIcon = document.getElementById(item.clearIconId);

                input.addEventListener("input", function() {
                    inputValues[item.inputId] = this.value;
                    clearIcon.style.display = this.value ? "block" : "none";
                });

                clearIcon.addEventListener("click", function() {
                    input.value = "";
                    currentInputValue = "";
                    clearIcon.style.display = "none";
                    submitForm(currentInputValue);
                });

                if (input.value) {
                    clearIcon.style.display = "block";
                }
            });

            function submitForm(inputValue) {
                const form = document.getElementById("search-form");

                form.submit();
            }
        });
    </script>

    <script>
        @if (session('success') === 'success-create')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Lowongan Pekerjaan berhasil ditambahkan.',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    <script>
        @if (session('success') === 'success-edit')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Lowongan Pekerjaan berhasil diubah.',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection

@push('customScript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
@endpush
