@extends('layouts.app')

@section('title')
Manage Shop
@endsection

@section('content')
<div>
  <a href="{{ route('admin.show_create_shop') }}"><button class="button">Create Shop</button></a>
</div>
<div>
  <a href="{{ route('admin.show_manage_request') }}"><button class="button">Manage Request</button></a>
</div>
@endsection
