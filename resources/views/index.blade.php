@extends('layouts.app')

@section('title')
Home
@endsection

@push('style')
<link rel="stylesheet" href={{asset('css/custom.css')}}>
@endpush

@section('content')
<div class="container mt-5">
  <h1>Home Page</h1>
  <div class="mt-5">
    @if (auth()->check())
    <h1>HELLO {{ Auth::user()->name }}</h1>
    <a href="{{route('logout')}}" class=" btn btn-danger">Logout</a>
    @else
    <a href="{{route('login')}}" class=" btn btn-primary">Login</a>
    <a href="{{route('register')}}" class=" btn btn-primary">SignUp</a>
    @endif
  </div>

</div>
@endsection

@push('script')
<script src="js/app.js"></script>
<script src="js/bootstrap.js"></script>
@endpush
