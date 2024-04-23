@extends('landing-page.app')
@section('title', 'JobKelasIndustri - List Pencarian User')
@section('main')
    <main class="bg-light">
        <section class="centered-section">
            <div class="bg-primary-section card col-md-10 py-4 card-profile3">
                <div class="profile-widget-description m-3" style="font-weight: bold; font-size: 24px; display: flex; align-items: center;">
                    <div class="flex-grow-1">
                        <div class="profile-widget-name" style="color:#6777ef;">List Pencarian</div>
                    </div>
                </div>
                <div class="col-md-12">
                    @if ($searchs->isEmpty())
                        <p style="font-size: 18px;">Tidak ada pengguna yang ditemukan.</p>
                    @else
                        @foreach ($searchs as $key => $search)
                            <div class="media mb-3 d-flex align-items-center">
                                <div class="mr-4">
                                    @if ($search->foto)
                                        <img class="rounded-circle" style="width: 100px; height: 100px;" src="{{ asset('storage/' . $search->foto) }}" alt="{{ $search->name }}">
                                    @else
                                        <img class="rounded-circle" style="width: 100px; height: 100px;" src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="Profile Image">
                                    @endif
                                </div>
                                <div class="form-group col-md-11">
                                    <div class="list-unstyled mb-0">
                                        <p class="text-primary font-weight-bold" style="font-size: 20px;">{{ $search->name }}</p>
                                        <p style="font-size: 14px;">
                                            <img class="img-fluid img-icon" style="width: 24px; height: 24px;" src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                            {{ $search->alamat }}
                                        </p>
                                        <p style="font-size: 14px;">
                                            <img class="img-fluid img-icon" style="width: 24px; height: 24px;" src="{{ asset('assets/img/landing-page/location pin.svg') }}">
                                            {{ $search->nama_institusi }}
                                        </p>
                                        <p>
                                            <a class="btn btn-primary px-3" href="{{ route('search.recruit', $search->id) }}" style="border-radius: 18px; font-size: 16px;">Lihat Profil</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </main>

    <script>
        const textarea = document.getElementById('autoSizeTextarea');

        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        textarea.style.height = (textarea.scrollHeight) + 'px';
    </script>
@endsection
