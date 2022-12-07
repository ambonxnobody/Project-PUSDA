<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <!-- CSRF Token -->
         <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
          <!-- Favicon -->
         <link rel="shortcut icon" href="{{asset('/assets/images/Logo.png')}}">
		<!-- App css -->
		<link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{asset('/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="{{asset('/assets/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="{{asset('/assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		<!-- icons -->
		<link href="{{asset('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading bg-dark authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">

                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="/" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('/assets/images/Logo.png')}}" alt="logos" height="100">
                                            </span>
                                        </a>

                                        <a href="/" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('/assets/images/Logo.png')}}" alt="logos" height="100">
                                            </span>
                                        </a>
                                    </div>
                                    <h3>Welcome back</h3>
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password</p>
                                </div>

                                <form  action="{{ route('login') }}" method="POST" autocomplete="on">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email</label>
                                        <input  type="email" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter your Email" name="email" value="{{ old('email') }}"  required="" autocomplete="on" >
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Enter your Password" name="password" required="">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                             @enderror
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-warning btn-block" type="submit"> Login </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
    </body>
    <!-- Vendor js -->
    <script src="{{asset('/assets/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('/assets/js/app.min.js')}}"></script>
</html>
