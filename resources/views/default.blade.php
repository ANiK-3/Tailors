<div>
  <h1>Default page</h1>
  <hr>
  @if (auth()->check())
  <h1>HELLO {{ Auth::user()->name }}</h1>
  <a href="{{route('logout')}}" class=" btn btn-danger">Logout</a>
  @endif
</div>
