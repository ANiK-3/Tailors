@extends('layouts/app')

@section('title')
All Assets
@endsection

@push('style')
<style>
  .upload {
    margin: 100px;
  }

  .container {
    display: flex;
    gap: 10px;
    justify-content: center;
    align-items: center;
  }

  .card img {
    width: 250px;
    height: 250px;
  }

</style>
@endpush

@section('content')
<div class="upload">
  <a href="{{ route('asset.show_upload') }}"><button class="button">Upload Assets</button></a>
</div>

<div class="container">
  @foreach ($assets as $asset)
  <div class="card">
    <h2>{{ $asset->asset_type }}</h2>
    <img src="{{ asset('storage/' . $asset->file_path) }}" alt="{{ $asset->file_name }}" />
  </div>
  @endforeach
</div>
@endsection
