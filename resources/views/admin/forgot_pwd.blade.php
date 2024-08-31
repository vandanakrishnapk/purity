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

<body class="authentication-bg position-relative">
    <div class="account-pages p-sm-5  position-relative">
      
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">           
                <div class="card overflow-hidden">
                    <div class="card-header chead">
                        <div class="text-primary text-center">
                            <h4 class="text-white font-size-20 p-2">Reset Password</h4>
                            <a href="index" class="">
                            <img src="{{ asset('assets/images/teacher_7162968-removebg-preview.png')}}" height="50px" alt="logo" >
                            </a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="p-1">
                        @if (session('message'))
                        <div class="alert alert-success">
                         {{ session('message') }}
                        </div>
                        @endif
                            <div class="alert alert-primary mt-2" role="alert">
                                Enter your email and instructions will be sent to you!
                            </div>
                            <form class="mt-1" action="{{ route('submitForgetPasswordForm') }}" method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label class="form-label" for="useremail">Email</label>
                                    <input type="email" class="form-control" id="useremail" placeholder="Enter email" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="row mb-0">
                                    <div class="col-3"></div>
                                    <div class="col-4 text-end">
                                        <button class="btn btn-primary w-md waves-effect waves-light text-light mt-2" type="submit">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
    </div>
    
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


</body>

</html>