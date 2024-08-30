@extends('layouts.app')
@section('title')
Manage Requests
@endsection

@section('content')

<p>Name: {{ $customer->name }}</p>
<p>Address: {{ $customer->address }}</p>

<form action="{{ route('request.accept', $request->id) }}" method="post" id="accept-form">
  @csrf
  <button type="submit">Accept</button>
</form>

<form action="{{ route('request.decline', $request->id) }}" method="post" id="decline-form">
  @csrf
  <button type="submit">Decline</button>
</form>

@endsection

@push('script')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const acceptForm = document.getElementById('accept-form');
    const declineForm = document.getElementById('decline-form');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // const formAction = form.action;
    const acceptFormData = new FormData(acceptForm);
    const declineFormData = new FormData(declineForm);

    acceptForm.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the form from submitting the traditional way
      sendAcceptNotification();
    });
    declineForm.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the form from submitting the traditional way
      sendDeclineNotification();
    });

    async function sendAcceptNotification() {
      const response = await http.post(acceptForm.action, acceptFormData, csrfToken);
      alert(response.message);
    }
    async function sendDeclineNotification() {
      const response = await http.post(declineForm.action, declineFormData, csrfToken);
      alert(response.message);
    }
  });

</script>
@endpush
