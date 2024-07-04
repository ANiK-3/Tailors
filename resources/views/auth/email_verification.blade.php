<div>
  <div class="container mt-5">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{session('status')}}
    </div>
    @endif
  </div>

  <form action="{{ route('otp.getLogin') }}" method="post">
    @csrf

    <div>
      <label for="otp">OTP</label>
      <input type="text" name="otp" class="form-control @error('otp') is-invalid @enderror" value="{{ old('otp') }}" required placeholder="Enter OTP">

      <span class="text-danger">
        @error('otp')
        {{$message}}
        @enderror
      </span>
    </div>

    <div class="mb-3">
      <input type="submit" value="Submit" class="btn btn-primary">
    </div>

  </form>
</div>
