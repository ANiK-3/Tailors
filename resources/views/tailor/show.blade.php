@extends('layouts.app')

@push('style')
<link rel="stylesheet" href="{{ mix('css/show_tailor.css') }}">
@endpush
@push('style')
<style>
  .button {
    margin-top: 10px;
    height: 30px;
    width: 100%;
    border-radius: 5px;
    background-color: #f08804;
    border: none;
    display: block;
    color: aliceblue;
    font-size: 20px;
    cursor: pointer;
  }

</style>
@endpush

@section('content')
@includeIf('layouts.partials.navbar')

<div class="content">
  <div class="profile">
    <div class="shopProfileImage">
      <img src="{{ $tailor->shop_image ? asset('/storage/' . $tailor->shop_image) : asset('/storage/images/' . 'default_tailor.jpg') }}" alt="Shop Image">
    </div>
    <div class="shopNamePlace">
      <div class="shopName">{{ $tailor->shop_name }}</div>
      <div class="shopPlace">{{ $tailor->user->address }}</div>

      <a href="{{ route('hire.send',$tailor->user_id) }}">
        <button class="button">Hire</button>
      </a>
    </div>
  </div>
  <div class="details">
    <a href="">
      <div class="div1 cborder">
        Shirt
        <p>T 300</p>
      </div>
    </a>
    <a href="">
      <div class="div2 cborder">
        Pant
        <p>Tk 400</p>
      </div>
    </a>

    <a href="">
      <div class="div3 cborder">
        Three Piece
        <p>Tk 800</p>
      </div>
    </a>
    <a href="">
      <div class="div4 cborder">Cout Tk 5000</div>
    </a>
  </div>
</div>

@includeIf('layouts.partials.footer')
@endsection
