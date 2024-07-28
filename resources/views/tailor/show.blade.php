@extends('layouts.app')

@push('style')
<link rel="stylesheet" href="{{ mix('css/show_tailor.css') }}">
@endpush
@push('style')
<style>
  .button {
    margin-top: 10px;
    height: 30px;
    width: 100%;
    border-radius: 5px;
    background-color: #f08804;
    border: none;
    display: block;
    color: aliceblue;
    font-size: 20px;
    cursor: pointer;
  }

</style>
@endpush

@section('content')
@includeIf('layouts.partials.navbar')

<div class="content">
  <div class="profile">
    <div class="shopProfileImage">
      <img src="{{ $tailor->shop_image ? asset('/storage/' . $tailor->shop_image) : asset('/storage/images/' . 'default_tailor.jpg') }}" alt="Shop Image">
    </div>
    <div class="shopNamePlace">
      <div class="shopName">{{ $tailor->shop_name }}</div>
      <div class="shopPlace">{{ $tailor->user->address }}</div>

      @can('customer')
      <form action="{{ route('send_hire_notification') }}" method="post" id="hire-form">
        @csrf
        <input type="hidden" name="customer_id" value="{{ Auth::id() }}">
        <input type="hidden" name="tailor_id" value="{{ $tailor->user_id }}">
        <input type="submit" value="Hire" class="button" id="send-notification-btn">
      </form>
      @endcan

    </div>
  </div>
  <div class="details">
    <a href="">
      <div class="div1 cborder">
        Shirt
        <p>T 300</p>
      </div>
    </a>
    <a href="">
      <div class="div2 cborder">
        Pant
        <p>Tk 400</p>
      </div>
    </a>

    <a href="">
      <div class="div3 cborder">
        Three Piece
        <p>Tk 800</p>
      </div>
    </a>
    <a href="">
      <div class="div4 cborder">Cout Tk 5000</div>
    </a>
  </div>
</div>

@includeIf('layouts.partials.footer')
@endsection

@push('script')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('hire-form');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formAction = form.action;
    const formData = new FormData(form);

    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the form from submitting the traditional way
      sendHireNotification();
    });

    async function sendHireNotification() {
      const response = await http.post(formAction, formData, csrfToken);

      alert(response.message);
    }
  });

</script>
@endpush
