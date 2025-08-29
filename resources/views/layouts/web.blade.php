<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('images/favicon1.png') }}">
  
  <title>@yield('title', 'Home')</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>

  <!-- Vite -->
  @vite(['resources/css/web.css', 'resources/js/web.js'])

  <!-- Child Styles -->
  @stack('styles')
</head>
<body>
  <!-- Page Loader -->
  <div id="page-loader">
    <div class="spinner"></div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    @yield('content')
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
      window.logoLight = "{{ asset('images/logo1.png') }}";
      window.logoDark = "{{ asset('images/logo2.png') }}";
  </script>

  <!-- Child Scripts -->
  @stack('scripts')
</body>
</html>
