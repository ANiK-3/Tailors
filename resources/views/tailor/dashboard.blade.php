@extends('layouts.app')

@section('content')
@includeIf('layouts.partials.navbar')
<div style="margin-top: 100px; padding: 20px;">
  <h1>HELLO <mark>{{ Auth::user()->name }}</mark></h1>
</div>
@endsection
