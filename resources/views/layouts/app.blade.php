<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Tailor - @yield('title','website')</title>
  <link rel="stylesheet" href={{ mix('css/app.css') }}>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @stack('style')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
</head>
<body>

  @hasSection('content')
  @yield('content')
  @else
  <h2>Content Not Found</h2>
  @endif

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
    toastr.options = {
      "closeButton": true
      , "newestOnTop": true
      , "progressBar": true
      , "preventDuplicates": true
      , "timeOut": "1000"
    , }
    @if(Session::has('success'))
    toastr.success("{{session('success')}}");
    @elseif(Session::has('error'))
    toastr.error("{{session('error')}}");
    @endif

  </script>
  <script src="{{mix('js/app.js')}}"></script>
  @stack('script')
</body>
</html>
