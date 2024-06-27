<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tailors - @yield('title','website')</title>
  <link rel="stylesheet" href={{ mix('css/app.css') }}>
  @stack('style')
</head>
<body>

  @hasSection('content')
  @yield('content')
  @else
  <h2>Content Not Found</h2>
  @endif

  @stack('script')
</body>
</html>
