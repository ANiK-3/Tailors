<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tailors - @yield('title','website')</title>
  <link rel="stylesheet" href={{ mix('css/app.css') }}>
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
