<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/dashmix/src/assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/dashmix/src/assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/dashmix/src/assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/dashmix/src/assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashmix/src/assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Dashmix framework -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/dashmix/src/assets/css/dashmix.min.css') }}">
    <!-- END Stylesheets -->
  </head>

  <body>
    <!-- Page Container -->
    <div id="page-container">
      <!-- Main Container -->
      <main id="main-container">
        <!-- Page Content -->
        @yield('content')
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <!-- Dashmix JS -->
    <script src="{{ asset('assets/dashmix/src/assets/js/dashmix.app.min.js') }}"></script>

    <!-- jQuery (required for jQuery Validation plugin) -->
    <script src="{{ asset('assets/dashmix/src/assets/js/lib/jquery.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/custom/js/custom.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <script>
      Dashmix.helpersOnLoad([
        'jq-select2'
      ])
    </script>
    @include('layouts.components.alert')
    @stack('javascript')
  </body>
</html>
