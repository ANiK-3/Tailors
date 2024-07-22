@extends('layouts.app')

@section('title')
Users
@endsection

@push('style')
<style>
  table {
    margin: 10px;
    padding: 10px;
    font-size: 1.5rem;
  }

  tbody tr:nth-of-type(even) {
    background-color: rgb(214, 200, 195);
  }

  a {
    text-decoration: none;
  }

  button {
    cursor: pointer;
  }

</style>
@endpush

@section('content')
<div>
  <a href="{{ route('user.create') }}"><button class="button">Create User</button></a>
</div>

<table>
  <thead>
    <tr>
      <th>SI</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key => $user)
    <tr>
      <td>{{$key}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->phone}}</td>
      <td><a href="{{ route('user.show',$user->id) }}"><button class="button">View</button></a></td>
      <td><a href="{{ route('user.edit',$user->id) }}"><button class="button">Update</button></a></td>
      <td>
        <form action="{{ route('user.destroy', $user->id) }}" method="POST" id="delete-form">
          @csrf
          @method('DELETE')
          <input type="submit" value="Delete" class="button">
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{-- for pagination --}}
{{-- {{$users->link()}} --}}
@endsection

{{-- @push('script')
<script>
  const deleteForm = document.querySelector("delete-form");

  deleteForm.addEventListener("click", async function(e) {

    e.preventDefault();
    const response = await fetch(deleteForm.action, {
      method: DELETE
      , headers: {
        'XSRF-TOKEN': "{{csrf_token()}}"
}
});

const data = await response.json();
if (!data) {
alert(data.error);
}
alert(data.status);
});

</script>
@endpush --}}
