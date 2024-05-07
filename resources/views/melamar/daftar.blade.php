<div class="modal fade" id="lamarModal" tabindex="-1" aria-labelledby="lamarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @if (auth()->user() && auth()->user()->isComplete())
                    <!-- User Profile is Complete -->
                    <p><strong>Hai, {{ auth()->user()->name }}</strong></p>
                    <p>Data yang lengkap memudahkan Anda dalam melamar pekerjaan dan perusahaan (HRD) tertarik dengan
                        data yang lengkap. Anda akan mendaftar lowongan pekerjaan dengan rincian sebagai berikut :</p>

                    <!-- Card 1: Job Details -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <!-- Image on the left -->
                                <div class="col-md-4">
                                    <img class="img-fluid rounded-circle"
                                        src="{{ asset('storage/' . $loker->perusahaan->logo_perusahaan) }}"
                                        style="width: 180px; height: 180px; background: linear-gradient(to bottom, rgb(196, 204, 213, 0.2), rgb(196, 204, 213, 0.7));">
                                </div>
                                <!-- Job details on the right -->
                                <div class="col-md-8 job-details-col">
                                    <p class="mb-2 text-primary font-weight-bold" style="font-size: 24px;">
                                        {{ $loker->nama_loker }}
                                    </p>
                                    <p class="mb-2" style="font-size: 19px;">{{ $loker->perusahaan->nama_perusahaan }}
                                    </p>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><img class="img-fluid img-icon"
                                                src="{{ asset('assets/img/landing-page/money.svg') }}">
                                            {{ 'IDR ' . $loker->gaji_bawah }} <span>-</span> {{ $loker->gaji_atas }}
                                        </li>
                                        <li class="mb-2"><img class="img-fluid img-icon"
                                                src="{{ asset('assets/img/landing-page/Graduation Cap.svg') }}">
                                            Minimal {{ $loker->keahlian }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Resume Details -->
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('melamar.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h6 class="mb-3">CV / Resume *</h6>
                                <div class="d-flex flex-column align-items-center">
                                    @if (auth()->user() && auth()->user()->resume)
                                        <img id="fileIcon" src="{{ asset('assets/img/lamar/file2.svg') }}"
                                            alt="Upload Icon" class="img-fluid img-icon"
                                            style="width: 50px; height: 50px;">
                                        <span class="mb-2" id="current-resume-name"
                                            data-url="{{ Storage::url(auth()->user()->resume ?? '') }}">{{ basename(auth()->user()->resume) }}</span>
                                        <a href="#" id="viewResumeLink" onclick="return openResume();"
                                            class="btn btn-link mb-2">View Current Resume</a>
                                        <small class="text-muted mb-2">Unggah berkas dalam format PDF (maksimal
                                            2mb)</small>
                                        <button type="button" onclick="document.getElementById('new_resume').click();"
                                            class="btn btn-secondary mb-3">Ganti</button>
                                    @else
                                        <img id="fileIcon" src="{{ asset('assets/img/lamar/file2.svg') }}"
                                            alt="Upload Icon" class="img-fluid img-icon"
                                            style="width: 50px; height: 50px;" hidden>
                                        <span class="mb-2" id="current-resume-name"></span>
                                        <a href="#" id="viewResumeLink" onclick="return openResume();"
                                            class="btn btn-link mb-2" hidden>View Current Resume</a>
                                        <small id="uploadInstruction" class="text-muted mb-2">Anda belum memiliki
                                            CV.</small>
                                        <small class="text-muted mb-2">Unggah berkas dalam format PDF (maksimal
                                            2mb)</small>
                                        <button type="button" onclick="document.getElementById('new_resume').click();"
                                            class="btn btn-primary mb-3">Unggah Resume</button>
                                    @endif
                                </div>

                                <input type="file" class="form-control-file d-none" name="resume" id="new_resume">
                                <input type="hidden" name="loker_id" value="{{ $loker->id }}">

                                <button type="submit" class="btn btn-primary btn-block mt-3">Lamar Sekarang</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- User Profile is Incomplete -->
                    <div class="alert alert-warning">
                        Tolong selesaikan profile anda sebelum melamar pekerjaan.
                        <a href="{{ route('profile-lulusan.edit') }}" class="alert-link">Click disini untuk
                            menyelesaikan
                            profile anda</a>.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeModalButton"
                            data-dismiss="modal">Close</button>
                    </div>

                @endif
            </div>
        </div>
    </div>
    <!-- Display Laravel validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</div>


<script>
    $(document).ready(function() {
        function openResume() {
            const urlResume = $('#current-resume-name').attr('data-url');
            window.open(urlResume, "ResumeWindow", "width=600,height=800");
            return false;
        }

        $('#new_resume').on('change', function(e) {
            let file = this.files[0];
            let fileSize = file.size / 1024 / 1024; // in MB
            let allowedExtensions = /(\.pdf)$/i;

            if (!allowedExtensions.exec(file.name) || fileSize > 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File',
                    text: 'Hanya dokumen dalam format PDF yang diperbolehkan dengan ukuran maksimal 2MB!'
                });
                this.value = ''; // reset the input
                return false;
            }

            $('#current-resume-name').text(file.name);
            const newResumeUrl = URL.createObjectURL(file);
            $('#current-resume-name').attr('data-url', newResumeUrl);
            $('#fileIcon').removeAttr('hidden');
            $('#viewResumeLink').removeAttr('hidden');
            $('#uploadInstruction').hide();
        });

        $('form').on('submit', function(e) {
            let currentResume = $('#current-resume-name').attr('data-url');
            let newResume = $('#new_resume').val();

            if (!currentResume && !newResume) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Anda harus mengunggah resume sebelum melamar!'
                });
                e.preventDefault();
            }
        });

        let successMessage = "{{ session('success') }}";
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: successMessage
            });
        }

        $('#closeModalButton').on('click', function() {
            $('#lamarModal').modal('hide');
        });

        // Tambahkan event handler untuk tombol "Lamar Sekarang"
        $('#lamar-sekarang-button').on('click', function() {
            let currentResume = $('#current-resume-name').attr('data-url');

            if (currentResume) {
                // Lakukan tindakan melamar, misalnya dengan menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: '{{ route('melamar.store') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        loker_id: '{{ $loker->id }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Anda telah berhasil melamar pekerjaan.'
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat melakukan lamaran.'
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Anda harus mengunggah resume sebelum melamar!'
                });
            }
        });

        window.openResume = openResume; // Make it global
    });
</script>


<style>
    .fixed-height-image {
        max-width: 150px;
        /* Adjust this value based on your preferred logo size */
        height: auto;
    }

    .job-details-col {
        padding-left: 20px;
    }

    .btn-block {
        display: block;
        width: 100%;
    }
</style>

@push('customScript')
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
@endpush
