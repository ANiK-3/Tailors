@extends('layouts.app')

@section('content')
@includeIf('layouts.partials.navbar')
<div style="margin-top: 100px; padding: 20px;">
  <h1>HELLO <mark>Admin</mark></h1>
</div>
<div style="display: inline-block;width:200px; padding:10px; cursor: pointer;">
  <a href="{{ route('user.index') }}"><button class="button">Users</button></a>
</div>
@endsection
