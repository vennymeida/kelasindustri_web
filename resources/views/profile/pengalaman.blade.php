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
                            <div class="profile-widget-name mt-2 ml-3">List Data Pengalaman Kerja</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if (count($pengalaman) > 0)
            @foreach ($pengalaman as $item)
                <section class="centered-section">
                    <div class="bg-primary-section col-md-10 py-1">
                        <div class="profile-widget-description m-3"
                            style="font-weight: bold; font-size: 16px; display: flex; align-items: center;">
                            <div class="flex-grow-1">
                                <div class="profile-widget-name"
                                    style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                                    {{ $item->nama_pekerjaan }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-end" style="font-size: 2.00em;" id="fluid">
                                <a href="#" data-id="{{ $item->id }}"
                                    data-edit-url="{{ route('pengalaman.edit', ['pengalaman' => $item->id]) }}"
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
                                    {{ $item->nama_perusahaan }} | {{ $item->alamat }}
                                </div>
                            </div>
                            <ul class="list-unstyled ml-2">
                                <li class="mb-2"><img class="img-fluid"
                                        src="{{ asset('assets/img/landing-page/Hourglass.svg') }}">&nbsp&nbsp&nbsp{{ $item->tipe }}
                                </li>
                                <li class="mb-2"><img class="img-fluid"
                                        src="{{ asset('assets/img/landing-page/money-2.svg') }}">&nbsp&nbsp&nbspIDR
                                    {{ $item->gaji }}
                                </li>
                                <li class="mb-2"><img class="img-fluid"
                                        src="{{ asset('assets/img/landing-page/Time.svg') }}">&nbsp&nbsp&nbsp{{ $item->tanggal_mulai }}
                                    - {{ $item->tanggal_berakhir }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            @endforeach
        @endif
    </main>

    <!-- Modal Edit Pengalaman -->
    <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mx-auto" role="document">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header m-4">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Edit
                            Pengalaman Kerja</h5>
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
                                    <label for="nama_pekerjaan">Nama Pekerjaaan</label>
                                    <input name="nama_pekerjaan" type="text"
                                        class="form-control custom-input @error('nama_pekerjaan') is-invalid @enderror"
                                        value="{{ old('nama_pekerjaan') }}">
                                    @error('nama_pekerjaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Nama Perusahaan</label>
                                    <input name="nama_perusahaan" type="text"
                                        class="form-control custom-input @error('nama_perusahaan') is-invalid @enderror"
                                        value="{{ old('nama_perusahaan') }}">
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control custom-input @error('alamat') is-invalid @enderror" rows="4">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-6 col-12">
                                    <label>Tipe Pekerjaan</label>
                                    <select class="form-control custom-input @error('tipe') is-invalid @enderror"
                                        name="tipe" id="tipe">
                                        <option value="">Pilih Tipe Pekerjaan</option>
                                        <option value="Fulltime">Fulltime</option>
                                        <option value="Parttime">Part Time</option>
                                        <option value="Freelance">Freelance</option>
                                        <option value="Internship">Internship</option>
                                    </select>
                                    @error('tipe')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="gaji">Gaji (Opsional)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text custom-input">
                                                <a>Rp</a>
                                            </div>
                                        </div>
                                        <input name="gaji" type="number" step="100000"
                                            class="form-control custom-input @error('gaji') is-invalid @enderror"
                                            value="{{ old('gaji') }}">
                                        @error('gaji')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-6 col-12">
                                    <label>Tanggal Mulai</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text custom-input">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input name="tanggal_mulai" type="date"
                                            class="form-control custom-input @error('tanggal_mulai') is-invalid @enderror"
                                            value="{{ old('tanggal_mulai') }}">
                                        @error('tanggal_mulai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-6 col-12">
                                    <label>Tanggal Berakhir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text custom-input">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input name="tanggal_berakhir" type="date"
                                            class="form-control custom-input @error('tanggal_berakhir') is-invalid @enderror"
                                            value="{{ old('tanggal_berakhir') }}">
                                        @error('tanggal_berakhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.modal-edit-trigger').on('click', function() {
                var itemId = $(this).data('id');
                var editUrl = "{{ route('pengalaman.edit', ['pengalaman' => '_id']) }}".replace('_id',
                    itemId);
                var updateUrl = "{{ route('pengalaman.update', ['pengalaman' => '_id']) }}".replace('_id',
                    itemId);
                $('#modal-edit-form').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#modal-edit input[name="nama_pekerjaan"]').val(data.nama_pekerjaan);
                        $('#modal-edit input[name="nama_perusahaan"]').val(data.nama_perusahaan);
                        $('#modal-edit textarea[name="alamat"]').val(data.alamat);
                        $('#modal-edit select[name="tipe"]').val(data.tipe);
                        $('#modal-edit input[name="gaji"]').val(data.gaji);
                        $('#modal-edit input[name="tanggal_mulai"]').val(data.tanggal_mulai);
                        $('#modal-edit input[name="tanggal_berakhir"]').val(data.tanggal_berakhir);

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
