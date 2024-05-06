@extends('landing-page.app')
@section('title', 'JobKelasIndustri - Lowongan Pekerjaan')
@section('main')
    <!-- Main Content -->
    <main class="bg-light">
        <section>
            <div class="col-md-12 d-flex justify-content-end bg-light my-4">
                <div class="breadcrumb-item"><a href="{{ route('all-jobs.index') }}">lowongan pekerjaan</a></div>
                <div class="breadcrumb-item active">detail lowongan pekerjaan</div>
            </div>
            <div class="col-md-12 mx-auto mt-3">
                <div class="col">
                    <div class="col-md-12" id="job-listings-container">
                        <div class="col-md-12 mx-auto d-flex flex-wrap justify-content-between">
                            <div class="card col-md-12 mb-4">
                                <div class="card-body d-flex flex-row">
                                    <div class="position-relative">
                                        <div class="gradient-overlay"></div>
                                        {{-- <img class="img-fluid mb-3 fixed-height-image position-absolute top-0 start-50 translate-middle-x"
                                                            src="{{ asset('storage/' . $rekomendasi->logo) }}" alt="Company Logo"> --}}
                                        {{-- <p class="text-black card-title font-weight-bold mb-0 ml-2 overlap-text"
                                            style="font-size: 20px;">
                                            {{ $rekomendasi->nama_loker }}
                                        </p> --}}
                                        {{-- <a class="text-white ml-2 overlap-text-2"
                                                            href="{{ route('detail-perusahaan.show', $loker->id_perusahaan) }}"
                                                            style="font-size: 14px;">
                                                            {{ $loker->nama }}
                                                        </a> --}}
                                    </div>
                                    <div class="col-12 card-text mt-4">
                                        <ul class="list-unstyled ml-2">
                                            <h4> {{ $rekomendasi->nama_loker }}</h4>
                                            <ul class="list-unstyled d-flex justify-content-between">
                                                <li class="d-flex justify-content-start">
                                                    <img class="img-fluid img-icon mr-2"
                                                        src="{{ asset('assets/img/landing-page/list.svg') }}">
                                                    <p class="mb-2">{{ $rekomendasi->tipe_pekerjaan }}</p>
                                                </li>
                                                <li class="mb-2">
                                                    @if (auth()->check() && auth()->user()->hasRole('Pencari Kerja'))
                                                        <a href="javascript:void(0);"
                                                            class="bookmark-icon text-right"data-loker-id="{{ $rekomendasi->id }}">
                                                            <i class="far fa-bookmark" style="font-size: 20px;"></i>
                                                        </a>
                                                    @endif
                                                </li>
                                            </ul>
                                            {{-- <li class="d-flex justify-content-start">
                                                                <img class="img-fluid img-icon mr-2"
                                                                    src="{{ asset('assets/img/landing-page/money.svg') }}">
                                                                <p class="mb-2">{{ 'IDR ' . $rekomendasi->gaji_bawah }}
                                                                    <span>-</span>
                                                                    {{ $rekomendasi->gaji_atas }}
                                                                </p>
                                                            </li> --}}

                                            <li class="d-flex justify-content-start">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/job.svg') }}">
                                                <p class="mb-2">{{ $rekomendasi->min_persyaratan }}</p>
                                            </li>
                                            <li class="d-flex justify-content-start">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                                <p class="mb-2">Minimal {{ $rekomendasi->persyaratan }}</p>
                                            </li>
                                            <li class="d-flex justify-content-start">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                                <p class="mb-2">{{ $rekomendasi->lokasi }}</p>
                                            </li>
                                            <li class="d-flex justify-content-start">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/Office Building.svg') }}">
                                                <p class="mb-2">{{ $rekomendasi->alamat_perusahaan }},
                                                </p>
                                            </li>
                                        </ul>
                                        <div class="text-left">
                                            <a id="detail-button" class="btn btn-primary px-4 py-2"
                                                style="border-radius: 25px;" href="">Lamar</a>
                                        </div>
                                        <div class="dropdown-divider mt-2"></div>
                                        <div class="col-md-12">
                                            <h5>Keahlian</h5>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5>
                                                        @php
                                                            $keahlian = explode(',', $rekomendasi->keahlian);
                                                        @endphp
                                                        @foreach ($keahlian as $keahlian)
                                                            <span
                                                                class="badge badge-warning text-white {{ $loop->last }}">{{ $keahlian }}</span>
                                                        @endforeach
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider mt-2"></div>
                                        <div class="col-md-12">
                                            <h5>Persyaratan</h5>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5>
                                                        @php
                                                            $persyaratan = explode(',', $rekomendasi->persyaratan);
                                                        @endphp
                                                        @foreach ($persyaratan as $persyaratan)
                                                            <span
                                                                class="badge badge-primary text-white {{ $loop->last }}">{{ $persyaratan }}</span>
                                                        @endforeach
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="d-flex justify-content-center">
                            {{-- {{ $allResults->withQueryString()->links() }} --}}
                        </div>
                    </div>


                </div>

            </div>
        </section>
    </main>

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
                    // Make an AJAX request to update bookmark status
                    // $.ajax({
                    //     type: 'POST',
                    //     url: '',
                    //     data: {
                    //         loker_id: lokerId
                    //     },
                    //     success: function(response) {
                    //         if (response.bookmarked) {
                    //             icon.find('i').removeClass('far fa-bookmark').addClass(
                    //                 'fas fa-bookmark');
                    //             Swal.fire({
                    //                 icon: 'success',
                    //                 title: 'Lowongan Pekerjaan Disimpan',
                    //                 showConfirmButton: false,
                    //                 timer: 1500
                    //             });
                    //         } else {
                    //             icon.find('i').removeClass('fas fa-bookmark').addClass(
                    //                 'far fa-bookmark');
                    //             Swal.fire({
                    //                 icon: 'success',
                    //                 title: 'Lowongan Pekerjaan Dihapus',
                    //                 showConfirmButton: false,
                    //                 timer: 1500
                    //             });
                    //         }

                    //         // Update bookmark status in local storage
                    //         localStorage.setItem(storageKey, response.bookmarked);

                    //         // Optionally, you can display a toast or notification to indicate success
                    //         if (response.bookmarked) {
                    //             // Example using Bootstrap Toast component
                    //             $('.toast').toast('show');
                    //         }
                    //     },
                    //     error: function(xhr, status, error) {
                    //         // Handle errors here if necessary
                    //         console.error(error);
                    //     }
                    // });
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
