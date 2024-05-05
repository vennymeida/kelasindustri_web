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
                                <a href="{{ url('/profile-lulusan') }}">
                                    <img class="img-fluid mt-1" style="width: 30px; height: 30px;"
                                        src="{{ asset('assets/img/Vector.svg') }}">
                                </a>
                            </div>
                            <div class="profile-widget-name mt-2 ml-3">Daftar Portofolio</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if ($portofolios->count() > 0)
            @foreach ($portofolios as $portofolio)
                <section class="centered-section">
                    <div class="bg-primary-section col-md-10 py-1">
                        <div class="profile-widget-description m-3"
                            style="font-weight: bold; font-size: 16px; display: flex; align-items: center;">
                            <div class="flex-grow-1">
                                <div class="profile-widget-name"
                                    style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                                    {{ $portofolio->nama_portofolio }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-end" style="font-size: 2.00em;" id="fluid">
                                <a href="#" data-toggle="modal" data-target="#modal-edit"
                                    data-id="{{ $portofolio->id }}"
                                    data-edit-url="{{ route('portofolio.edit', ['portofolio' => $portofolio->id]) }}"
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
                                    <a href="{{ $portofolio->link_portofolio }}" target="_blank">
                                        Lihat Portofolio
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        @else
            <section class="centered-section">
                <div class="bg-primary-section col-md-10 py-1 text-center">
                    <p>Belum ada portofolio.</p>
                </div>
            </section>
        @endif
    </main>

    <!-- Modal Edit Portofolio -->
    <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mx-auto" role="document">
            <div class="modal-content">
                <div class="modal-header m-4">
                    <h5 class="modal-title" style="color: #6777ef; font-weight: bold;">Edit Portofolio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="modal-edit-form" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row ml-4 mr-4">
                            <div class="form-group col-md-12 col-12">
                                <label for="nama_portofolio">Nama Portofolio</label>
                                <input name="nama_portofolio" type="text"
                                    class="form-control custom-input @error('nama_portofolio') is-invalid @enderror"
                                    value="{{ old('nama_portofolio') }}">
                                @error('nama_portofolio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row ml-4 mr-4">
                            <div class="form-group col-md-12 col-12">
                                <label for="link_portofolio">Link Portofolio</label>
                                <input name="link_portofolio" type="url"
                                    class="form-control custom-input @error('link_portofolio') is-invalid @enderror"
                                    value="{{ old('link_portofolio') }}">
                                @error('link_portofolio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
@endsection

@push('customScript')
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.modal-edit-trigger').on('click', function() {
                var itemId = $(this).data('id');
                var editUrl = "{{ route('portofolio.edit', ['portofolio' => '_id']) }}".replace('_id', itemId);
                var updateUrl = "{{ route('portofolio.update', ['portofolio' => '_id']) }}".replace('_id', itemId);
                $('#modal-edit-form').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#modal-edit input[name="nama_portofolio"]').val(data.nama_portofolio);
                        $('#modal-edit input[name="link_portofolio"]').val(data.link_portofolio);

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
                        alert('Error saat memperbarui data!');
                    }
                });
            });
        });
    </script>
@endpush
@push('customStyle')
@endpush
