@extends('layouts/app')

@section('title')
    Upload Assets
@endsection

@push('style')
<style>
    form{
        border: 1px solid black;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100dvh;
    }
</style>
@endpush

@section('content')

<form action="{{ route('asset.upload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="asset" />
    <input type="text" name="asset_type" placeholder="logo, background,..." />
    <input type="submit" value="Upload" />
</form>

@endsection
