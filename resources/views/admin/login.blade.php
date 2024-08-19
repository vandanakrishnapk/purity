<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Toster -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="authentication-bg position-relative" style="height: 100vh;">
    <div class="account-pages p-sm-5  position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-8">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <!-- <div class="auth-brand p-4 text-center">
                                        <a href="index.html" class="logo-light">
                                            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" height="28">
                                        </a>
                                    </div> -->
                                    <div class="p-4 my-auto text-center">
                                        <h4 class="fs-20">Sign In</h4>
                                        <p class="text-muted mb-4">Enter your email address and password to <br> access
                                            account.
                                        </p>
                             
                                        <!-- form -->
                                        <form class="text-start loginForm" id="loginForm">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email address</label>
                                                <input class="form-control" type="text" name="email" id="email"  placeholder="Enter your email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control mb-3" type="password"  name="password"  id="password" placeholder="Enter your password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                    <a href="{{ route('forgot.pwd') }}" class="text-muted float-end mb-3"><small>Forgot your password?</small></a>
                                            </div>
                                            <div class="mb-3">
                                               
                                            </div>
                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100 login-btn" type="submit"><i
                                                        class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log
                                                        In</span> </button>
                                            </div>

                               
                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="{{ asset('assets/images/login-bg.png') }}" alt="" class="img-fluid rounded h-100">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <!-- <p class="text-dark-emphasis">Don't have an account? <a href="auth-register.html"
                            class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Sign up</b></a>
                    </p> -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <!-- <span class="text-dark">
            <script>document.write(new Date().getFullYear())</script> © Techmin - Theme by Techzaa
        </span> -->
    </footer>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/lucide/umd/lucide.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Toastr CSS -->

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
     $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Serialize the form data

            $.ajax({
                url: `{{ url('/doLogin') }}`, // URL to send the request to
                type: 'POST',
                data: formData,
                dataType: "JSON",
                success: function(response) {
                    if (response.success) {
                        // Show success toastr message
                        toastr.success('Login successful!');
                        // Optionally, redirect or perform other actions
                        window.location.href = response.redirect_url; // Update based on your response structure
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // Laravel validation error status code
                        var errors = xhr.responseJSON.errors;
                        
                        // Clear previous errors
                        $('.text-danger').remove();

                        // Loop through each error and display it under the corresponding input field
                        $.each(errors, function(key, value) {
                            $('#' + key).after('<span class="text-danger">' + value[0] + '</span>');
                        });

                        // Show error toastr message for validation errors
                        toastr.error('Please fix the errors and try again.');
                    } else if (xhr.status === 401) { // Authentication failed status code
                        // Show specific toastr message for email or password mismatch
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        // Show general error toastr message
                        toastr.error('Login failed! Please check your credentials.');
                    }
                }
            });
        });
    });
</script>


</body>

</html>