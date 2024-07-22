@extends('layouts.app')

@section('title')
Change Password
@endsection

@section('content')
<form action="{{ route('password.update') }}" method="post" id="passwordUpdateForm">

  @csrf
  <div>
    <label for="current_password">Current Password</label>
    <input type="password" id="current_password" name="current_password" class="@error('current_password') is-invalid @enderror">

    <br>
    <span class="error-message">
      @error('current_password')
      {{$message}}
      @enderror
    </span>
  </div>
  <div>
    <label for="password">New Password</label>
    <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror">

    <br>
    <span class="error-message">
      @error('password')
      {{$message}}
      @enderror
    </span>
  </div>
  <div>
    <label for="password_confirmation">Confirm New Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror">

    <br>
    <span class="error-message">
      @error('password_confirmation')
      {{$message}}
      @enderror
    </span>

  </div>
  <input type="submit" value="Update Password">
</form>

@endsection

@push('script')
<script src="{{ mix('js/update_password.js') }}"></script>
@endpush
