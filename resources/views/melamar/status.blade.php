@extends('landing-page.app')
@section('title', 'JobKelasIndustri - Halaman Status Lamaran')
@section('main')
    <main class="bg-light"> <!-- Added some padding on top and bottom -->
        <!-- Begin: Search form -->
        <section> <!-- Added some margin at the bottom -->
            <div class="col-md-10 mt-4 mx-auto">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-title mt-4 mb-0 ml-4">
                        <h4 class="font-weight-bold">Cari Status Lamaran</h4>
                    </div>
                    <div class="card-body">
                        <form id="search-form" class="form-row cardDatalowongan2" method="GET"
                            action="{{ route('melamar.status') }}" onsubmit="handleFormSubmit()">
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        {{-- <div class="input-group-text icon-form">
                                        <i class="fas fa-filter"></i>
                                    </div> --}}
                                    </div>
                                    <select name="status" id="status" class="form-control form-jobs select2">
                                        <option value="" selected>Pilih Status</option>
                                        <option value="pending" @if (request('status') === 'pending') selected @endif>Pending
                                        </option>
                                        <option value="diterima" @if (request('status') === 'diterima') selected @endif>Diterima
                                        </option>
                                        <option value="ditolak" @if (request('status') === 'ditolak') selected @endif>Ditolak
                                        </option>
                                    </select>
                                    {{-- <div class="input-group-prepend">
                                    <div class="input-group-text"
                                        style="border-left: none; border-radius: 0px 15px 15px 0px;">
                                        <i class="fas fa-times clear-icon" id="clear-status" style="cursor:pointer; display:none;"></i>
                                    </div>
                                </div> --}}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text icon-form">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="posisi" class="form-control form-jobs" id="posisi"
                                        placeholder="Cari posisi pekerjaan" value="{{ app('request')->input('posisi') }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text x-form"
                                            style="border-left: none; border-radius: 0px 15px 15px 0px;">
                                            <i class="fas fa-times clear-icon" id="clear-posisi"
                                                style="cursor:pointer; display:none;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 ">
                                <div class="input-group">
                                    {{-- <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                </div> --}}
                                    {{-- <select name="lokasi" id="lokasi" class="form-control form-jobs select2">
                                        <option value="" selected>Lokasi</option>
                                        @foreach ($kota as $kec)
                                            <option value="{{ $kec->kota }}"
                                                @if (request('lokasi') === $kec->kota) selected @endif>
                                                {{ $kec->kota }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    {{-- <div class="input-group-prepend">
                                    <div class="input-group-text"
                                            style="border-left: none; border-radius: 0px 15px 15px 0px;">
                                        <i class="fas fa-times clear-icon" id="clear-lokasi" style="cursor:pointer; display:none;"></i>
                                    </div>
                                </div> --}}
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                                <button id="search-button" class="btn btn-primary px-4" style="border-radius: 15px"
                                    type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

        <section>
            <div class="col-md-10 mt-4 mx-auto justify-content-center">
                @include('layouts.alert')
                @forelse($lamaran as $lamar)
                    <div class="card col-12 col-sm-12 mb-4 py-4 px-3">
                        <div class="card-body d-flex flex-column">
                            <div class="row">
                                <div class="col-md-1 mx-auto mr-5 align-self-start img-pelamar">
                                    {{-- @if ($lamar && $lamar->loker->perusahaan && $lamar->loker->perusahaan->logo)
                                        <img src="{{ asset('storage/' . $lamar->loker->perusahaan->logo) }}"
                                            alt="Logo Perusahaan" class="rounded-circle"
                                            style="width: 100px; height: 100px;">
                                    @else --}}
                                        <img alt="image" src="{{ asset('assets/img/company/default-company-logo.png') }}"
                                            class="rounded-circle" style="width: 100px; height: 100px;">
                                    {{-- @endif --}}
                                </div>
                                <div class="col-md-7">
                                    <h5 class="media-title">
                                        <strong>{{ $lamar->loker->nama_loker }}</strong>
                                    </h5>
                                    <h5 class="mb-4">{{ $lamar->loker->perusahaan->nama_pemilik }}</h5>
                                    <div class="d-flex align-items-center justify-content-start mb-2 data-pelamar">
                                        <div class="d-flex align-items-center col-6 mb-2">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/job.svg') }}">
                                            <span>{{ $lamar->loker->persyaratan }}</span>
                                        </div>
                                        <div class="d-flex align-items-center col-6">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/money.svg') }}">
                                            <span>IDR {{ $lamar->loker->gaji }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start mb-2 data-pelamar">
                                        <div class="d-flex align-items-left col-6 mb-2">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                            <span>{{ $lamar->loker->min_persyaratan }}</span>
                                        </div>
                                        <div class="d-flex align-items-center col-6">
                                            <img class="img-fluid img-icon mr-2"
                                                src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                            <span>{{ $lamar->loker->perusahaan->alamat_perusahaan }}</span>
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        Melamar pada
                                        {{ \Carbon\Carbon::parse($lamar->created_at)->format('j F Y') }}
                                    </small>
                                </div>
                                <div class="col-md-2 text-right btn-pelamar">
                                    <!-- Button to open Chatify modal -->
                                    @if ($lamar->status === 'Diterima')
                                        <a id="chat-perusahaan" class="btn btn-icon btn-primary btn-icon py-2 px-3 mb-2"
                                            style="border-radius: 25px;"
                                            href="{{ url('chatify/' . $lamar->loker->perusahaan->user_id) }}">
                                            <i class="fas fa-comment-dots"></i> Chat
                                        </a>
                                        <br>
                                    @endif
                                    <a id="detail-button" class="btn btn-sm btn-primary btn-icon py-2 px-3 mb-3"
                                        style="border-radius: 25px;"
                                        href="{{ route('all-jobs.show', $lamar->loker->id) }}">
                                        <i class="far fa-eye"></i> Detail
                                    </a>
                                    <br>
                                    <span
                                        class=" py-2 px-4
                                            @if ($lamar->status === 'Pending') lamar-warning
                                            @elseif ($lamar->status === 'Diterima') lamar-success
                                            @elseif ($lamar->status === 'Ditolak') lamar-danger @endif
                                            "style="border-radius: 25px; font-size: 16px;">
                                        {{ $lamar->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 text-center mt-4">
                        <img src="{{ asset('assets/img/landing-page/search.png') }}">
                        <p class="mt-1 text-not">Belum ada lamaran ditemukan</p>
                    </div>
                @endforelse
                <div class="pagination justify-content-center mt-4">
                    {{ $lamaran->withQueryString()->links() }}
                </div>
            </div>
            <!-- Button to open Chatify modal -->
            {{-- @if ($lamar->status === 'Diterima')
                <div class="text-center mb-3">
                    <div class="chat-icon-container">
                        <a href="{{ url('chatify/' . $lamar->loker->perusahaan->user_id) }}" class="fas fa-comment-dots"
                            style="font-size: 37px; color:#6777ef;"></a>
                    </div>
                </div>
            @endif --}}
            {{-- <div class="chat-icon-container">
                <a href="{{ url('chatify/' . $loker->perusahaan->user_id) }}" class="fas fa-comment-dots"
                    style="font-size: 37px; color:#6777ef;"></a>
            </div> --}}
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputsAndIcons = [{
                    inputId: "posisi",
                    clearIconId: "clear-posisi"
                },
                {
                    inputId: "lokasi",
                    clearIconId: "clear-lokasi"
                },
            ];

            const inputValues = {
                posisi: "",
                lokasi: "",
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function openChatifyChat(user_id) {
            // Check if Chatify is defined (the Chatify JavaScript library is loaded)
            if (typeof Chatify === 'object') {
                // Open a chat with the specified user ID
                Chatify.openChat(user_id);
            } else {
                // Handle the case where Chatify is not defined (library not loaded)
                console.error('Chatify is not loaded.');
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const formIcon = document.querySelector(".icon-form");
            const formX = document.querySelector(".x-form");
            const posisiInput = document.querySelector("input[name='posisi']");

            posisiInput.addEventListener("focus", function() {
                formIcon.style.borderColor = '#95a0f4';
                formX.style.borderColor = '#95a0f4';
            });

            posisiInput.addEventListener("blur", function() {
                formIcon.style.borderColor = '';
                formX.style.borderColor = '';
            });
        })
    </script>
@endsection
@push('customStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('customScript')
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.status').select2({
                placeholder: 'Pilih Status',
            });
        });
    </script>
@endpush
