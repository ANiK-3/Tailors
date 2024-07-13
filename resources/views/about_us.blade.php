@extends('layouts.app')

@section('title')
About US
@endsection

@push('style')
<link rel="stylesheet" href="{{ mix('css/about_us.css') }}">
@endpush

@section('content')
@includeIf('layouts.partials.navbar')
<div class="container">
  <div class="card">
    <div class="card-front">
      <p class="title">Kaucher Hamid</p>
      <p class="subtitle">Web Dev</p>
    </div>
    <div class="card-back">
      <p>I am a cse student and I try to build this website and design it my own</p>
    </div>
  </div>

  <div class="card">
    <div class="card-front">
      <p class="title">Debosree Sarkar</p>
      <p class="subtitle">Web Dev</p>
    </div>
    <div class="card-back">
      <p>I am a frontend developer, yay!!!!!.</p>
    </div>
  </div>

  <div class="card">
    <div class="card-front">
      <p class="title">Mahfuz Chowdhury</p>
      <p class="subtitle">Web Dev</p>
    </div>
    <div class="card-back">
      <p>As a backend developer, I am passionate about exploring new technologies and continually seeking innovative solutions.</p>

    </div>
  </div>
</div>
@includeIf('layouts.partials.footer')
@endsection
