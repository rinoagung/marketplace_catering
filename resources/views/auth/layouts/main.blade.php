<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style_custom.css">
    <link href="/logo/logo_markat.ico" rel="icon" />


    <title>Admin Dashboard</title>

    <!-- FAVICONS ICON -->
    <link href="/admin/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/vendor/nouislider/nouislider.min.css">

    <!-- Style css -->
    <link href="/admin/style.css" rel="stylesheet">

</head>

<body>
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>

    <div id="main-wrapper">

        @include('auth.components.nav_header')
        @include('auth.components.header')
        @include('auth.components.sidebar')

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            @yield('isi')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('auth.components.footer')


    </div>

    <!-- vendors -->
    <script src="/admin/vendor/global/global.min.js"></script>
    <script src="/admin/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <!-- Dashboard scripts -->
    <script src="/admin/js/dashboard/dashboard-1.js"></script>

    <!-- Darkmode scripts -->
    <script src="/admin/js/custom.min.js"></script>
    <script src="/admin/js/dlabnav-init.js"></script>
    <script src="/admin/js/demo.js"></script>
    <script src="/admin/js/styleSwitcher.js"></script>

    <script src="/js/bootstrap.bundle.min.js"></script>




</body>

</html>
