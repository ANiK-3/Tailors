@extends('layouts.app')

@section('title')
Home
@endsection

@push('style')
<link rel="stylesheet" href="{{ mix('css/home.css') }}">
@endpush

@section('content')

<nav>
  <div class="navbar">
    <a href="{{ route('home') }}">
      <div class="nav-logo border">
        <div class="logo">
          <img src="{{ asset('/storage/images/' . 'tailorLogo5.jpg') }}" alt="Tailor">
        </div>
      </div>
    </a>

    <div class="nav-address border">
      <p class="add-first">Deliver to</p>
      <div class="add-icon">
        <i class="fa-solid fa-location-dot"></i>
        <p class="add-second">Sylhet</p>
      </div>
    </div>

    <div class="nav-search">
      <select name="" class="search-select">
        <option value="">All</option>
        @foreach($tailorTypes as $tailorType)
        <option value="{{ $tailorType->name }}">{{ $tailorType->name }}</option>
        @endforeach

      </select>
      <input type="text" placeholder="Search" class="search-input">
      <div class="search-icon">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>
    </div>

    @auth
    <div id="notification-container">
      <i class="fa fa-bell"></i>
      <span id="notification-counter">0</span>
      <ul id="notification-list"></ul>
    </div>
    @endauth

    <div class="home border"><a href="{{ route('home') }}">Home</a></div>
    <div class="home border"><a href="{{ route('about_us') }}">About Us</a></div>
    @auth
    @can('customer')
    <div class="home border"><a href="{{ route('customer.profile') }}">Profile</a></div>
    <div class="home border"><a href="#">Order Details</a></div>
    @elsecan('admin')
    <div class="home border"><a href="{{ route('admin.index') }}">Dashboard</a></div>
    @elsecan('tailor')
    <div class="home border"><a href="{{ route('tailor.dashboard') }}">Dashboard</a></div>
    @endcan
    <div class="home border">
      <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" value="Logout" style="background-color: #f08804;">
      </form>
    </div>

    @else
    <div class="home border" style="background-color: #f08804;">
      <a href="{{route('login')}}">Login</a>
    </div>

    @endauth

  </div>
</nav>

<div id="message"></div>
<div class="content">
  {{-- dynamic data --}}
</div>

@includeIf('layouts.partials.footer')
@endsection

@push('script')
<script src="{{mix('js/home.js')}}"></script>
<script src="{{mix('js/navbar.js')}}"></script>
@endpush
