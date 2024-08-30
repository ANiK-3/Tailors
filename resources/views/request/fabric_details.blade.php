@extends('layouts.app')

@section('title')
Fabric details
@endsection

@section('content')
<form method="POST">
  @csrf
  <input type="hidden" name="customer_id" value="{{ Auth::id() }}">
  <input type="hidden" name="tailor_id" value="">
  <div>
    <label for="appointment_date">Appointment Date:</label>
    <input type="datetime-local" name="appointment_date" id="appointment_date" required>
  </div>
  <div>
    <label for="fabric_provided_by_customer">Will you provide the fabric?</label>
    <input type="checkbox" name="fabric_provided_by_customer" id="fabric_provided_by_customer" value="1">
  </div>
  <button type="submit">Send</button>
</form>
@endsection
