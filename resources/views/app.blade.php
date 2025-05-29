<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bfit Gudang Vue</title>
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @inertiaHead
  </head>

  <body>
    @inertia
    {{-- <div class="root"></div> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>

</html>
