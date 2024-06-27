@extends('layouts.app')

@section('content')
<div class="container mt-5">
  @if (auth()->check())
  <h1>Welcome to customer page {{ Auth::user()->name }}</h1>

  <a href="{{route('customer.profile',[Auth::user()->id])}}" class="btn btn-dark mt-3">Profile</a>
  <a href="{{route('logout')}}" class="btn btn-dark mt-3">Logout</a>
  @endif
</div>
@endsection
