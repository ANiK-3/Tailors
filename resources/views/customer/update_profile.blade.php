@extends('layouts.app')

@section('title')
Update Profile
@endsection

@push('style')
<link rel="stylesheet" href="{{ mix('css/profile.css') }}">
@endpush

@section('content')
@includeIf('layouts.partials.navbar');

<div class="update_profile_container">
  {{-- <header>
    <div class="home">
      <a href="{{ route('home') }}" style="color: black;"><i class="fa-solid fa-house"></i></a>
</div>
</header> --}}

<form action="{{ route('customer.update_profile') }}" method="post" enctype="multipart/form-data">
  @csrf

  <div class="profile-picture">
    <img src="{{ $user->profile_picture ? asset('/storage/' . $user->profile_picture) : asset('/storage/uploads/' . 'default_user.jpg') }}" alt="Profile Picture">

    <span class="error-message">
      @error('profile_picture')
      {{$message}}
      @enderror
    </span>
  </div>

  <div class="profile-picture camera">
    <label for="file-path"> <i class="fa-solid fa-camera"></i></label>
    <input type="file" accept="image/*" name="profile_picture">
  </div>
  <br>

  <div>
    <label for="email">Email</label><br>
    <input type="text" id="email" name="email" value="{{ ($user->email) }}" disabled>
  </div>
  <br>

  <div>
    <label for="name">Name</label><br>
    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="@error('name') is-invalid @enderror" required>

    <br>
    <span class="error-message">
      @error('name')
      {{$message}}
      @enderror
    </span>
  </div>
  <br>

  <div>
    <label for="phone">Phone</label><br>
    <span class="phone-prefix">+880</span>
    <input type="text" id="phone" name="phone" class="@error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" placeholder="Enter your phone number" maxlength="10" required>

    <br>
    <span class="error-message">
      @error('phone')
      {{$message}}
      @enderror
    </span>
  </div>
  <br>

  <div>
    <label for="gender">Gender</label><br>

    <select id="gender" name="gender_id" class="phone-prefix @error('gender') is-invalid @enderror">

      @foreach($genders as $gender)
      <option value="{{ $gender->id }}" {{ $gender->id == $user->gender_id ? 'selected' : '' }}>{{ $gender->name }}</option>
      @endforeach
    </select>

    <br>
    <span class="error-message">
      @error('gender')
      {{$message}}
      @enderror
    </span>
  </div>
  <br>

  <div>
    <label for="address">Address</label><br>
    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" required>

    <br>
    <span class="error-message">
      @error('address')
      {{$message}}
      @enderror
    </span>
  </div>

  <input type="submit" value="Update" class="button">
</form>
<a href="{{ route('password.show_update') }}">
  <button class="button">Change Password</button>
</a>

@endsection

@push('script')
<script src="{{ mix('js/profile.js') }}"></script>
@endpush
