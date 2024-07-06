@extends('layouts.app')

@section('title')
OTP Login
@endsection

@section('content')
<div>
  <form action="{{ route('otp.getLogin') }}" method="post">
    @csrf

    <div>
      <label for="otp">OTP</label>
      <input type="text" name="otp" class="form-control @error('otp') is-invalid @enderror" value="{{ old('otp') }}" required placeholder="Enter OTP">

      <span class="text-danger">
        @error('otp')
        {{$message}}
        @enderror
      </span>
    </div>

    <div class="mb-3">
      <input type="submit" value="Submit" class="btn btn-primary">
    </div>

  </form>
</div>
@endsection
