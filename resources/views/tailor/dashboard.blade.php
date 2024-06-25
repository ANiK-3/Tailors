@extends('layouts.app')

@section('content')
<div class="container mt-5">
  @if (auth()->check())
  <h1>Welcome to tailor page {{ Auth::user()->name }}</h1>
  <a href="{{route('logout')}}" class="btn btn-dark mt-3">Logout</a>
  @endif
</div>
@endsection
