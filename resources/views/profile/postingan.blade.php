@extends('landing-page.app')
@section('title', 'WaktuSaku - Aktivitas Saya')
@section('main')
    <main class="bg-light">
        <section>
            <div class="bg-white mt-4 mb-0 card col-md-10 py-1 mx-auto">
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
                            <div class="profile-widget-name mt-2 ml-3">Cerita Saya</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if (count($postingan) > 0)
            <div id="postingan-container">
                @foreach ($postingan as $post)
                    <div class="col-md-10 mx-auto my-4">
                        <div class="post" style="padding:3%">
                            <div class="post-author">
                                @if (Auth::user()->profile && Auth::user()->profile->foto)
                                    <img src="{{ Storage::url(Auth::user()->profile->foto) }}" alt=""
                                        class="profile-img" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt=""
                                        class="profile-img" style="width: 50px; height: 50px;">
                                @endif
                                <div class="d-flex flex-column col-md-11">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h1 class="mb-0 mr-2 p-m-name">{{ auth()->user()->name }}</h1>
                                        <div class="d-flex align-items-center">
                                            <img class="img-fluid" src="{{ asset('assets/img/landing-page/Time.svg') }}"
                                                style="max-width: 16px; max-height: 16px; margin-right: 5px;">
                                            <h4 class="mb-0 p-time">{{ $post->timeAgo }} </h4>
                                        </div>
                                    </div>
                                    <small>{{ auth()->user()->email }}</small>
                                </div>
                            </div>
                            @if (!empty($post->media))
                                <p>{!! $post->konteks !!}</p>
                                <img src="{{ asset('storage/' . $post->media) }}" width="50%" height="50%"
                                    style="display: block; margin: 0 auto; margin-bottom: 20px; text-align: center;">
                                <div class="row">
                                    <div class="d-flex justify-content-end ml-auto" style="font-size: 2.00em;">
                                        <a href="#" data-id="{{ $post->id }}"
                                            data-edit-url="{{ route('postingan.edit', ['postingan' => $post->id]) }}"
                                            class="modal-edit-trigger-postingan">
                                            <img class="img-fluid" style="width: 30px; height: 30px;"
                                                src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-end" style="font-size: 2.00em;">
                                        <form action="{{ route('postingan.destroy', ['postingan' => $post->id]) }}"
                                            method="POST" id="delete-post{{ $post->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-edu"
                                                onclick="confirmPost({{ $post->id }})">
                                                <img class="img-fluid" style="width: 30px; height: 30px;"
                                                    src="{{ asset('assets/img/landing-page/delete.svg') }}" alt="Hapus">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <p>{!! $post->konteks !!}</p>
                                <div class="row">
                                    <div class="d-flex justify-content-end ml-auto" style="font-size: 2.00em;">
                                        <a href="#" data-id="{{ $post->id }}"
                                            data-edit-url="{{ route('postingan.edit', ['postingan' => $post->id]) }}"
                                            class="modal-edit-trigger-postingan">
                                            <img class="img-fluid" style="width: 30px; height: 30px;"
                                                src="{{ asset('assets/img/landing-page/edit-pencil.svg') }}">
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-end" style="font-size: 2.00em;">
                                        <form action="{{ route('postingan.destroy', ['postingan' => $post->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link">
                                                <img class="img-fluid" style="width: 30px; height: 30px;"
                                                    src="{{ asset('assets/img/landing-page/delete.svg') }}" alt="Hapus">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- </section> --}}
                @endforeach
                {{-- </div> --}}
                <div class="d-flex justify-content-center">
                    {{ $postingan->withQueryString()->links() }}
                </div>
            </div>
        @else
            <div class="col-md-12 text-center my-4"><br><br>
                <img src="{{ asset('assets/img/landing-page/folder.png') }}">
                <p class="mt-1 text-not">Belum Ada Postingan Anda</p>
            </div>
        @endif
    </main>

    <!-- Modal Edit Postingan -->
    <div id="modal-edit-postingan" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mx-auto" role="document">
            <div class="modal-content">
                <div class="modal-header m-4">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #6777ef; font-weight: bold;">Edit
                        Postingan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="modal-edit-postingan-form" class="needs-validation" novalidate=""
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row ml-4 mr-4">
                            <div class="form-group col-md-12 col-12">
                                <div class="card-body">
                                    <div class="media mb-4">
                                        @if (Auth::user()->profile && Auth::user()->profile->foto != '')
                                            <img class="mr-3 rounded-circle" style="width: 50px; height: 50px;"
                                                src="{{ Auth::user()->profile ? Storage::url(Auth::user()->profile->foto) : '' }}"
                                                alt="Profile Image">
                                        @else
                                            <img class="mr-3 rounded-circle" style="width: 50px; height: 50px;"
                                                src="{{ asset('assets/img/avatar/avatar-1.png') }}">
                                        @endif
                                        <div class="media-body">
                                            <h5 class="mt-0" style="font-weight: bold;">{{ auth()->user()->name }}
                                            </h5>
                                            <!-- Informasi tambahan mengenai user, seperti bio atau status -->
                                            <p>{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="konteks">Konten Postingan</label>
                                        <textarea name="konteks" id="konteks" class="form-control summernote @error('konteks') is-invalid @enderror"
                                            required rows="5" cols="50">
                                            @isset($post)
{!! $post->konteks !!}
@endisset
                                        </textarea>
                                        @if ($errors->has('konteks') && isset($post))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="media mb-4">
                                        <!-- Tampilkan media yang ingin diedit -->
                                        <img id="media-preview" class="mr-3 rounded p-m-media" width="100%">
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <label for="mediaUploadButton" style="cursor: pointer;">
                                                    <img class="img-fluid"
                                                        src="{{ asset('assets/img/Gallery Add.svg') }}">
                                                    &nbsp;&nbsp;&nbsp; Ganti
                                                </label>
                                                <input type="file" id="mediaUploadButton" class="d-none"
                                                    accept="image/*">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke m-4">
                    <button type="button" class="btn btn-primary" id="modal-save-button-postingan"
                        style="border-radius: 15px; font-size: 14px">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="border-radius: 15px; font-size: 14px">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmPost(itemId) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-confirm',
                    cancelButton: 'btn btn-cancel',
                },
                buttonsStyling: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-post' + itemId).submit();
                }
            });
        }
    </script>
    <script>
        @if (session('success') === 'success-create')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Postingan berhasil ditambahkan.',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    <script>
        @if (session('success') === 'success-delete')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Postingan berhasil dihapus.',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection

