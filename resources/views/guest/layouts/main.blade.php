<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace Katering</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style_custom.css">
    {{-- <link href="/logo/logo_markat.ico" rel="icon" /> --}}
</head>

<body class="{{ !Request::is('dashboard') ? 'bg-dashboard' : '' }}">
    @if (!Request::is('home') && !Request::is('dashboard'))
        @include('guest.components.navbar')
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    @yield('isi')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</body>


</html>
