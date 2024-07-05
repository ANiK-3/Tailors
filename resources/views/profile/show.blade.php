@extends('layouts.app')

@section('title')
Profile
@endsection

@push('style')
<link rel="stylesheet" href="{{ mix('css/profile.css') }}">
@endpush

@section('content')
@include('layouts.partials.navbar')
@include('layouts.partials.profile.sidebar')

<div class="container">
  <div class="container mt-5">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{session('status')}}
    </div>
    @endif
  </div>

  <div class="section">
    <div class="card text-center">
      <div class="card-header">
        Profile Details
      </div>
      <div class=" card-body">
        <div>
          <form action="{{ route('customer.update_profile',$user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="profile-picture">
              <div class=" container mt-5 text-center mb-3">
                <img src="{{ $user->profile_picture ? asset('/storage/' . $user->profile_picture) : asset('/storage/images/' . 'default.jpg') }}" class="rounded-circle img-fluid" alt="Profile Picture">

                <input type="file" name="profile_picture" accept="image/*">
              </div>

              @error('profile_picture')
              {{$message}}
              @enderror
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Name:</label>
              <input type="text" id="name" name="name" value="{{ $user->name }}" required class="form-control @error('name') is-invalid @enderror">

              <span class="text-danger">
                @error('name')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="phone" class="mb-1">Phone:</label><br>
              <span class="phone-prefix">+880</span>
              <input type="text" id="phone" name="phone" class="phone-input @error('phone') is-invalid @enderror" placeholder="Enter your Phone Number" maxlength="10" required value="{{$user->phone}}">

              <span class="text-danger">
                @error('phone')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="gender">Gender:</label><br>
              <select id="gender" name="gender_id" class=" form-select form-select" @error('gender') is-invalid @enderror">

                @foreach($genders as $gender)
                <option value="{{ $gender->id }}" {{ $gender->id == $user->gender_id ? 'selected' : '' }}>{{ $gender->name }}</option>
                @endforeach
              </select>

              <span class="text-danger">
                @error('gender')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Address:</label>
              <input type="text" id="address" name="address" value="{{ $user->address }}" required class="form-control @error('address') is-invalid @enderror">

              <span class="text-danger">
                @error('address')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mt-3">
              <input type="submit" value="Update" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
      {{-- form --}}
    </div>

  </div>

  @endsection

  @push('script')
  <script src="{{ mix('js/profile.js') }}"></script>
  @endpush
