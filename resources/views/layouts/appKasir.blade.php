<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} TechMarket</title>

    <link rel="stylesheet" href="{{ asset('vendors/typicons.font/font/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">

    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('images/Teck_Market.png') }}" />
</head>

<body>
    <div class="container-scroller">
        @include('partials.Users.headerKasir')
        <div class="container-fluid page-body-wrapper">
            @include('partials.Users.settings-panelKasir')
            @include('partials.Users.sidebarKasir')
            <div class="main-panel">
                @yield('content')
                @include('partials.Users.footerKasir')
            </div>
        </div>
    </div>
    <!-- base:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>

    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>

    <script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>

    {{-- <script src="js/dashboard.js"></script> --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>
