<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Bootstrap Admin Template">
    <title>@yield('title') - CRM</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/assets/img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/material.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/morris/morris.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
    @stack('css')

</head>
<body>

    <div class="main-wrapper">

        {{-- topbar section  --}}
        @includeIf('admin.layout.partials.topbar')

        {{-- sidebar section  --}}
        @includeIf('admin.layout.partials.sidebar')

        <div class="page-wrapper">
            <div class="content container-fluid pb-0">
                @yield('content')
            </div>
        </div>
    </div>
    {{-- sidebar section  --}}
    @includeIf('admin.layout.partials.settings')

    <script src="{{asset('backend/assets/js/jquery-3.7.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/app.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/plugins/raphael/raphael.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/chart.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/greedynav.js')}}" type="text/javascript"></script>

    <script src="{{asset('backend/assets/js/layout.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/js/theme-settings.js')}}" type="text/javascript"></script> 

    @stack('js')

    <script type="text/javascript">
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && (e.keyCode === 85)) {
                e.preventDefault();
                return false;
            }
        });
    </script>






</body>
</html>
