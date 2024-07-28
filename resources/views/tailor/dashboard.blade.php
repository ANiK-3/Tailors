@extends('layouts.app')

@section('content')
@includeIf('layouts.partials.navbar')
<div style="margin-top: 100px; padding: 20px;">
  {{-- <h1>HELLO <mark>{{ Auth::user()->name }}</mark></h1> --}}
</div>

@endsection


@push('script')
<script src="{{ mix('js/navbar.js') }}"></script>
<script>
  // Listen for hire notification sent to tailor
  window.Echo.private("tailors.{{Auth::id()}}").listen(
    "SendHireNotificationEvent"
    , async (e) => {
      console.log(e);

      // store notification
      // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      // const userId = document
      //   .querySelector('meta[name="user-id"]')
      //   .getAttribute("content");

      const storeNotification = {
        user_id: `{{Auth::id()}}`
        , request_id: e.request_id
        , message: e.message
      }

      const store = await http.post('/notifications/store', storeNotification, `{{ csrf_token() }}`);

      addNotification(store);
    }
  );

</script>
@endpush
