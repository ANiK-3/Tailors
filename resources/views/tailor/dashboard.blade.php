@extends('layouts.app')

@section('content')
@includeIf('layouts.partials.navbar')
<div style="margin-top: 100px; padding: 20px;">
  <h1>HELLO <mark>{{ Auth::user()->name }}</mark></h1>
</div>

@endsection



@push('script')
<script src="{{ mix('js/navbar.js') }}"></script>
<script>
  // Listen for hire notification sent to tailor
  window.Echo.private("tailors.{{Auth::id()}}").listen(
    "SendHireNotificationEvent"
    , (e) => {
      console.log(e.message);
      window.addNotification(e.message);
    }
  );

</script>
@endpush
