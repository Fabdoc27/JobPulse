<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Pulse | Reset Password</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .custom-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255,
                    255,
                    255,
                    0.7);
            z-index: 9999;
            display: none;
        }

        .loader-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .loader-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="customLoader" class="custom-loader">
            <div class="loader-overlay"></div>
            <div class="loader-content">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 offset-md-3 card shadow-lg" style="margin: 150px auto">
                <div class="p-4">
                    <h2 class="text-center">Reset Password</h2>
                    <form id="resetForm" action="{{ route('emailSubmit') }}" method="POST">
                        @csrf
                        <div class="col-lg-12 py-3">
                            <div class="form-floating border border-dark-subtle border-1 rounded mb-3">
                                <input type="email" name="email" class="form-control"
                                    placeholder="Enter your email ">
                                <label>Email Address</label>
                            </div>
                            @error('email')
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

    <script>
        function showCustomLoader() {
            document.getElementById('customLoader').style.display = 'block';
        }

        function hideCustomLoader() {
            document.getElementById('customLoader').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('resetForm').addEventListener('submit', function() {
                showCustomLoader();
            });
        });
    </script>
</body>

</html>
