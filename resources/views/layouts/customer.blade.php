<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} - @yield('title')</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" />
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    
</head>
<body>
    <div id="wrapper">
        <header id="header" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid p-0">
                <div id="header-logo">
                    <div class="d-flex justify-content-center align-items-center h-100 w-100">
                        <a href="{{ route('customers.dashboard.index') }}">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Mobvex" class="p-0"/>
                        </a>
                    </div>
                </div>
                <a href="#" id="button-menu"><i class="fa-solid fa-bars"></i></a>
                <a href="#" id="button-menu-close"><i class="fa-solid fa-xmark"></i></a>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ route('image', ['imageName' => auth()->guard('customer')->user()->image == '' ? 'hey' : auth()->guard('customer')->user()->image]) }}" alt="Image" title="User" class="round" height="50" width="50"/> {{ auth()->guard('customer')->user()->first_name }} {{ auth()->guard('customer')->user()->last_name }}
                        </a> 
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Cart</a></li>
                            <li><a class="dropdown-item" href="{{ route('customers.account.edit-profile') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('customers.account.change-password') }}">Change Password</a></li>
                            <li>
                                <form method="POST" action="{{ route('customers.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        <nav id="column-left">
            <ul id="menu">
                <li><a href="{{ route('customers.laundry-shops.index') }}"><i class="fa-solid fa-gauge"></i> Laundry Shops</a></li>
            </ul>
        </nav> 
 
      <ul id="menu">
        <li><a href="{{ route('customers.laundry-shops.index') }}"><i class="fa-solid fa-gauge"></i> Laundry Shops</a></li>
      </ul>
    </nav>
    <div id="content">
      @yield('content')
    </div>
    <footer>Copyright. &copy; 2023 All Rights Reserved.</footer>
  </div>
  <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/map.js') }}"></script>
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
  @yield('scripts')
</body>
</html>
