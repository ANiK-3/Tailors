@extends('layouts.app')

@section('title')
Appointment
@endsection

@section('content')
<form method="POST" action="{{ route('appointment.create') }}">
  @csrf
  <input type="hidden" name="customer_id" value="{{ Auth::id() }}">
  <input type="hidden" name="tailor_id" value="{{ $tailor_id }}">
  <div>
    <label for="appointment_date">Appointment Date:</label>
    <input type="datetime-local" name="appointment_date" id="appointment_date" required>
  </div>
  <div>
    <label for="fabric_provided_by_customer">Will you provide the fabric?</label>
    <input type="checkbox" name="fabric_provided_by_customer" id="fabric_provided_by_customer" value="1">
  </div>
  <button type="submit">Schedule Appointment</button>
</form>
@endsection
{{--
@push('script')
<script>
  document.getElementById('fabric_provided_by_customer').addEventListener('change', function() {
    let pickupAddressContainer = document.getElementById('pickup_address_container');
    if (this.checked) {
      pickupAddressContainer.style.display = 'block';
    } else {
      pickupAddressContainer.style.display = 'none';
    }
  });

</script>
@endpush --}}
