@extends('layouts.app')

@section('title')
Manage Request
@endsection

@section('content')
<table>
  <thead>
    <tr>
      <th>SI</th>
      <th>Shop Name</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($tailors as $key => $tailor)
    <tr>
      <td>{{$key}}</td>
      <td>{{$tailor->shop_name}}</td>
      <td><a href="{{ route('tailor.show_info',$tailor->id) }}"><button class="button">View</button></a></td>
      <td>
        <form action="{{ route('admin.accept_tailor_request', $tailor->id) }}" method="POST">
          @csrf
          <button type="submit" class="button">Accept</button>
        </form>
      </td>
      <td>
        <form action="{{ route('admin.decline_tailor_request', $tailor->id) }}" method="POST">
          @csrf
          <button type="submit" class="button">Decline</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
