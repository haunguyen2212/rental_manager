<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/loader.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
  @stack('styles')
</head>

<body>
  <div id="loader-wrapper">
    <div id="loader"></div>
  </div>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @yield('content')
  </div>
  <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <script src="{{ asset('js/admin/app.js') }}"></script>
  @stack('scripts')
</body>

</html>