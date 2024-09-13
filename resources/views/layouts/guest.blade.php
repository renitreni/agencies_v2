<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="#"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('theme/soft-ui/assets/css/nucleo-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/soft-ui/assets/css/nucleo-svg.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link id="pagestyle" rel="stylesheet" href="{{ asset('theme/soft-ui/assets/css/soft-ui-dashboard.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    @livewireStyles
    @stack('header')
</head>

<body class="bg-gray-100 h-100 d-flex align-items-start flex-column" style="min-height: 100vh;">

<main class="container-fluid mb-auto">
    <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial -->

        <div class="flex-shrink-0">
            <div class="content">
                {{ $slot }}
            </div>
        </div>
    </div>
</main>

<!-- partial:../../partials/_footer.html -->
<footer class="footer py-3 bg-light w-100">
    <div class="container-fluid clearfix">
        <span class="float-right">
            <a href="#">Yaramay</a> &copy; {{ now()->year }}
        </span>
    </div>
</footer>
<!-- partial -->

@livewireScripts
<!--   Core JS Files   -->
<script src="{{ asset('theme/soft-ui/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('theme/soft-ui/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('theme/soft-ui/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('theme/soft-ui/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
@stack('scripts')
</body>

</html>
