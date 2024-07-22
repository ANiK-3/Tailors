@extends('layouts.app')

@push('style')
<style>
  .container {
    margin: 10px;
    padding: 20px;
    display: grid;
    place-items: center;
  }

  .profile-picture img {
    width: 150px;
    height: 150px;
  }

</style>
@endpush

@section('content')
<div class="container">

  <div class="profile-picture">
    <img src="{{ $user->profile_picture ? asset('/storage/' . $user->profile_picture) : asset('/storage/images/' . 'default.jpg') }}" alt="Profile Picture">
  </div>
  <div>
    Name : {{$user->name}}
  </div>
  <div>
    Email : {{$user->email}}
  </div>
  <div>
    Phone : {{$user->phone}}
  </div>
  <div>
    Gender: {{$user->gender->name}}
  </div>
  <div>
    Address : {{$user->address}}
  </div>
</div>
@endsection
