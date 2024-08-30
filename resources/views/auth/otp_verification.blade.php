@extends('layouts.app')

@section('title')
Verification
@endsection

@push('style')
<link rel="stylesheet" href={{mix('css/login.css')}}>
@endpush

@section('content')

<div>
  <div class="container-md mt-5">
    <form action="{{ route('otp.getLogin') }}" method="post">
      @csrf

      <div class="mb-3">
        <label for="otp" class="mb-3">OTP</label>
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

    <form method="POST" action="{{ route('otp.resend') }}" class="mt-3">
      @csrf
      <input type="hidden" name="phone" value="{{ session('otp_data') }}">
      <input type="hidden" name="contactMethod" value="{{ session('contactMethod') }}">

      <div class="form-group mt-3">
        <button type="submit" class="btn btn-secondary">
          Resend OTP
        </button>
      </div>
    </form>

  </div>
</div>

@endsection
