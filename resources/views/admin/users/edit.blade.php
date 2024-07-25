@extends('layouts.app')

@push('style')
<link rel="stylesheet" href="{{ mix('css/profile.css') }}">
@endpush

@section('content')

<div class="update_profile_container">
  <form action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="profile-picture">
      <img src="{{ $user->profile_picture ? asset('/storage/' . $user->profile_picture) : asset('/storage/images/' . 'default.jpg') }}" alt="Profile Picture">
      <input type="file" name="profile_picture" accept="image/*">

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
      <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" required class="@error('address') is-invalid @enderror">

      <br>
      <span class="error-message">
        @error('address')
        {{$message}}
        @enderror
      </span>
    </div>

    <input type="submit" value="Update" class="button">
  </form>

</div>
@endsection
