@extends('landing-page.app')
@section('title', 'JobKelasIndustri - Daftar Pelamar Kerja')
@section('main')
    <main class="bg-light">
        <main class="bg-light">
            <section>
                <div class="col-md-10 mt-4 mx-auto">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-title mt-4 mb-0 ml-4">
                            <h4 class="font-weight-bold">Daftar Pelamar Kerja</h4>
                        </div>
                        <div class="card-body">
                            <form id="search-form" class="form-row cardDatalowongan2" method="GET"
                                action="{{ route('lamarperusahaan.index') }}" onsubmit="handleFormSubmit()">
                                <div class="form-group col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <div class="input-group-text icon-form">
                                            </div> --}}
                                        </div>
                                        <select name="status" class="form-control form-jobs select2" id="statusSelect">
                                            <option value="" selected>Pilih Status</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status }}"
                                                    @if ($status == $selectedStatus) selected @endif>
                                                    {{ $status }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                style="border-left: none; border-radius: 0px 15px 15px 0px;">
                                                <i class="fas fa-times-circle" id="clear-status" style="display: none;"></i>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="form-group col-md-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text icon-form">
                                                <i class="fas fa-search ml-2"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="posisi" class="form-control form-jobs" id="posisi"
                                            placeholder="Cari posisi pekerjaan"
                                            value="{{ app('request')->input('posisi') }}">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text x-form"
                                                style="border-left: none; border-radius: 0px 15px 15px 0px;">
                                                <i class="fas fa-times-circle" id="clear-posisi" style="display: none;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-1">
                                    <button id="search-button" class="btn btn-primary mr-1 px-4" type="submit"
                                        style="border-radius: 15px;">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="col-md-10 mt-4 mx-auto justify-content-center">
                    @if ($loggedInUserResults->isEmpty())
                        <div class="col-md-12 text-center my-2">
                            <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                            <p class="mt-1 text-not">Data tidak tersedia</p>
                        </div>
                    @else
                        @foreach ($loggedInUserResults as $key => $lamar)
                            <div class="card col-12 col-sm-12 mb-4 py-4 px-3 div-pelamar">
                                <div class="card-body d-flex flex-column">
                                    <div class="row">
                                        <div class="col-md-1 mx-auto align-self-start img-pelamar">
                                            @if ($lamar && $lamar->foto)
                                                <img src="{{ asset('storage/' . $lamar->foto) }}" alt="Foto"
                                                    class="rounded-circle" style="width: 100px; height: 100px;">
                                            @else
                                                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                                    class="rounded-circle" style="width: 100px; height: 100px;">
                                            @endif
                                        </div>
                                        <div class="col-md-7">
                                            <h4 class="name-pelamar"><strong>{{ $lamar->name }}</strong></h4>
                                            <h5 class="mb-4">{{ $lamar->judul }}</h5>
                                            <div class="d-flex align-items-center justify-content-start mb-2 data-pelamar">
                                                <div class="d-flex align-items-center col-6 mb-2">
                                                    <img class="img-fluid img-icon mr-2"
                                                        src="{{ asset('assets/img/lamar/calendar.svg') }}">
                                                    <span>{{ date('j F Y', strtotime($lamar->tgl_lahir)) }}</span>
                                                </div>
                                                <div class="d-flex align-items-center col-6">
                                                    <img class="img-fluid img-icon mr-2"
                                                        src="{{ asset('assets/img/lamar/call.svg') }}">
                                                    <span>{{ $lamar->no_hp }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-start mb-2 data-pelamar">
                                                <div class="d-flex align-items-left col-6 mb-2">
                                                    <img class="img-fluid img-icon mr-2"
                                                        src="{{ asset('assets/img/lamar/email.svg') }}">
                                                    <span>{{ $lamar->email }}</span>
                                                </div>
                                                <div class="d-flex align-items-center col-6">
                                                    <img class="img-fluid img-icon mr-2"
                                                        src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                                    <span>{{ $lamar->alamat }}</span>
                                                </div>
                                            </div>
                                            <small class="text-muted">
                                                Melamar pada {{ date('j F Y', strtotime($lamar->created_at)) }}
                                            </small>
                                        </div>
                                        <div class="col-md-2 text-right btn-pelamar">
                                            <!-- Button to open Chatify modal -->
                                            @if ($lamar->status === 'Diterima')
                                                <a id="chat-pelamar" class="btn btn-icon btn-primary btn-icon mb-2"
                                                    style="border-radius: 25px;"
                                                    href="{{ url('chatify/' . $lamar->user_id) }}">
                                                    <i class="fas fa-comment-dots"></i> Chat
                                                </a>
                                                <br>
                                            @endif
                                            <a href="{{ route('lamarperusahaan.show', $lamar->id) }}"
                                                class="btn btn-sm btn-primary btn-icon py-2 px-3 mb-3"
                                                style="border-radius: 25px";>
                                                <i class="far fa-eye"></i> Detail
                                            </a>
                                            <br>
                                            <span
                                                class="py-2 px-4
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
                        @endforeach
                    @endif
                    <div class="d-flex justify-content-center">
                        {{ $loggedInUserResults->withQueryString()->links() }}
                    </div>
            </section>
        </main>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const cards = document.querySelectorAll(".card-text");
                let maxHeight = 0;

                cards.forEach(card => {
                    const cardHeight = card.clientHeight;
                    if (cardHeight > maxHeight) {
                        maxHeight = cardHeight;
                    }
                });

                cards.forEach(card => {
                    card.style.height = maxHeight + "px";
                });
            });
        </script>

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

                    inputValues[item.inputId] = input.value;
                    clearIcon.style.display = inputValues[item.inputId] ? "block" : "none";

                    input.addEventListener("input", function() {
                        inputValues[item.inputId] = this.value;
                        clearIcon.style.display = this.value ? "block" : "none";
                    });

                    clearIcon.addEventListener("click", function() {
                        input.value = "";
                        currentInputValue = "";
                        inputValues[item.inputId] = "";
                        clearIcon.style.display = "none";
                        submitForm(inputValues[item.inputId]);
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

        <script>
            function handleFormSubmit() {
                document.querySelectorAll('.clear-icon').forEach(icon => {
                    const input = icon.parentElement.querySelector('input');
                    icon.style.display = input.value ? "block" : "none";
                });

                document.querySelectorAll('.input-group input').forEach(input => {
                    const icon = input.parentElement.querySelector('.clear-icon');
                    icon.style.display = input.value ? "block" : "none";
                });
            }
        </script>

        <script>
            const statusSelect = document.getElementById('statusSelect');

            statusSelect.addEventListener('change', function() {
                const selectedStatus = statusSelect.value;

                window.location.href = '{{ route('lamarperusahaan.index') }}?status=' + selectedStatus;
            });
        </script>
        {{-- <style>
            .badge-custom {
                font-size: 0.8rem;
                padding: 0.5rem 1rem;
            }
        </style> --}}
        <script>
            @if (session('success') === 'success-status')
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Status berhasil diperbarui.',
                    confirmButtonText: 'OK'
                });
            @endif
        </script>
        <script>
            @if (session('success') === 'success-delete')
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data lamaran berhasil di hapus.',
                    confirmButtonText: 'OK'
                });
            @endif
        </script>
    @endsection
    @push('customStyle')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('customScript')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
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
