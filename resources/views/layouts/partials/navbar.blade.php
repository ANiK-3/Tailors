 <!-- Navigation-->
 <nav>
   <div class="navbar">
     <a href="{{ route('home') }}">
       <div class="nav-logo border">
         <div class="logo">
           <img src="{{ asset('/storage/images/' . 'tailorLogo5.jpg') }}" alt="Tailor">
         </div>
       </div>
     </a>

     <div class="nav-address border">
       <p class="add-first">Deliver to</p>
       <div class="add-icon">
         <i class="fa-solid fa-location-dot"></i>
         <p class="add-second">Sylhet</p>
       </div>
     </div>

     <div class="nav-search">
       <select name="" class="search-select">
         <option value="">All</option>
       </select>
       <input type="text" placeholder="Search" class="search-input">
       <div class="search-icon">
         <i class="fa-solid fa-magnifying-glass"></i>
       </div>
     </div>

     <div id="notification-container">
       <i class="fa fa-bell"></i>
       <span id="notification-counter">0</span>
       <ul id="notification-list"></ul>
     </div>

     <div class="home border"><a href="{{ route('home') }}">Home</a></div>
     <div class="home border"><a href="{{ route('about_us') }}">About Us</a></div>
     @auth
     @can('customer')
     <div class="home border"><a href="{{ route('customer.profile') }}">Profile</a></div>
     <div class="home border"><a href="#">Order Details</a></div>
     @elsecan('admin')
     <div class="home border"><a href="{{ route('admin.index') }}">Dashboard</a></div>
     @elsecan('tailor')
     <div class="home border"><a href="{{ route('tailor.dashboard') }}">Dashboard</a></div>
     @endcan
     <div class="home border">
       <form action="{{ route('logout') }}" method="post">
         @csrf
         <input type="submit" value="Logout" style="background-color: #f08804;">
       </form>
     </div>

     @else
     <div class="home border" style="background-color: #f08804;">
       <a href="{{route('login')}}">Login</a>
     </div>
     {{-- <a href="{{route('register')}}" class=" btn btn-primary">SignUp</a> --}}
     @endauth

   </div>
 </nav>

 <!-- <header>
        <div id="navbar">
            <a id="logo" href="">Tailor.com</a>
            <input id="searchinput" placeholder="Search" type="text">
            <button id="searchbtn" style="margin-right: 90px;">Search</button>
            <a href="#">Home</a>
            <a href="">Info</a>
            <a href="contactUs.html">Contact Us</a>
            <a href="">Profile</a>
        </div>
    </header> -->
