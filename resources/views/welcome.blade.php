@extends('landing-page.app')
@section('title', 'JobKelasIndustri - Home')
@section('main')
    <main class="bg-light">
        <section>
            <div class="col-md-12 col-lg-12 col-sm-6 py-5 bagan1">
                <div class="d-flex justify-content-around align-items-center">
                    <div class="col-md-6">
                        <p class="mb-3 tag-title py-2 px-4 text-center ">Tersedia 100+ di kota Malang Raya</p>
                        <h1 class="font-weight-bolder title-tengah">Yuk Buat Waktumu Menjadi Berguna di <span
                                class="text-primary font-weight-bolder">Humma</span><span
                                class="text-warning font-weight-bolder">Tech</span> sesuai kebutuhan!</h1>
                        <p>Platform yang dirancang untuk memudahkan mencari peluang kerja paruh waktu yang sesuai dengan
                            kebutuhan Anda khusus di daerah Malang Raya.</p>
                        {{-- <form method="GET" action="{{ route('all-jobs.index') }}">
                            <div class="form-row">
                                <div class="form-group col-lg-10 col-md-5 col-sm-5">
                                    <input type="text" name="posisi" class="form-control pencarian" id="posisi"
                                        placeholder="Ketik posisi pekerjaan..."
                                        value="{{ app('request')->input('posisi') }}" style="border-radius: 25px;">
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-md-2">
                                    <button id="search-button" class="btn btn-primary mr-1 px-4" type="submit"
                                        style="border-radius: 25px;">Cari</button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4 bagan2">
                        <img class="img-fluid" src="{{ asset('assets/img/landing-page/image-1.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>

        {{-- @role('Pencari Kerja')
            <section>
                <div class="col-md-12 bg-white pb-5">
                    <div class="col-md-12 mt-0 mx-auto pt-4 pb-4 bg-white">
                        <h2 class="text-center font-weight-bold mt-4">Rekomendasi dari <span
                                class="text-primary font-weight-bold">Waktu</span><span class="text-warning font-weight-bold">
                                Saku</span>
                        </h2>
                        @if ($allRekomendasi->isEmpty())
                            <div class="col-md-12 text-center mt-5 py-5">
                                <img src="{{ asset('assets/img/landing-page/sad-face.png') }}">
                                <p class="mt-1 text-not mb-5">Belum ada rekomendasi untukmu</p>
                            </div>
                        @else
                            <div
                                class="row flex-nowrap overflow-auto mt-4 equal-height-cards group-card-view-mobile
                            justify-content-center align-items-center">
                                @foreach ($allRekomendasi as $key => $loker)
                                    <div class="col-md-3 mb-1 jarak-column-view-mobile">
                                        <div class="card">
                                            <div class="card-body d-flex flex-column card-view-mobile">
                                                <div class="position-relative">
                                                    <div class="gradient-overlay"></div>
                                                    <img class="img-fluid mb-3 fixed-height-image position-absolute top-0 start-50 translate-middle-x"
                                                        src="{{ asset('storage/' . $loker->logo) }}" alt="Company Logo">
                                                    <p class="text-white card-title font-weight-bold mb-0 ml-2 overlap-text"
                                                        style="font-size: 20px;">
                                                        {{ $loker->judul }}
                                                    </p>
                                                    <a class="text-white ml-2 overlap-text-2"
                                                        href="{{ route('detail-perusahaan.show', $loker->id_perusahaan) }}"
                                                        style="font-size: 14px;">
                                                        {{ $loker->nama }}
                                                    </a>
                                                </div>
                                                <div class="card-text mt-3">
                                                    <ul class="list-unstyled ml-2">
                                                        <ul class="list-unstyled d-flex justify-content-between">
                                                            <li class="d-flex justify-content-start">
                                                                <img class="img-fluid img-icon mr-2"
                                                                    src="{{ asset('assets/img/landing-page/list.svg') }}">
                                                                <p class="mb-2">{{ $loker->kategori }}</p>
                                                            </li>
                                                            <li class="mb-2">
                                                                @if (auth()->check() &&
    auth()->user()->hasRole('Pencari Kerja'))
                                                                    <a href="javascript:void(0);" class="bookmark-icon"
                                                                        data-loker-id="{{ $loker->id }}">
                                                                        <i class="far fa-bookmark" style="font-size: 20px;"></i>
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
                                                                src="{{ asset('assets/img/landing-page/job.svg') }}">
                                                            <p class="mb-2">{{ $loker->min_pengalaman }}</p>
                                                        </li>
                                                        <li class="d-flex justify-content-start">
                                                            <img class="img-fluid img-icon mr-2"
                                                                src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                                            <p class="mb-2">Minimal {{ $loker->min_pendidikan }}</p>
                                                        </li>
                                                        <li class="d-flex justify-content-start">
                                                            <img class="img-fluid img-icon mr-2"
                                                                src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                                            <p class="mb-2">{{ $loker->lokasi }}</p>
                                                        </li>
                                                        <li class="d-flex justify-content-start">
                                                            <img class="img-fluid img-icon mr-2"
                                                                src="{{ asset('assets/img/landing-page/Office Building.svg') }}">
                                                            <p class="mb-2">{{ $loker->alamat_perusahaan }},
                                                                {{ $loker->kelurahan }},
                                                                {{ $loker->kecamatan }}</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="text-center mb-3">
                                                    <a id="detail-button" class="btn btn-primary px-4 py-2"
                                                        style="border-radius: 25px;"
                                                        href="{{ route('all-jobs.show', $loker->id) }}">Lihat Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endrole --}}

        <section>
            <div class="col-md-12 py-5 bg-secondary py-5">
                <div class="d-flex justify-content-around align-items-center my-4">
                    <div class="col-md-4 bagan3">
                        <img class="img-fluid" src="{{ asset('assets/img/landing-page/image-2.svg') }}" alt="">
                    </div>
                    @guest
                        <div class="col-md-6 col-lg-6 col-sm-4">
                            <p class="mb-4 tag-prom py-2 px-4 text-center">Tersedia 100+ di kota Malang Raya</p>
                            <h1 class="font-weight-bold mb-4 title-tengah2">Mau Rekrut Karyawan dengan Cepat Secara <span
                                    class="text-primary font-weight-bolder">GRATIS? </span><span
                                    class="text-white font-weight-bolder">Bisa!</span>
                            </h1>
                            <p class="d-flex align-items-center mb-4 h4"><i class="fas fa-check-circle mr-3"></i>Pasang
                                Lowongan Pekerjaan tanpa
                                batas sesuai kebutuhan
                                perusahaan Anda.
                            </p>
                            <p class="d-flex align-items-center mb-4 h4"><i class="fas fa-check-circle mr-3"></i>Promosikan
                                Lowongan Pekerjaan
                                untuk mendapatkan lebih
                                banyak
                                pelamar.
                            </p>
                            <a id="register-button" class="btn btn-primary px-4 py-2" href="{{ route('register') }}"
                                style="border-radius: 25px;">
                                Buat Akun Sekarang
                            </a>
                        </div>
                    @endguest
                    {{-- @role('Perusahaan')
                        <div class="col-md-6">
                            <p class="mb-4 tag-prom py-2 px-4 text-center">Tersedia 100+ di kota Malang Raya</p>
                            <h1 class="font-weight-bold mb-4">Temukan Bakat Terbaik untuk Tim Anda
                                <span class="text-primary font-weight-bold">di Sini!</span>
                            </h1>
                            <p class="d-flex align-items-center mb-4"><i class="fas fa-check-circle mr-3"
                                    style="font-size: 25px;"></i>
                                Temukan calon karyawan yang berpotensi untuk mengisi peran penting dalam perusahaan Anda.
                            </p>
                            <p class="d-flex align-items-center mb-4"><i class="fas fa-check-circle mr-3"
                                    style="font-size: 25px;"></i>
                                Bergabunglah dengan kami dan temukan bakat-bakat terbaik untuk mendorong kesuksesan bisnis Anda!
                            </p>
                            <a id="register-button" class="btn btn-primary px-4"
                                href="{{ route('loker-perusahaan.index') }}" style="border-radius: 25px;">Mulai Merekrut</a>
                        </div>
                    @endrole
                    @role('Pencari Kerja')
                        <div class="col-md-6">
                            <p class="mb-4 tag-prom py-2 px-4 text-center">Tersedia 100+ di kota Malang Raya</p>
                            <h1 class="font-weight-bold mb-4 title-tengah2">Mau Tahu Status Lamaran Kamu Saat Ini Bagaimana ?
                                <span class="text-primary font-weight-bold">Bisa!</span>
                            </h1>
                            <p class="d-flex align-items-center mb-4"><i class="fas fa-check-circle mr-3"
                                    style="font-size: 25px;"></i>
                                Dapatkan pekerjaan impianmu dengan bantuan WaktuSaku!
                            </p>
                            <p class="d-flex align-items-center mb-4"><i class="fas fa-check-circle mr-3"
                                    style="font-size: 25px;"></i>
                                Lihat status terbaru lamaran kerjamu kapan saja.
                            </p>
                            <a id="register-button" class="btn btn-primary px-4" href="{{ route('melamar.status') }}"
                                style="border-radius: 25px;">Cek Lamaran</a>
                        </div>
                    @endrole --}}
                </div>
            </div>
        </section>

        <section>
            <div class="py-5" style="height: 100%;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <h2 class="text-center mt-4 font-weight-bold">Mengapa harus di <span
                                    class="text-primary font-weight-bolder">Humma</span><span
                                    class="text-warning font-weight-bolder">Tech</span><span
                                    class="font-weight-bolder">?</span>
                            </h2>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-md-3">
                            <div class="card border-primary mb-2 card-waktusaku-view-mobile card-body h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-check text-primary fa-3x mb-4"></i>
                                    <h5 class="card-title font-weight-bold d-block mx-2">Peluang Pekerjaan Sesuai</h5>
                                    <p class="card-text text-center">
                                        Temukan lowongan kerja yang relevan dengan minat bakat Anda. Mulai dari perusahaan
                                        teknologi,
                                        media kreatif, hingga startup yang sedang berkembang pesat.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-primary mb-2 card-waktusaku-view-mobile card-body h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-alt text-primary fa-3x mb-4"></i>
                                    <h5 class="card-title font-weight-bold d-block mx-2">Pengalaman Berharga</h5>
                                    <p class="card-text text-center">
                                        Peluang kerja di WaktuSaku membantu Anda dalam mendapatkan pengalaman
                                        kerja lebih awal. WaktuSaku akan memberikan keuntungan yang
                                        signifikan dalam pasar kerja setelah lulus.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-primary mb-2 card-waktusaku-view-mobile card-body h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-history text-primary fa-3x mb-4"></i>
                                    <h5 class="card-title font-weight-bold d-block mx-2">Waktu yang Fleksibel</h5>
                                    <p class="card-text text-center">
                                        Kamu memahami prioritas utama Anda sebagai mahasiswa. Oleh karena itu, Anda
                                        dapat menyesuaikan jadwal kerja Anda dengan jadwal kuliah dan kegiatan lainnya.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-primary mb-2 card-waktusaku-view-mobile card-body h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-percent text-primary fa-3x mb-4"></i>
                                    <h5 class="card-title font-weight-bold d-block mx-2">Mendapatkan Gaji Bonus</h5>
                                    <p class="card-text text-center">
                                        Selain mendapatkan peluang pekerjaan yang sesuai, Anda mendapatkan gaji bonus
                                        dari masing-masing perusahaan yang Anda minati jika Anda pekerja aktif.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="col-md-10 col-lg-10 col-sm-5 mt-0 mx-auto">
                <h2 class="text-center font-weight-bold">Lowongan Kerja Terbaru di <span
                        class="text-primary font-weight-bold">Humma</span><span
                        class="text-warning font-weight-bold">Tech</span></h2>
                <div class="row flex-nowrap overflow-auto mt-5 horizontal-scroll equal-height-cards group-card-view-mobile">
                    <div class="scroll-arrow left bg-transparent text-secondary">
                        <i class="fas fa-angle-left"></i>
                    </div>
                    {{-- @foreach ($allResults as $key => $loker)
                        <div class="col-md-4 jarak-column-view-mobile">
                            <div class="card">
                                <div class="card-body d-flex flex-column card-view-mobile">
                                    <div class="position-relative">
                                        <div class="gradient-overlay"></div>
                                        <img class="img-fluid mb-3 fixed-height-image position-absolute top-0 start-50 translate-middle-x "
                                            src="{{ asset('storage/' . $loker->logo) }}" alt="Company Logo">
                                        <p class="text-white card-title font-weight-bold mb-0 ml-2 overlap-text"
                                            style="font-size: 20px;">
                                            {{ $loker->judul }}
                                        </p>
                                        <a class="text-white ml-2 overlap-text-2"
                                            href="{{ route('detail-perusahaan.show', $loker->id_perusahaan) }}"
                                            style="font-size: 14px;">
                                            {{ $loker->nama }}
                                        </a>
                                    </div>
                                    <div class="card-text mt-3">
                                        <ul class="list-unstyled ml-2">
                                            <ul class="list-unstyled d-flex justify-content-between">
                                                <li class="d-flex justify-content-start">
                                                    <img class="img-fluid img-icon mr-2"
                                                        src="{{ asset('assets/img/landing-page/list.svg') }}">
                                                    <p class="mb-2">{{ $loker->kategori }}</p>
                                                </li>
                                                <li class="mb-2">
                                                    @if (auth()->check() &&
    auth()->user()->hasRole('Pencari Kerja'))
                                                        <a href="javascript:void(0);" class="bookmark-icon"
                                                            data-loker-id="{{ $loker->id }}">
                                                            <i class="far fa-bookmark" style="font-size: 20px;"></i>
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
                                                    src="{{ asset('assets/img/landing-page/job.svg') }}">
                                                <p class="mb-2">{{ $loker->min_pengalaman }}</p>
                                            </li>
                                            <li class="d-flex justify-content-start">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                                <p class="mb-2">Minimal {{ $loker->min_pendidikan }}</p>
                                            </li>
                                            <li class="d-flex justify-content-start">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                                <p class="mb-2">{{ $loker->lokasi }}</p>
                                            </li>
                                            <li class="d-flex justify-content-start">
                                                <img class="img-fluid img-icon mr-2"
                                                    src="{{ asset('assets/img/landing-page/Office Building.svg') }}">
                                                <p class="mb-2">{{ $loker->alamat_perusahaan }},
                                                    {{ $loker->kelurahan }},
                                                    {{ $loker->kecamatan }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="text-center mb-3">
                                        <a id="detail-button" class="btn btn-primary px-4 py-2"
                                            style="border-radius: 25px;"
                                            href="{{ route('all-jobs.show', $loker->id) }}">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                    <div class="scroll-arrow right bg-transparent text-secondary">
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- <script>
        const scrollableContent = document.querySelector('.horizontal-scroll');
        const scrollLeftArrow = document.querySelector('.scroll-arrow.left');
        const scrollRightArrow = document.querySelector('.scroll-arrow.right');

        scrollLeftArrow.addEventListener('click', () => {
            scrollableContent.scrollLeft -= 360;
        });

        scrollRightArrow.addEventListener('click', () => {
            scrollableContent.scrollLeft += 360;
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
    <!-- Your existing script includes -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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
                }

                icon.click(function() {
                    // Make an AJAX request to update bookmark status
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('bookmark.toggle') }}', // Update this route
                        data: {
                            loker_id: lokerId
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
                            // Refresh the page
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            // Handle errors here if necessary
                            console.error(error);
                        }
                    });
                });
            });
        });
    </script> --}}
@endsection

@push('customScript')
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
@endpush

@push('customStyle')
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush
