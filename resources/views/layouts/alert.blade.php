@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade" id="success-alert">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <p>{{ $message }}</p>
        </div>
    </div>
@endif

@if ($error = Session::get('error'))
    <div class="alert alert-danger alert-dismissible show fade" id="error-alert">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <p>{{ $error }}</p>
        </div>
    </div>
@endif

@push('customScript')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#success-alert").fadeOut('slow');
            }, 5000);

            setTimeout(function() {
                $("#error-alert").fadeOut('slow');
            }, 5000);
        });
    </script>
@endpush
