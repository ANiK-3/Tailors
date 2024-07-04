@extends('layouts.app')

@section('title')
Login
@endsection

@push('style')
<link rel="stylesheet" href={{mix('css/login.css')}}>
@endpush

@section('content')
<div class="container mt-3">
  <div>
    @if (session('status'))
    {{session('status')}}
    @endif
  </div>

  <h2 class="mb-4 text-center">Login</h2>
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
    <div class="mb-3">
      <div class="d-flex justify-content-between">
        <label for="password" class="form-label mr-1">Password: </label>
        <a href="#"> Forget Password? </a>
      </div>
      <input type=" password" id="password" name="password" required class="form-control @error('password') is-invalid @enderror">

      <span class="text-danger">
        @error('password')
        {{$message}}
        @enderror
      </span>
    </div>
    <div class="mb-4">
      <input type="checkbox" id="remember" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
      <label for="remember">Remember Me</label>
    </div>
    <div class="mb-3">
      <input type="submit" value="Login" class="btn btn-primary">
    </div>

    <div class="text-center mb-3"><a href="{{route('otp.login')}}">Login With OTP</a></div>

    <div class="text-center"><a href="{{route('auth.register')}}">Don't have an account?</a></div>
  </form>
</div>
@endsection

@push('script')
<script src="{{ mix('js/register.js') }}"></script>
@endpush
