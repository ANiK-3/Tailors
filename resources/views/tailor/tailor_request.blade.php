@extends('layouts.app')
@section('title')
Manage Requests
@endsection

@section('content')
<h1>Manage Hire Request</h1>

<p>Customer ID: {{ $request->customer_id }}</p>
<p>Request ID: {{ $request->id }}</p>

<form action="{{ route('request.accept', $request->id) }}" method="post">
  @csrf
  <button type="submit">Accept</button>
</form>

<form action="{{ route('request.decline', $request->id) }}" method="post">
  @csrf
  <button type="submit">Decline</button>
</form>

@endsection
