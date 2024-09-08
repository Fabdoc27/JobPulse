<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Pulse | Verify Otp</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="container">
        <div class="row ">
            <div class="col-md-6 offset-md-3 card shadow-lg" style="margin: 100px auto">
                <div class="p-4">

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p class="text-center m-0">{{ session('error') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @elseif(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p class="text-center m-0">{{ session('success') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <h2 class="text-center">Verify Otp</h2>
                    <form action="{{ route('otpSubmit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ request()->query('email') }}">
                        <div class="col-lg-12 py-3">
                            <div class="form-floating border border-dark-subtle border-1 rounded mb-3">
                                <input type="number" name="otp" class="form-control" placeholder="Enter your otp ">
                                <label>Enter Otp Code</label>
                            </div>
                            @error('otp')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