@push('customScript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
@endpush

@push('customScript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ asset('assets/js/summernote-bs4.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            var editModal = $('#modal-edit-postingan');
            var originalKonteks = ''; // Menyimpan konteks asli

            // Menangani perubahan pada input file untuk pengunggahan gambar
            $('#mediaUploadButton').on('change', function(event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#media-preview').attr('src', e.target.result);
                        $('#media-preview').show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#media-preview').removeAttr('src');
                    $('#media-preview').hide();
                }
            });

            function openEditModal(postId) {
                var editUrl = "{{ route('postingan.edit', ['postingan' => '_id']) }}".replace('_id', postId);
                var updateUrl = "{{ route('postingan.update', ['postingan' => '_id']) }}".replace('_id', postId);

                $('#modal-edit-postingan-form').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        originalKonteks = data.konteks; // Simpan konteks asli
                        $('#modal-edit-postingan textarea[name="konteks"]').summernote('code', data
                            .konteks); // Set konteks menggunakan Summernote
                        $('#modal-edit-postingan input[name="media"]').val(data.media);
                        $('#media-preview').attr('src', '{{ asset('storage/') }}/' + data.media);
                        editModal.modal('show');
                    }
                });
            }

            $('#postingan-container').on('click', '.modal-edit-trigger-postingan', function() {
                var postId = $(this).data('id');
                openEditModal(postId);
            });

            $('#modal-save-button-postingan').on('click', function() {
                var form = $('#modal-edit-postingan-form');
                var formData = new FormData(form[0]);
                formData.append('_token', "{{ csrf_token() }}");

                var mediaFile = $('#mediaUploadButton')[0].files[0];
                if (mediaFile) {
                    formData.append('media', mediaFile);
                }

                // Get the edited content from Summernote
                var editedKonteks = $('#modal-edit-postingan textarea[name="konteks"]').summernote('code');
                formData.set('konteks', editedKonteks); // Set edited content

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response); // For debugging
                        if (response.success) {
                            editModal.modal('hide');
                            location.reload();
                        } else {
                            alert('Error! ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // For debugging
                        var err = JSON.parse(xhr.responseText);
                        alert('Error! ' + err.message);
                    }
                });
            });
            $('#konteks').summernote({
                disableLinkTarget: true
            });
        });
    </script>
@endpush
@push('customStyle')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.css" rel="stylesheet">
@endpush
