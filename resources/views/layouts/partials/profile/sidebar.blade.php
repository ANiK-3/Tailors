<!-- Sidebar -->
<main class="main">
  <aside class="sidebar">
    <nav class="nav">
      <ul>
        <li class="active"><a href="#">{{"My Profile"}}</a></li>
        <li><a href="#">{{"Measurement"}}</a></li>
        <li>
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <input type="submit" value="{{"Logout"}}">
          </form>
        </li>
      </ul>
    </nav>
  </aside>
</main>
