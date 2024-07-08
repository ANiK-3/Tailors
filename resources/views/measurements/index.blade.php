@extends('layouts.app')

@section('title')
Measurement
@endsection

@push('style')
<link rel="stylesheet" href="{{ mix('css/profile.css') }}">
@endpush

@section('content')
@includeIf('layouts.partials.navbar')
@includeIf('customer.partials.sidebar')

<div class="container">
  <div class="section">
    <div class="card text-center">
      <div class="card-header">
        @if (Gate::any(['tailor','admin']))
        <h4>Measurements for {{ $user->name }}</h4>
        @else
        Measurements Details
        @endif
      </div>

      <div class="card-body">
        <form action="{{ route('measurements.store', $user->id) }}" method="POST">
          @csrf
          <div class="form-group">

            <div class="mb-3">
              <label for="neck" class="form-label">Neck</label>
              <input type="number" id="neck" name="neck" value="{{ $measurements->neck ?? '' }}" class="form-control @error('neck') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('address')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="chest" class="form-label">Chest</label>
              <input type="number" id="chest" name="chest" value="{{ $measurements->chest ?? '' }}" class="form-control @error('chest') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('chest')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="women">
              <div class="mb-3">
                <label for="bust" class="form-label">Bust (Women)</label>
                <input type="number" id="bust" name="bust" value="{{ $measurements->bust ?? '' }}" class="form-control @error('bust') is-invalid @enderror" step="0.01" min="0">

                <span class="text-danger">
                  @error('bust')
                  {{$message}}
                  @enderror
                </span>
              </div>

              <div class="mb-3">
                <label for="under_bust" class="form-label">Under Bust (Women)</label>
                <input type="number" id="under_bust" name="under_bust" value="{{ $measurements->under_bust ?? '' }}" class="form-control @error('under_bust') is-invalid @enderror" step="0.01" min="0">

                <span class="text-danger">
                  @error('under_bust')
                  {{$message}}
                  @enderror
                </span>
              </div>
            </div>

            <div class="mb-3">
              <label for="waist_shirt" class="form-label">Waist (Shirt)</label>
              <input type="number" id="waist_shirt" name="waist_shirt" value="{{ $measurements->waist_shirt ?? '' }}" class="form-control @error('waist_shirt') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('waist_shirt')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="waist_pant" class="form-label">Waist (Pant)</label>
              <input type="number" id="waist_pant" name="waist_pant" value="{{ $measurements->waist_pant ?? '' }}" class="form-control @error('waist_pant') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('waist_pant')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="shoulder" class="form-label">Shoulder</label>
              <input type="number" id="shoulder" name="shoulder" value="{{ $measurements->shoulder ?? '' }}" class="form-control @error('shoulder') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('shoulder')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="sleeve_length" class="form-label">Sleeve Length</label>
              <input type="number" id="sleeve_length" name="sleeve_length" value="{{ $measurements->sleeve_length ?? '' }}" class="form-control @error('sleeve_length') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('sleeve_length')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="bicep" class="form-label">Bicep</label>
              <input type="number" id="bicep" name="bicep" value="{{ $measurements->bicep ?? '' }}" class="form-control @error('bicep') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('bicep')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="wrist" class="form-label">Wrist</label>
              <input type="number" id="wrist" name="wrist" value="{{ $measurements->wrist ?? '' }}" class="form-control @error('wrist') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('wrist')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="hips" class="form-label">Hips</label>
              <input type="number" id="hips" name="hips" value="{{ $measurements->hips ?? '' }}" class="form-control @error('hips') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('hips')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="thigh" class="form-label">Thigh</label>
              <input type="number" id="thigh" name="thigh" value="{{ $measurements->thigh ?? '' }}" class="form-control @error('thigh') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('thigh')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="knee" class="form-label">Knee</label>
              <input type="number" id="knee" name="knee" value="{{ $measurements->knee ?? '' }}" class="form-control @error('knee') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('knee')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="calf" class="form-label">Calf</label>
              <input type="number" id="calf" name="calf" value="{{ $measurements->calf ?? '' }}" class="form-control @error('calf') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('calf')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="inseam" class="form-label">Inseam</label>
              <input type="number" id="inseam" name="inseam" value="{{ $measurements->inseam ?? '' }}" class="form-control @error('inseam') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('inseam')
                {{$message}}
                @enderror
              </span>
            </div>

            <div class="mb-3">
              <label for="outseam" class="form-label">Outseam</label>
              <input type="number" id="outseam" name="outseam" value="{{ $measurements->outseam ?? '' }}" class="form-control @error('outseam') is-invalid @enderror" step="0.01" min="0">

              <span class="text-danger">
                @error('outseam')
                {{$message}}
                @enderror
              </span>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
