@extends('layouts.app')
@section('content')
@includeIf('layouts.partials.navbar')
<div class="container vh-100">
  <div class="row">
    <div class="col">
      <div class="card">
        <img src="{{ $tailor->shop_image ? asset('/storage/' . $tailor->shop_image) : asset('/storage/images/' . 'default_tailor.jpeg') }}" alt="Card Shop Image" style="width: 200px">

        <div class="card-body">
          <h5 class="card-title">{{ $tailor->shop_name }}</h5>
          <p class="card-text">{{ $tailor->bio }}</p>
          <p class="card-text"><strong>Specialty:</strong> {{ $tailor->specialty }}</p>
          <p class="card-text"><strong>Phone:</strong> {{ $tailor->user->phone }}</p>
          <p class="card-text"><strong>Address:</strong> {{ $tailor->user->address }}</p>
          @can('customer')
          <button>
            <a href="{{route('appointment.show',$tailor->id)}}">Hire</a>
          </button>
          @endcan
        </div>
      </div>
    </div>
  </div>
</div>
@includeIf('layouts.partials.footer')
@endsection
