@extends('landing-page.app')
@section('main')
    <main class="bg-secondary">
        <section class="centered-section">
            <div class="bg-primary-section col-md-10 py-1">
                <div class="profile-widget-description m-3"
                    style="font-weight: bold; font-size: 18px; display: flex; align-items: center; color:#6777ef">
                    <div class="flex-grow-1">
                        <div class="row">
                            <div>
                                <a href="{{ url('/profile') }}">
                                    <img class="img-fluid mt-1" style="width: 30px; height: 30px;"
                                        src="{{ asset('assets/img/Vector.svg') }}">
                                </a>
                            </div>
                            <div class="profile-widget-name mt-2 ml-3">List Data Pelatihan/Sertifikat</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if (count($pelatihan) > 0)
            @foreach ($pelatihan as $item)
                <section class="centered-section">
                    <div class="bg-primary-section col-md-10 py-1">
                        <div class="profile-widget-description m-3"
                            style="font-weight: bold; font-size: 16px; display: flex; align-items: center;">
                            <div class="flex-grow-1">
                                <div class="profile-widget-name"
                                    style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                                    {{ $item->nama_sertifikat }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-end" style="font-size: 2.00em;" id="fluid">
                                <a href="#" data-toggle="modal" data-target="#modal-edit"
                                    data-id="{{ $item->id }}"
                                    data-edit-url="{{ route('pelatihan.edit', ['pelatihan' => $item->id]) }}"
                                    class="modal-edit-trigger">
                                    <img class="img-fluid" style="width: 30px; height: 30px;"
                                        src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="flex-grow-1 mb-2">
                                <div class="profile-widget-name"
                                    style="font-size: 16px; display: flex; align-items: center;">
                                    {{ $item->deskripsi }}
                                </div>
                            </div>
                            <ul class="list-unstyled ml-2">
                                <li class="mb-2"><img class="img-fluid"
                                        src="{{ asset('assets/img/landing-page/Office Building-2.svg') }}">&nbsp&nbsp&nbsp
                                    {{ $item->penerbit }}
                                </li>
                                <li class="mb-2"><img class="img-fluid"
                                        src="{{ asset('assets/img/landing-page/Time.svg') }}">&nbsp&nbsp&nbsp&nbsp&nbsp
                                    {{ $item->tanggal_dikeluarkan }}
                                </li>
                            </ul>
                            <div style="font-size: 16px;">
                                <a href="#" class="open-pdf" data-sertifikat="{{ $item->sertifikat }}">
                                    <p class="">Lihat Sertifikat</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        @endif
    </main>

    <!-- Add a hidden modal to display the PDF -->
    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Sertifikat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="pdfViewer" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pelatihan -->
    <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mx-auto" role="document">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header m-4">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Edit
                            Pelatihan Kerja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="modal-edit-form" class="needs-validation" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label for="nama_sertifikat">Nama</label>
                                    <input name="nama_sertifikat" type="text"
                                        class="form-control custom-input @error('nama_sertifikat') is-invalid @enderror"
                                        value="{{ old('nama_sertifikat') }}">
                                    @error('nama_sertifikat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control custom-input @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Penerbit</label>
                                    <input name="penerbit" type="text"
                                        class="form-control custom-input @error('penerbit') is-invalid @enderror"
                                        value="{{ old('penerbit') }}">
                                    @error('penerbit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-6 col-12">
                                    <label>Tanggal Dikeluarkan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text custom-input">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input name="tanggal_dikeluarkan" type="date"
                                            class="form-control custom-input @error('tanggal_dikeluarkan') is-invalid @enderror"
                                            value="{{ old('tanggal_dikeluarkan') }}">
                                        @error('tanggal_dikeluarkan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Unggah Sertifikat (Opsional)</label>
                                    <input id="sertifikat" name="sertifikat" type="file"
                                        class="form-control custom-input @error('sertifikat') is-invalid @enderror">
                                    @error('sertifikat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="text-warning small" style="font-size: 13px; font-weight:medium;">
                                        (Tipe berkas : pdf | Max size : 2MB)</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-whitesmoke m-4">
                        <button type="button" class="btn btn-primary" id="modal-save-button"
                            style="border-radius: 15px; font-size: 14px">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="border-radius: 15px; font-size: 14px">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('customScript')
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.362/pdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.362/pdf_viewer.min.css">
    <script>
        $(document).ready(function() {
            $('.open-pdf').on('click', function() {
                var pdfUrl = $(this).data('sertifikat');

                loadAndDisplayPDF(pdfUrl);
            });

            function loadAndDisplayPDF(pdfUrl) {
                var loadingTask = pdfjsLib.getDocument(pdfUrl);

                loadingTask.promise.then(function(pdfDoc) {
                    var pdfViewer = document.getElementById('pdfViewer');
                    while (pdfViewer.hasChildNodes()) {
                        pdfViewer.removeChild(pdfViewer.lastChild);
                    }

                    pdfDoc.getPage(1).then(function(page) {
                        var viewport = page.getViewport({
                            scale: 1.0
                        });
                        var canvas = document.createElement('canvas');
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        pdfViewer.appendChild(canvas);

                        page.render({
                            canvasContext: context,
                            viewport: viewport
                        });
                    });

                    // Show the modal
                    $('#pdfModal').modal('show');
                }, function(error) {
                    console.error('Error loading PDF: ' + error.message);
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.modal-edit-trigger').on('click', function() {
                var itemId = $(this).data('id');
                var editUrl = "{{ route('pelatihan.edit', ['pelatihan' => '_id']) }}".replace('_id',
                    itemId);
                var updateUrl = "{{ route('pelatihan.update', ['pelatihan' => '_id']) }}".replace('_id',
                    itemId);
                $('#modal-edit-form').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#modal-edit input[name="nama_sertifikat"]').val(data.nama_sertifikat);
                        $('#modal-edit textarea[name="deskripsi"]').val(data.deskripsi);
                        $('#modal-edit input[name="penerbit"]').val(data.penerbit);
                        $('#modal-edit input[name="tanggal_dikeluarkan"]').val(data.tanggal_dikeluarkan);
                        $('#modal-edit input[name="sertifikat"]').val(data.sertifikat);

                        $('#modal-edit').modal('show');
                    }
                });
            });

            $('#modal-save-button').on('click', function() {
                var form = $('#modal-edit-form');
                var formData = new FormData(form[0]);
                formData.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            $('#modal-edit').modal('hide');
                            location.reload();
                        } else {
                            alert('Error! ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Error while updating data!');
                    }
                });
            });
        });
    </script>
@endpush
@push('customStyle')
@endpush
