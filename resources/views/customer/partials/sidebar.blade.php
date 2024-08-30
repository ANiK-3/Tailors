<!-- Sidebar -->
<main class="main">
  <aside class="sidebar">
    <nav class="nav">
      <ul>
        <li class="active"><a href="{{ route('customer.profile') }}">{{"My Profile"}}</a></li>
        <li><a href=" {{ route('measurements.show',$user->id) }}">{{"Measurement"}}</a></li>
      </ul>
    </nav>
  </aside>
</main>
