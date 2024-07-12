@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')
@includeIf('layouts.partials.navbar')
@includeIf('layouts.partials.header')
@includeIf('customer.partials.home_section')
@includeIf('layouts.partials.footer')
@endsection
