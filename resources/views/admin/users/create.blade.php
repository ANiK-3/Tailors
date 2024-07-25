@extends('layouts.app')

@section('title')
Create User
@endsection

@push('style')
<link rel="stylesheet" href={{mix('css/register.css')}}>
@endpush

@section('content')
<div class="container">
  <h2 class="mt-4 text-center">Create User</h2>
  <form method="POST" action="{{ route('users.store') }}">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Name:</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control @error('name') is-invalid @enderror">

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
    <div class="mb-3">
      <label for="confirm_password" class="form-label">Confirm Password:</label>
      <input type="password" id="confirm_password" name="password_confirmation" required class="form-control @error('password_confirmation') is-invalid @enderror">

      <span class="text-danger">
        @error('password_confirmation')
        {{$message}}
        @enderror
      </span>
    </div>

    <div class="mb-3">
      <label for="role">Select Role:</label><br>
      <select id="role" name="role" class=" form-select form-select" @error('role') is-invalid @enderror">

        <option value="" selected disabled>-- Select Role --</option>
        @foreach($roles as $role)
        <option value="{{ $role->id }}">{{ $role->role }}</option>
        @endforeach
      </select>

      <span class="text-danger">
        @error('role')
        {{$message}}
        @enderror
      </span>
    </div>

    <div class="mb-3">
      <label for="gender">Select Gender:</label><br>
      <select id="gender" name="gender" class=" form-select form-select" @error('gender') is-invalid @enderror">

        <option value="" selected disabled>-- Select Gender --</option>
        @foreach($genders as $gender)
        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
        @endforeach
      </select>

      <span class="text-danger">
        @error('gender')
        {{$message}}
        @enderror
      </span>
    </div>

    <div id="tailor-fields">
      <label for="tailor_experience">Years of Experience:</label><br>
      <input type="number" id="tailor_experience" name="tailor_experience" min="0">
    </div>

    <div class="mb-3">
      <label for="phone" class="mb-1">Phone:</label><br>
      <span class="phone-prefix">+880</span>
      <input type="text" id="phone" name="phone" class="phone-input @error('phone') is-invalid @enderror" placeholder="Enter your Phone Number" maxlength="10" required value="{{old('phone')}}">

      <span class="text-danger">
        @error('phone')
        {{$message}}
        @enderror
      </span>
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Address:</label>
      <input type="text" id="address" name="address" value="{{ old('address') }}" required class="form-control @error('address') is-invalid @enderror">

      <span class="text-danger">
        @error('address')
        {{$message}}
        @enderror
      </span>
    </div>

    <div class="mt-3 tex">
      <input type="submit" value="Create" class="btn btn-primary">
    </div>

  </form>
</div>
@endsection

@push('script')
<script src="{{ mix('js/register.js') }}"></script>
@endpush
