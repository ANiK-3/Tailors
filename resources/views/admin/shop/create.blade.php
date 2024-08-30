@extends('layouts.app')

@section('title')
Create Shop
@endsection

@push('style')
<style>
  .container {
    display: grid;
    place-items: center;
    height: 100vh;
  }

</style>
@endpush

@section('content')
<div class="container">
  <form action="{{ route('admin.create_shop') }}" method="post" enctype="multipart/form-data">
    @csrf

    {{-- <div class="profile-picture camera">
      <label for="file-path"> <i class="fa-solid fa-camera"></i></label>
      <input type="file" accept="image/*" name="profile_picture">
    </div>
    <br> --}}

    <div>
      <label for="tailor_id">Select Tailor</label><br>
      <select id="tailor_id" name="tailor_id" class=" form-select form-select" @error('tailor_id') is-invalid @enderror">

        <option value="" selected disabled>-- Select Tailor --</option>
        @foreach($tailors as $tailor)
        <option value="{{ $tailor->id }}">{{ $tailor->user->name }}</option>
        @endforeach
      </select>

      <span class="text-danger">
        @error('tailor_id')
        {{$message}}
        @enderror
      </span>
    </div>
    <br>

    <div>
      <label for="shop_image">Shop Image</label><br>
      <input type="file" accept="image/*" id="shop_image" name="shop_image" class="@error('shop_image') is-invalid @enderror">

      <br>
      <span class="error-message">
        @error('shop_image')
        {{$message}}
        @enderror
      </span>
    </div>
    <br>

    <div>
      <label for="shop_name">Shop Name</label><br>
      <input type="text" id="shop_name" name="shop_name" value="{{ old('shop_name') }}" class="@error('shop_name') is-invalid @enderror" required>

      <br>
      <span class="error-message">
        @error('shop_name')
        {{$message}}
        @enderror
      </span>
    </div>
    <br>

    <div>
      <label for="bio">Bio</label><br>
      <input type="text" id="bio" name="bio" value="{{ old('bio') }}" class="@error('bio') is-invalid @enderror" required>

      <br>
      <span class="error-message">
        @error('bio')
        {{$message}}
        @enderror
      </span>
    </div>
    <br>

    <input type="submit" value="Create">
  </form>
</div>
@endsection
