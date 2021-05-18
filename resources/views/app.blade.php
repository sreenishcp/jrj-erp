<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="description" content="Dashboard">
    <meta name="keywords" content="Dashboard">
    <meta name="author" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="apple-touch-icon" href="{{asset('assets/icons/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/icons/favicon-32x32.png')}}">

    <link href="{{asset('assets/vendor/simplebar/dist/simplebar.min.css')}}" rel="stylesheet" type="text/css" media="all">

    <link href="{{asset('assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
</head>

<body class="bg-gray-100 sidebar-compact">

    <div id="app">
    </div>

    <!-- App JS -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendor/lodash/lodash.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendor/highcharts/highmaps.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendor/apexcharts/dist/apexcharts.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/theme-custom.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/custom.js')}}" type="text/javascript"></script>
</body>

<!-- analytics.html 06:56:21 GMT -->

</html>