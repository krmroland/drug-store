<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <header class="header"></header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          @include('partials.sidebar')
        </div>
        <div class="col-md-10">
          <main>
            <router-view></router-view>
          </main>
        </div>
      </div>
   
    </div>

  </div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
