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
    <title>Register - CRM</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="container">

                <div class="account-logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('backend/assets/img/logo2.png') }}"
                            alt="Dreamguy's Technologies"></a>
                </div>

                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Register</h3>
                        <p class="account-subtitle">Access to Your dashboard</p>

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            @php
                                                toastr()->error($error);
                                            @endphp
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="input-block mb-4">
                                <label class="col-form-label">Full Name<span class="mandatory">*</span></label>
                                <input class="form-control @error('name') is-invalid border border-danger @enderror"
                                    type="text" name="name" required>
                                @if ($errors->has('name'))
                                    <span class="error text-danger ms-5">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Email<span class="mandatory">*</span></label>
                                <input class="form-control @error('email') is-invalid border border-danger @enderror"
                                    type="email" name="email" required>
                                @if ($errors->has('email'))
                                    <span class="error text-danger ms-5">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Password<span class="mandatory">*</span></label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid border border-danger @enderror"
                                    required>
                                @if ($errors->has('password'))
                                    <span class="error text-danger ms-5">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="input-block mb-4">
                                <label class="col-form-label">Repeat Password<span class="mandatory">*</span></label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid border border-danger @enderror"
                                    name="password_confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                    <span
                                        class="error text-danger ms-5">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                            <div class="input-block mb-4 text-center">
                                <button class="btn btn-primary account-btn" type="submit">Register</button>
                            </div>
                            <div class="account-footer">
                                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/assets/js/jquery-3.7.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}" type="text/javascript"></script>

</body>

</html>
