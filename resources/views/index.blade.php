@extends('layouts.app')

@section('title')
Home
@endsection

@push('style')
<link rel="stylesheet" href="{{ mix('css/home.css') }}">
@endpush

@section('content')
@includeIf('layouts.partials.navbar')
<br>
<br>
<br>
<br>

<div class="content">
  @foreach($tailors as $tailor)
  <a href="{{ route('tailor.show', $tailor->id) }}">
    <div class="box">
      <div class="card" id="card" name="card">
        <div class="pic">
          <img src="{{ $tailor->shop_image ? asset('/storage/' . $tailor->shop_image) : asset('/storage/images/' . 'default_tailor.jpg') }}" alt="Shop Image">
        </div>
        <div class="shopName" name="shopName">{{ $tailor->shop_name }}</div>
        <p name="aboutShop" style="color: aliceblue;">{{ $tailor->bio }}</p>
      </div>
    </div>
  </a>
  @endforeach
  @includeIf('layouts.partials.footer')
</div>

<br>

@includeIf('layouts.partials.footer')

@endsection

@push('script')
{{-- <script src="{{mix('js/app.js')}}"></script>


@vite('resources/js/app.js')
<script>
  setTimeout(() => {
    window.Echo.private('users.1').listen('SendNotification', (e) => {
      console.log(e)
    });
  }, 200);

</script> --}}

{{-- <script>
  // Listen for request acceptance or decline notification sent to customer
  window.Echo.private(`customers.{{Auth::id()}}`)
.listen('RequestAcceptedEvent', (e) => {
alert(e.message);
window.location.href = `/fabric-details-form/${e.request_id}`;
})
.listen('RequestDeclinedEvent', (e) => {
alert(e.message);
// Implement further logic for declined request
});

</script> --}}

<script src="{{ mix('js/navbar.js') }}"></script>
<script>
  // Listen for hire notification sent to tailor
  window.Echo.private(`customers.{{Auth::id()}}`)
    .listen('RequestAcceptedEvent', async (e) => {

      console.log(e);
      // store notification
      const storeNotification = {
        user_id: `{{Auth::id()}}`
        , request_id: e.request_id
        , message: e.message
      }

      const store = await http.post('/notifications/store', storeNotification, `{{ csrf_token() }}`);

      addNotification(store);

    })
    .listen('RequestDeclinedEvent', async (e) => {
      console.log(e.message);
      alert(e.message);
      // Implement further logic for declined request
    });

</script>
@endpush
