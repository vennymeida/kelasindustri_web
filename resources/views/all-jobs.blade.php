@extends('landing-page.app')
@section('title', 'JobKelasIndustri - Lowongan Pekerjaan')
@section('main')
    <!-- Main Content -->
    <main class="bg-light">
        <section>
            <div class="col-md-10 mt-4 mx-auto">
                <div class="card-loker" style="border-radius: 15px;">
                    <div class="card-title mt-4 mb-0 ml-4">
                        <h4 class="font-weight-bold">Daftar Lowongan Pekerjaan</h4>
                    </div>
                    <div class="card-body">
                        <form id="search-form" class="form-row cardDatalowongan2" method="GET"
                            action="{{ route('all-jobs.index') }}" onsubmit="handleFormSubmit()">
                            <div class="form-group col-md-6">
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
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <select name="lokasi" id="lokasi" class="form-control form-jobs select2">
                                        <option value="" selected>Lokasi</option>
                                        @if (isset($lokasikota))
                                            @foreach ($lokasikota as $key)
                                                <option value="{{ $key->kota }}"
                                                    @if (request('lokasi') == $key->kota) selected @endif>{{ $key->kota }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                                <button id="search-button" class="btn btn-primary mr-1 px-4 py-2" type="submit"
                                    style="border-radius: 15px;">Cari</button>
                            </div>
                            {{-- </form> --}}
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="col-md-10 mx-auto mt-3">
                <div class="row">
                    <form id="filterForm" method="GET" action="{{ route('all-jobs.index') }}">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-loker px-4 py-3">
                                    <p>Tipe Pekerjaan</p>
                                    <label>
                                        <input class="mr-2 tipe-pekerjaan" type="checkbox" name="tipe[]" id="Onsite" value="Onsite">
                                        Onsite
                                    </label>
                                    <br>
                                    <label>
                                        <input class="mr-2 tipe-pekerjaan" type="checkbox" name="tipe[]" id="Remote" value="Remote">
                                        Remote
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-loker px-4 py-3">
                                    <form id="filterForm" method="GET" action="{{ route('all-jobs.index') }}">
                                        <p>Gaji</p>
                                        <label>
                                            <input class="mr-2" type="checkbox" name="gaji[]" id="less-1jt"
                                                value="less-1jt">
                                            Kurang dari 1 Juta
                                        </label>
                                        <br>
                                        <label>
                                            <input class="mr-2" type="checkbox" name="gaji[]" id="1jt-5jt"
                                                value="1jt-5jt">
                                            1 - 5 Juta
                                        </label>
                                        <br>
                                        <label>
                                            <input class="mr-2" type="checkbox" name="gaji[]" id="5jt-10jt"
                                                value="5jt-10jt">
                                            5 - 10 Juta
                                        </label>
                                        <br>
                                        <label>
                                            <input class="mr-2" type="checkbox" name="gaji[]" id="more-10jt"
                                                value="more-10jt">
                                            Lebih dari 10 Juta
                                        </label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col">
                        @role('lulusan')
                            <div class="col-md-12" id="job-listings-container">
                                <div class="col-md-9">
                                    <h2>Rekomendasi Pekerjaan Untukmu</h2>
                                </div>
                                <div class="col-md-12 mx-auto d-flex flex-wrap" style="gap: 20px">
                                    @if ($allResults == null || $allResults->isEmpty())
                                        <div class="col-md-12 text-center my-4">
                                            <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                                            <p class="mt-1 text-not">Data tidak tersedia</p>
                                        </div>
                                    @else
                                        @foreach ($allResults as $key => $loker)
                                            <div class="card col-md-5 mb-4">
                                                <div class="card-body d-flex flex-column">
                                                    <div class="position-relative">
                                                        <div class="gradient-overlay"></div>
                                                        <img class="img-fluid mb-3 fixed-height-image position-absolute top-0 start-50 translate-middle-x"
                                                            src="{{ asset('storage/' . $loker->logo_perusahaan) }}"
                                                            alt="Company Logo">
                                                        <p class="text-black card-title font-weight-bold mb-0 ml-2 overlap-text"
                                                            style="font-size: 20px;">
                                                            {{ $loker->nama_loker }}
                                                        </p>
                                                        <a class="text-white ml-2 overlap-text-2"
                                                            @if (auth()->check()) href="{{ route('detail-perusahaan.show', $loker->perusahaan_id) }}"
                                                            @else
                                                            href="#"
                                                            onclick="alert('Anda harus login untuk melihat detail perusahaan.')" @endif
                                                            style="font-size: 14px;">
                                                            {{ $loker->nama_perusahaan }}
                                                        </a>

                                                    </div>
                                                    <div class="card-text mt-4">
                                                        <ul class="list-unstyled ml-2">
                                                            <ul class="list-unstyled d-flex justify-content-between">
                                                                <li class="d-flex justify-content-start">
                                                                    <img class="img-fluid img-icon mr-2"
                                                                        src="{{ asset('assets/img/landing-page/list.svg') }}">
                                                                    <p class="mb-2">{{ $loker->tipe_pekerjaan }}</p>
                                                                </li>
                                                                <li class="mb-2">
                                                                    @if (auth()->check() && auth()->user()->hasRole('lulusan'))
                                                                        <a href="javascript:void(0);"
                                                                            class="bookmark-icon text-right"data-loker-id="{{ $loker->id }}">
                                                                            <i class="far fa-bookmark"
                                                                                style="font-size: 20px;"></i>
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                            <li class="d-flex justify-content-start">
                                                                <img class="img-fluid img-icon mr-2"
                                                                    src="{{ asset('assets/img/landing-page/money.svg') }}">
                                                                <p class="mb-2">{{ 'IDR ' . $loker->gaji_bawah }}
                                                                    <span>-</span>
                                                                    {{ $loker->gaji_atas }}
                                                                </p>
                                                            </li>
                                                            <li class="d-flex justify-content-start">
                                                                <img class="img-fluid img-icon mr-2"
                                                                    src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                                                <p class="mb-2">{{ $loker->keahlian_loker }}</p>
                                                            </li>
                                                            <li class="d-flex justify-content-start">
                                                                <img class="img-fluid img-icon mr-2"
                                                                    src="{{ asset('assets/img/landing-page/Office Building.svg') }}">
                                                                <p class="mb-2">{{ $loker->lokasi }}
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="text-center">
                                                        <a id="detail-button" class="btn btn-primary px-4 py-2"
                                                            style="border-radius: 25px;"
                                                            href="{{ route('all-jobs.show', $loker->id) }}">Lihat
                                                            Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{-- {{ $allResults->withQueryString()->links() }} --}}
                                </div>
                            </div>
                        @endrole
                        {{-- data loker  --}}
                        <div class="col-md-12" id="job-listings-container">
                            <div class="col-md-12">
                                <h2>Data Lowongan Pekerjaan</h2>
                            </div>
                            <div class="col-md-12 mx-auto d-flex flex-wrap" style="gap: 20px">
                                @if ($tableloker->isEmpty())
                                    <div class="col-md-12 text-center my-4">
                                        <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                                        <p class="mt-1 text-not">Data tidak tersedia</p>
                                    </div>
                                @else
                                    @foreach ($tableloker as $key => $loker)
                                        <div class="card col-md-5 mb-4">
                                            <div class="card-body d-flex flex-column">
                                                <div class="position-relative">
                                                    <div class="gradient-overlay"></div>
                                                    <img class="img-fluid mb-3 fixed-height-image position-absolute top-0 start-50 translate-middle-x"
                                                        src="{{ asset('storage/' . $loker->logo_perusahaan) }}"
                                                        alt="Company Logo">
                                                    <p class="text-black card-title font-weight-bold mb-0 ml-2 overlap-text"
                                                        style="font-size: 20px;">
                                                        {{ $loker->nama_loker }}
                                                    </p>
                                                    <a class="text-white ml-2 overlap-text-2"
                                                        href="{{ route('detail-perusahaan.show', $loker->perusahaan_id) }}"
                                                        style="font-size: 14px;">
                                                        {{ $loker->nama_perusahaan }}
                                                    </a>
                                                </div>
                                                <div class="card-text mt-4">
                                                    <ul class="list-unstyled ml-2">
                                                        <ul class="list-unstyled d-flex justify-content-between">
                                                            <li class="d-flex justify-content-start">
                                                                <img class="img-fluid img-icon mr-2"
                                                                    src="{{ asset('assets/img/landing-page/list.svg') }}">
                                                                <p class="mb-2">{{ $loker->tipe_pekerjaan }}</p>
                                                            </li>
                                                            <li class="mb-2">
                                                                @if (auth()->check() && auth()->user()->hasRole('lulusan'))
                                                                    <a href="javascript:void(0);"
                                                                        class="bookmark-icon text-right"data-loker-id="{{ $loker->id }}">
                                                                        <i class="far fa-bookmark"
                                                                            style="font-size: 20px;"></i>
                                                                    </a>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                        <li class="d-flex justify-content-start">
                                                            <img class="img-fluid img-icon mr-2"
                                                                src="{{ asset('assets/img/landing-page/money.svg') }}">
                                                            <p class="mb-2">{{ 'IDR ' . $loker->gaji_bawah }}
                                                                <span>-</span>
                                                                {{ $loker->gaji_atas }}
                                                            </p>
                                                        </li>
                                                        <li class="d-flex justify-content-start">
                                                            <img class="img-fluid img-icon mr-2"
                                                                src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                                            <p class="mb-2">{!! $loker->keahlian !!}</p>
                                                        </li>
                                                        <li class="d-flex justify-content-start">
                                                            <img class="img-fluid img-icon mr-2"
                                                                src="{{ asset('assets/img/landing-page/Office Building.svg') }}">
                                                            <p class="mb-2">{{ $loker->lokasi }}
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="text-center">
                                                    <a id="detail-button" class="btn btn-primary px-4 py-2"
                                                        style="border-radius: 25px;"
                                                        href="{{ route('all-jobs.show', $loker->id) }}">Lihat
                                                        Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="d-flex justify-content-center">
                                {{ $tableloker->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        document.querySelectorAll('.tipe-pekerjaan').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    document.querySelectorAll('.tipe-pekerjaan').forEach(otherCheckbox => {
                        if (otherCheckbox !== this) {
                            otherCheckbox.checked = false;
                        }
                    });
                }
            });
        });
    </script>

    <script>
        const scrollableContent = document.querySelector('.horizontal-scroll');
        const scrollLeftArrow = document.querySelector('.scroll-arrow.left');
        const scrollRightArrow = document.querySelector('.scroll-arrow.right');

        scrollLeftArrow.addEventListener('click', () => {
            scrollableContent.scrollLeft -= 387;
        });

        scrollRightArrow.addEventListener('click', () => {
            scrollableContent.scrollLeft += 387;
        });
    </script>

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
            const cards = document.querySelectorAll(".card-text-recom");
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
                const select = icon.parentElement.querySelector('input, select');
                icon.style.display = select.value ? "block" : "none";
            });

            document.querySelectorAll('.input-group input').forEach(input => {
                const icon = input.parentElement.querySelector('.clear-icon');
                icon.style.display = input.value ? "block" : "none";
            });
        }
    </script>

    <script>
        // const form = document.getElementById('filterForm');
        const form = document.getElementById('search-form');
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        function updateFormAction() {
            const selectedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
            const params = selectedCheckboxes.map(checkbox => checkbox.value).join('&');
            const actionURL = "{{ route('all-jobs.index') }}?" + params;
            form.action = actionURL;

            localStorage.setItem('selectedCheckboxes', JSON.stringify(selectedCheckboxes.map(checkbox => checkbox.id)));
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                updateFormAction();
                form.submit();
            });
        });

        const storedCheckboxes = JSON.parse(localStorage.getItem('selectedCheckboxes')) || [];
        storedCheckboxes.forEach(id => {
            const checkbox = document.getElementById(id);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
        updateFormAction();
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
                    $.ajax({
                        type: 'POST',
                        url: '/bookmark/add',
                        data: {
                            loker_id: lokerId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.bookmarked) {
                                icon.find('i').removeClass('far fa-bookmark').addClass(
                                    'fas fa-bookmark');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Lowongan Pekerjaan Disimpan',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                icon.find('i').removeClass('fas fa-bookmark').addClass(
                                    'far fa-bookmark');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Lowongan Pekerjaan Dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
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
                placeholder: 'Kategori',
            });
        });
    </script>
@endpush
