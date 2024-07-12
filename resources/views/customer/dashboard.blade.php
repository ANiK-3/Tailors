@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($tailors as $tailor)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tailor->name }}</h5>
                            <p class="card-text">{{ $tailor->bio }}</p>
                            <p class="card-text"><strong>Specialty:</strong> {{ $tailor->specialty }}</p>
                            <a href="{{ route('tailors.show', $tailor->id) }}" class="btn btn-primary">View Profile</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
