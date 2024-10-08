<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Pulse | Candidate Registration</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <div class="row ">
            <div class="col-md-6 offset-md-3 card shadow-lg" style="margin: 150px auto">
                <div class="p-4">

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p class="text-center m-0">{{ session('error') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <h2 class="text-center">Candidate Registration</h2>
                    <form action="{{ route('candidate.store') }}" method="POST">
                        @csrf
                        <div class="col-lg-12 pt-3">
                            <div class="form-floating border border-dark-subtle border-1 rounded mb-3">
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                <label>Email Address</label>
                            </div>
                            @error('email')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                            <div class="form-floating border border-dark-subtle border-1 rounded mb-3">
                                <input type="password" name="password" class="form-control">
                                <label>Password</label>
                            </div>
                            @error('password')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                            <div class="form-floating border border-dark-subtle border-1 rounded mb-3">
                                <input type="password" name="password_confirmation"
                                    class="form-control
                                    @error('email')
                                    border border-danger
                                    @enderror">
                                <label>Confirm Password</label>
                            </div>
                            @error('password')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center align-items-center gap-3">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">Submit</button>
                            </div>
                            <div>
                                <p class="text-center my-3"> Already an account
                                    <a href="{{ route('candidate.login') }}">Login</a>
                                </p>
                            </div>
                        </div>
                    </form>
                    <div class="row justify-content-center mt-4 text-center">
                        <div class="col-md-6">
                            <a href="{{ route('company.register') }}" class="btn btn-primary d-inline-block">Register
                                As
                                Company</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
