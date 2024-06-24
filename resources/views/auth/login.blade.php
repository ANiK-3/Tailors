<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>

  <div>
    @if (session('status'))
    {{session('status')}}
    @endif
  </div>

  <h2>Login</h2>
  <form method="POST" action="{{ route('auth.login') }}">
    @csrf

    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control @error('email') is-invalid @enderror">

      <span class="text-danger">
        @error('email')
        {{$message}}
        @enderror
      </span>
    </div>
    <div>
      <label for="password" class="form-label">Password:</label>
      <input type="password" id="password" name="password" required class="form-control @error('password') is-invalid @enderror">

      <span class="text-danger">
        @error('password')
        {{$message}}
        @enderror
      </span>
    </div>
    <div>
      <input type="checkbox" id="remember" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
      <label for="remember">Remember Me</label>
    </div>
    <div>
      <input type="submit" value="Login" class="btn btn-primary">
    </div>
  </form>
</body>
</html>
