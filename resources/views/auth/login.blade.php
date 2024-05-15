<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamstechnologies - Bootstrap Admin Template">
    <title>Login - CRM</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/logo.jpeg')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/material.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/css/line-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
</head>

<body class="account-page" id="bg" style="background-image: url('{{ asset('backend/login-bg.jpeg') }}'); background-repeat: no-repeat; background-size: cover;">

    <div class="main-wrapper">
        <div class="account-content">
            {{-- <a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a> --}}
            <div class="container">

                <div class="accoun-logo text-center mb-3">
                    <a href="{{route('index')}}" class="text-center">
                        <div class="logo-container" style="box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.938);">
                            <img src="{{ asset('backend/logo.png') }}" class="text-center" height="250px" width="300px" alt="CRM-TIZARA">
                        </div>
                    </a>
                </div>

                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Login</h3>
                        <p class="account-subtitle">Access to our dashboard</p>

                        <form method="POST" action="{{route('login.store')}}">
                            @csrf
                            @includeIf('errors.error')

                            <div class="input-block mb-4">
                                <label class="col-form-label">Email Address</label>
                                <input class="form-control @error('email') is-invalid border border-danger @enderror" type="email" value="admin@gmail.com" name="email">
                                @if ($errors->has('email'))
                                    <span class="error text-danger ms-5">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="input-block mb-4">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <label class="col-form-label">Password</label>
                                    </div>
                                    <div class="col-auto">
                                        <a class="text-muted" href="{{route('password.request')}}">
                                            Forgot password?
                                        </a>
                                    </div>
                                </div>
                                <div class="position-relative">
                                    <input class="form-control @error('password') is-invalid border border-danger @enderror" type="password" value="password" id="password" name="password">
                                    <span class="fa-solid fa-eye-slash" id="toggle-password"></span>
                                </div>
                            </div>
                            <div class="input-block mb-4 text-center">
                                <button class="btn btn-primary account-btn" type="submit">Login</button>
                            </div>
                            <div class="account-footer">
                                {{-- <p>Don't have an account yet? <a href="{{route('register')}}">Register</a></p> --}}
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('backend/assets/js/jquery-3.7.1.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('backend/assets/js/app.js')}}" type="text/javascript"></script>

</body>

<!-- Mirrored from smarthr.dreamstechnologies.com/html/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Mar 2024 20:03:26 GMT -->

</html>
