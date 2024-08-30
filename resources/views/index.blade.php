@extends('layouts.app')

@section('title')
Home
@endsection

@push('style')
<link rel="stylesheet" href="{{ mix('css/home.css') }}">
@endpush

@section('content')

<div id="message"></div>
<div class="content">
  {{-- dynamic data --}}
</div>
<div id="loader">Loading...</div>

@includeIf('layouts.partials.footer')
@endsection

@push('script')
<script src="{{mix('js/home.js')}}"></script>
<script src="{{mix('js/navbar.js')}}"></script>
@endpush

