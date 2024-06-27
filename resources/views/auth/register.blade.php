@extends('layouts.app')

@section('title')
Register
@endsection

@push('style')
<link rel="stylesheet" href={{mix('css/register.css')}}>
@endpush

@section('content')
<div class="container">
  <h2 class="mt-4 text-center">Register</h2>
  <form method="POST" action="{{ route('auth.register') }}">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Name:</label>
      <input type="name" id="name" name="name" value="{{ old('name') }}" required class="form-control @error('name') is-invalid @enderror">

      <span class="text-danger">
        @error('name')
        {{$message}}
        @enderror
      </span>
    </div>
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
      <label for="password" class="form-label">Password:</label>
      <input type="password" id="password" name="password" required class="form-control @error('password') is-invalid @enderror">

      <span class="text-danger">
        @error('password')
        {{$message}}
        @enderror
      </span>
    </div>
    <div class="mb-4">
      <label for="confirm_password" class="form-label">Confirm Password:</label>
      <input type="password" id="confirm_password" name="password_confirmation" required class="form-control @error('password_confirmation') is-invalid @enderror">

      <span class="text-danger">
        @error('password_confirmation')
        {{$message}}
        @enderror
      </span>
    </div>

    <label for="role">Select Role:</label><br>
    <select id="role" name="role" required>
      <option value="" selected disabled>-- Select Role --</option>
      <option value="customer">Customer</option>
      <option value="tailor">Tailor</option>
    </select><br><br>

    <div id="tailor-fields">
      <label for="tailor_experience">Years of Experience:</label><br>
      <input type="number" id="tailor_experience" name="tailor_experience" min="0"><br><br>
    </div>

    <div id="customer-fields">
      <label for="body_measurement">Height:</label><br>
      <input type="text" id="customer_height" name="customer_height"><br><br>
    </div>

    <div class="mb-4 tex">
      <input type="submit" value="Register" class="btn btn-primary">
    </div>

    <div class="text-center"><a href="{{route('auth.login')}}">Already have an account?</a></div>
  </form>
</div>
@endsection

@push('script')
<script src="{{ mix('js/register.js') }}"></script>
@endpush
