@extends('layouts.app')

@section('title')
Home
@endsection

@push('style')
<link rel="stylesheet" href="{{ mix('css/home.css') }}">
@endpush

@section('content')
@includeIf('layouts.partials.navbar')
<br>
<br>
<br>
<br>

<div class="content">
  @foreach($tailors as $tailor)
  <a href="{{ route('tailor.show', $tailor->id) }}">
    <div class="box">
    <div class="card" id="card" name="card">
      <div class="pic">
        <img src="{{ $tailor->shop_image ? asset('/storage/' . $tailor->shop_image) : asset('/storage/images/' . 'default_tailor.jpg') }}" alt="Shop Image">
      </div>
      <div  class="shopName"name="shopName" >{{ $tailor->shop_name }}</div>
      <p name="aboutShop" style="color: aliceblue;">{{ $tailor->bio }}</p>
    </div>
    </div>
  </a>
  @endforeach
  @includeIf('layouts.partials.footer')
</div>

<br>

@endsection