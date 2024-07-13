@extends('layouts.app')

@section('title')
Profile
@endsection

@push('style')
<link rel="stylesheet" href="{{ mix('css/profile.css') }}">
@endpush

@section('content')

<div class="profile_container">
  <header>
    <div class="home">
      <a href="{{ route('home') }}" style="color: black;"><i class="fa-solid fa-house"></i></a>
    </div>
  </header>

  <div class="profile">
    <div class="profile-pic">
      <img src="{{ $user->profile_picture ? asset('/storage/' . $user->profile_picture) : asset('/storage/images/' . 'default.jpg') }}" alt="Profile Picture">
    </div>
    <div class="profile-name">{{ $user->name }}</div>
    <p>{{ $user->email }}</p>
    <a href="{{ route('customer.show_update_profile') }}"><button class="button">Update</button></a>

    <div class="button">
      <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </div>

  </div>
</div>

@endsection
