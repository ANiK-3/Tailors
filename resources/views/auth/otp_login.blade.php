@extends('layouts.app')

@section('title')
Login with Phone
@endsection

@section('content')
<div class="container mt-3">
  <h2 class="mb-4 text-center">Login with Phone</h2>
  <form method="POST" action="{{ route('otp.generate') }}">
    @csrf

    <div class="mb-3">
      <div><label for="phone" class="form-label">Phone Number</label></div>
      <span class="phone-prefix">+880</span>
      <input type="text" id="phone" name="phone" class="phone-input @error('phone') is-invalid @enderror" placeholder="Enter your Phone Number" maxlength="10" required value="{{old('phone')}}">

      <span class="text-danger">
        @error('phone')
        {{$message}}
        @enderror
      </span>
    </div>

    <div class="mb-3">
      <input type="submit" value="Generate OTP" class="btn btn-primary">
    </div>

    @endsection
