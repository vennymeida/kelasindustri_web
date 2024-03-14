@extends('landing-page.app')
@section('title', 'JobKelasIndustri - Bookmarks')
@section('main')
    <main class="bg-light">
        <section>
            <div class="col-md-10 mt-4 mx-auto">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-title mt-4 mb-0 ml-4">
                        <h4 class="font-weight-bold">Lowongan Kerja Tersimpan</h4>
                    </div>
                    <div class="card-body">
                        <form id="search-form" class="form-row cardDatalowongan2" method="GET"
                            action="{{ route('bookmark.index') }}" onsubmit="handleFormSubmit()">
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text icon-form">
                                            <i class="fas fa-search ml-2"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="posisi" class="form-control form-jobs" id="posisi"
                                        placeholder="Cari posisi pekerjaan" value="{{ app('request')->input('posisi') }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text x-form"
                                            style="border-left: none; border-radius: 0px 15px 15px 0px;">
                                            <i class="fas fa-times-circle" id="clear-posisi" style="display: none;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <select name="lokasi" id="lokasi" class="form-control form-jobs select2">
                                        <option value="" selected>Lokasi</option>
                                        @foreach ($kecamatan as $item)
                                            <option value="{{ $item->kecamatan }}"
                                                @if ($item->kecamatan == $selectedLokasi) selected @endif>{{ $item->kecamatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <select name="kategori" id="kategori" class="form-control form-jobs select2 kategori"
                                        multiple>
                                        @foreach ($kategoris as $item)
                                            <option value="{{ $item->kategori }}"
                                                @if (in_array($item->kategori, $selectedKategori)) selected @endif>
                                                {{ $item->kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <button id="search-button" class="btn btn-primary mr-1 px-4" type="submit"
                                    style="border-radius: 15px;">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="col-md-12 mt-5 mx-auto d-flex flex-wrap justify-content-center">
                @if ($bookmarks->isEmpty())
                    <div class="col-md-12 text-center my-2">
                        <img src="{{ asset('assets/img/landing-page/bookmark.png') }}">
                        <p class="mt-1 text-not">Belum ada pekerjaan yang di-bookmark ditemukan.</p>
                    </div>
                @else
                    @foreach ($bookmarks as $key => $bookmark)
                        @if ($bookmark->lowonganPekerjaan)
                            <div class="card col-md-3 mb-4 mx-4">
                                <div class="card-body d-flex flex-column">
                                    <div class="position-relative">
                                        <div class="gradient-overlay"></div>
                                        <img class="img-fluid mb-3 fixed-height-image position-absolute top-0 start-50 translate-middle-x"
                                            src="{{ asset('storage/' . $bookmark->lowonganPekerjaan->perusahaan->logo) }}"
                                            alt="Company Logo">
                                        <p class="text-white card-title font-weight-bold mb-0 ml-2 overlap-text"
                                            style="font-size: 20px;">
                                            {{ $bookmark->lowonganPekerjaan->judul }}
                                        </p>
                                        <p class="text-white mb-4 ml-2 overlap-text-2" style="font-size: 14px;">
                                            {{ $bookmark->lowonganPekerjaan->perusahaan->nama }}
                                        </p>
                                    </div>
                                    <div class="card-text">
                                        <ul class="list-unstyled ml-2">
                                            <ul class="list-unstyled d-flex justify-content-between">
                                                <li class="d-flex justify-content-start mb-2">
                                                    <img class="img-fluid img-icon mr-2"
                                                        src="{{ asset('assets/img/landing-page/list.svg') }}">
                                                    @foreach ($bookmark->lowonganPekerjaan->kategori as $index => $kategori)
                                                        {{ $kategori->kategori }}@if ($index < count($bookmark->lowonganPekerjaan->kategori) - 1)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </li>
                                                <li class="mb-2">
                                                    <a href="javascript:void(0);" class="bookmark-icon"
                                                        data-loker-id="{{ $bookmark->lowonganPekerjaan->id }}">
                                                        <i class="far fa-bookmark" style="font-size: 20px;"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                            <li class="d-flex justify-content-start mb-2">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/money.svg') }}">
                                                {{ 'IDR ' . $bookmark->lowonganPekerjaan->gaji_bawah }}
                                                <span>-</span>
                                                {{ $bookmark->lowonganPekerjaan->gaji_atas }}
                                            </li>
                                            <li class="d-flex justify-content-start mb-2">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/job.svg') }}">
                                                {{ $bookmark->lowonganPekerjaan->min_pengalaman }}
                                            </li>
                                            <li class="d-flex justify-content-start mb-2">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                                Minimal {{ $bookmark->lowonganPekerjaan->min_pendidikan }}
                                            </li>
                                            <li class="d-flex justify-content-start mb-2">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                                {{ $bookmark->lowonganPekerjaan->lokasi }}
                                            </li>
                                            <li class="d-flex justify-content-start mb-2">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/Office Building.svg') }}">
                                                {{ $bookmark->lowonganPekerjaan->perusahaan->alamat_perusahaan }},
                                                {{ $bookmark->lowonganPekerjaan->perusahaan->kelurahan->kelurahan }},
                                                {{ $bookmark->lowonganPekerjaan->perusahaan->kecamatan->kecamatan }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="text-center mb-3">
                                        <a id="detail-button" class="btn btn-primary px-4 py-2" style="border-radius: 25px;"
                                            href="{{ route('all-jobs.show', $bookmark->lowonganPekerjaan->id) }}">Lihat
                                            Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </section>
        <div class="d-flex justify-content-center">
            {{ $bookmarks->withQueryString()->links() }}
        </div>
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
        }
    </script>



    <script>
        $(document).ready(function() {
            $('.bookmark-icon').each(function() {
                var icon = $(this);
                var lokerId = icon.data('loker-id');
                var storageKey = 'bookmark_' + lokerId;

                // Retrieve bookmark status from local storage
                var isBookmarked = localStorage.getItem(storageKey);
                if (isBookmarked === 'true') {
                    icon.find('i').removeClass('far fa-bookmark').addClass('fas fa-bookmark');
                } else {
                    icon.find('i').removeClass('fas fa-bookmark').addClass('far fa-bookmark');
                }

                icon.click(function() {
                    // Make an AJAX request to update bookmark status
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('bookmark.toggle') }}',
                        data: {
                            loker_id: lokerId
                        },
                        success: function(response) {
                            if (response.bookmarked) {
                                icon.find('i').removeClass('far fa-bookmark').addClass(
                                    'fas fa-bookmark');
                            } else {
                                icon.find('i').removeClass('fas fa-bookmark').addClass(
                                    'far fa-bookmark');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Lowongan Pekerjaan Dihapus',
                                    showConfirmButton: true,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Refresh the page
                                        location.reload();
                                    }
                                });
                            }

                            // Update bookmark status in local storage
                            localStorage.setItem(storageKey, response.bookmarked);

                            // Optionally, you can display a toast or notification to indicate success
                            if (response.bookmarked) {
                                // Example using Bootstrap Toast component
                                $('.toast').toast('show');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle errors here if necessary
                            console.error(error);
                        }
                    });
                });
            });
        });
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
            $('.kategori').select2({
                placeholder: 'Kategori'
            });
        });
    </script>
@endpush
