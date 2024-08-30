@extends('layouts.app')

@section('content')
@includeIf('layouts.partials.navbar')
<div style="margin-top: 100px; padding: 20px;">
  <h1>HELLO <mark>Admin</mark></h1>
</div>
<div style="display: inline-block;width:200px; padding:10px; cursor: pointer;">
  <a href="{{ route('users.index') }}"><button class="button">Users</button></a>
  <div>
    <a href="{{ route('admin.manage_shop') }}"><button class="button">Manage Shop</button></a>
  </div>
  <div>
    <a href="{{ route('asset.index') }}"><button class="button">Assets</button></a>
  </div>

</div>
@endsection
