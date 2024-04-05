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
                            <div class="profile-widget-name mt-2 ml-3">List Data Pendidikan</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if (count($pendidikan) > 0)
            @foreach ($pendidikan as $item)
                <section class="centered-section">
                    <div class="bg-primary-section col-md-10 py-1">
                        <div class="profile-widget-description m-3"
                            style="font-weight: bold; font-size: 16px; display: flex; align-items: center;">
                            <div class="flex-grow-1">
                                <div class="profile-widget-name"
                                    style="font-weight: bold; font-size: 18px; display: flex; align-items: center;">
                                    {{ $item->nama_institusi }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-end" style="font-size: 2.00em;" id="fluid">
                                <a href="#" data-id="{{ $item->id }}"
                                    data-edit-url="{{ route('pendidikan.edit', ['pendidikan' => $item->id]) }}"
                                    class="modal-edit-trigger">
                                    <img class="img-fluid" style="width: 30px; height: 30px;"
                                        src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-unstyled ml-2">
                                <li class="mb-2"><img class="img-fluid"
                                        src="{{ asset('assets/img/landing-page/Graduation Cap (2).svg') }}">&nbsp&nbsp&nbsp&nbsp
                                    {{ $item->tingkatan }} - {{ $item->jurusan }}
                                </li>
                                <li class="mb-2"><img class="img-fluid"
                                        src="{{ asset('assets/img/landing-page/Time.svg') }}">&nbsp&nbsp&nbsp&nbsp
                                    {{ $item->tahun_mulai }} - {{ $item->tahun_selesai }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            @endforeach
        @endif
    </main>

    <!-- Modal Edit Pendidikan -->
    <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mx-auto" role="document">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header m-4">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Edit
                            Pendidikan</h5>
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
                                    <label for="tingkatan">Tingkatan</label>
                                    <select class="form-control custom-input @error('tingkatan') is-invalid @enderror"
                                        name="tingkatan" id="tingkatan">
                                        <option value="">Pilih Tingkatan</option>
                                        <option value="SMA/SMK">SMK</option>
                                        <option value="D3">Diploma III</option>
                                        <option value="D4">Diploma IV</option>
                                        <option value="S1">Sarjana</option>
                                        <option value="S2">Magister</option>
                                    </select>
                                    @error('tingkatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Nama Institusi</label>
                                    <input name="nama_institusi" type="text"
                                        class="form-control custom-input @error('nama_institusi') is-invalid @enderror"
                                        value="{{ old('nama_institusi') }}">
                                    @error('nama_institusi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="form-group col-md-12 col-12">
                                    <label>Jurusan</label>
                                    <input name="jurusan" type="text"
                                        class="form-control custom-input @error('jurusan') is-invalid @enderror"
                                        value="{{ old('jurusan') }}">
                                    @error('jurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ml-4 mr-4">
                                <div class="col-md-12 mb-1 form-group">
                                    <label for="tahun">Periode Waktu</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <select class="form-control custom-input @error('tahun_mulai') is-invalid @enderror"
                                        name="tahun_mulai" id="tahun_mulai">
                                        <option value="">Pilih Tahun</option>
                                        @for ($tahun = 2017; $tahun <= date('Y'); $tahun++)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endfor
                                    </select>
                                    @error('tahun_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <span> - </span>
                                <div class="col-md-4 form-group">
                                    <select class="form-control custom-input @error('tahun_selesai') is-invalid @enderror"
                                        name="tahun_selesai" id="tahun_selesai">
                                        <option value="">Pilih Tahun</option>
                                        @for ($tahun = 2017; $tahun <= date('Y'); $tahun++)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endfor
                                        <option value="Saat Ini">Saat Ini</option>
                                    </select>
                                    @error('tahun_selesai')
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
    </div>
@endsection

@push('customScript')
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.modal-edit-trigger').on('click', function() {
                var itemId = $(this).data('id');
                var editUrl = "{{ route('pendidikan.edit', ['pendidikan' => '_id']) }}".replace('_id',
                    itemId);
                var updateUrl = "{{ route('pendidikan.update', ['pendidikan' => '_id']) }}".replace('_id',
                    itemId);
                $('#modal-edit-form').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#modal-edit select[name="tingkatan"]').val(data.tingkatan);
                        $('#modal-edit input[name="nama_institusi"]').val(data.nama_institusi);
                        $('#modal-edit input[name="jurusan"]').val(data.jurusan);
                        $('#modal-edit select[name="tahun_mulai"]').val(data.tahun_mulai);
                        $('#modal-edit select[name="tahun_selesai"]').val(data.tahun_selesai);
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
