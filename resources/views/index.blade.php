@extends('layouts.app')

@section('title')
Home
@endsection

@push('style')
{{-- <link rel="stylesheet" href={{asset('css/custom.css')}}> --}}
@endpush

@section('content')
@include('layouts.partials.navbar')
@include('layouts.partials.header')
@include('layouts.partials.section')
@include('layouts.partials.footer')
@endsection

@push('script')
@endpush
