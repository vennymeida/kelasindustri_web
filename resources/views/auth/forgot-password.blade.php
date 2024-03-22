<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} - Forgot Password</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="shortcut icon" href="assets/img/landing-page/logo.svg">
    <link rel="stylesheet" href="../assets/css/forgot-pass.css">

</head>

<body style="background: linear-gradient(to right, #f4f4f4 50%, #fff 50%);">
    <div id="app">
        <section class="section">
            <div class="container-fluid">
                <div class="row bg-forgot" style="background: linear-gradient(to right, #f4f4f4 50%, #fff 50%);">
                    <div class="col-md-6 d-flex flex-column justify-content-center my-5 p-forgot">
                        <div class="col-md-9 mx-auto">
                            <div>
                                <h1 class="font-weight-bold" style="color: black">Jangan Cemas!</h1>
                                <p style="width: 65%;">
                                    Kami akan mengirimkan tautan untuk atur ulang kata sandi Anda.
                                </p>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <div class="form-group mt-4">
                                        <label class="font-weight-bold">Email</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="Masukkan alamat email" style="border-radius: 15px;">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-primary btn-block"
                                            style="border-radius: 15px;">Kirim</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-2 text-muted text-center">
                                <p class="mt-2">Copyright &copy; 2024 Design By <a href="">JobKelasIndustri</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center my-5 img-forgot">
                        <a href="/" class="img-fluid text-center" style="width: 50%; height: auto;">
                            <img class="img-fluid" src="{{ asset('assets/img/landing-page/logo.svg') }}" alt=""
                                style="width: 65%; height: auto;">
                        </a>
                        <img class="img-fluid mt-5 icon-forgot" src="{{ asset('assets/img/landing-page/regis.svg') }}">
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>
