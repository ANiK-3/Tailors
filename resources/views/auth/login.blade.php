@extends('layouts.app')

@section('title')
Login
@endsection

@push('style')
<link rel="stylesheet" href={{mix('css/login.css')}}>
@endpush

@section('content')
<div class="container">
  <h2 class="mb-4 text-center">Login</h2>
  <form method="POST" action="{{ route('auth.login') }}">
    @csrf

    <div class="mb-3">
      <label for="email" class="email">Email:</label><br>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required class=" @error('email') is-invalid @enderror in"><br>

      <span class="">
        @error('email')
        {{$message}}
        @enderror
      </span>
    </div>
    <div class="">
      <div class="">
        <label for="password" class="">Password: </label><br>
        <!-- <a href="#"> Forget Password? </a> -->
      </div>
      <input type=" password" id="password" name="password" required class=" @error('password') is-invalid @enderror in">

      <span class="">
        @error('password')
        {{$message}}
        @enderror
      </span>
    </div>
    <div class=" remberMe">
      <input type="checkbox" id="remember" name="remember" class="checkbox" {{ old('remember') ? 'checked' : '' }}>
      <label for="remember">Remember Me</label>
    </div>
    <div class="">
      <input type="submit" value="Login" class="">
    </div>

    <div class=""><a href="{{route('otp.login')}}">Login With OTP</a></div>

    <div class=""><a href="{{route('auth.register')}}">Don't have an account?</a></div>
  </form>
</div>
@endsection

@push('script')
<script src="{{ mix('js/register.js') }}"></script>
@endpush
