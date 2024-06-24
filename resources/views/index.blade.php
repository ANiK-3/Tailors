<div>
  @if (auth()->check())
  <h1>HELLO {{ Auth::user()->name }}</h1>
  <a href="{{route('logout')}}" class=" btn btn-danger">Logout</a>
  @else
  <a href="{{route('login')}}" class=" btn btn-primary">Login</a>
  <a href="{{route('register')}}" class=" btn btn-primary">SignUp</a>
  <h1>Hello World!</h1>
  @endif

</div>
