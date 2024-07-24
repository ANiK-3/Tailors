@extends('layouts.app')

@section('title')
Show Tailor
@endsection

@section('content')
<div class="container">

  <div class="profile-picture">
    Profile Picture :
    <img src="{{ $tailor->user->profile_picture ? asset('/storage/' . $tailor->user->profile_picture) : asset('/storage/images/' . 'default.jpg') }}" alt="Profile Picture">
  </div>
  <div>
    Name : {{$tailor->user->name}}
  </div>
  <div>
    Email : {{$tailor->user->email}}
  </div>
  <div>
    Phone : {{$tailor->user->phone}}
  </div>
  <div>
    Gender: {{$tailor->user->gender->name}}
  </div>
  <div>
    Address : {{$tailor->user->address}}
  </div>
  <div>
    Shop Image :
    <img src="{{ $tailor->shop_image ? asset('/storage/' . $tailor->shop_image) : asset('/storage/images/' . 'default_tailor.jpg') }}" alt="Profile Picture">
  </div>
  <div>
    Shop Name : {{$tailor->shop_name}}
  </div>
  <div>
    Bio : {{$tailor->bio}}
  </div>
  <div>
    Specialty : {{$tailor->specialty}}
  </div>
  <div>
    Experience : {{$tailor->experience}} years
  </div>

</div>

@endsection
