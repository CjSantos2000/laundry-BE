<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" />
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <title>@yield('title')</title>
</head>
<body>
    <div id="wrapper">
        <header id="header" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid p-0">
                <div id="header-logo">
                    <div class="d-flex justify-content-center align-items-center h-100 w-100">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Mobvex" class="p-0"/>
                    </div>
                </div>
                <a href="#" id="button-menu"><i class="fa-solid fa-bars"></i></a>
                <a href="#" id="button-menu-close"><i class="fa-solid fa-xmark"></i></a>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ route('image', ['imageName' => auth()->guard('superadmin')->user()->image == '' ? 'hey' : auth()->guard('superadmin')->user()->image]) }}" alt="Image" title="User" class="round" height="50" width="50"/> {{ auth()->guard('superadmin')->user()->first_name }} {{ auth()->guard('superadmin')->user()->last_name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('super_admins.account.edit-profile') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('super_admins.account.change-password') }}">Change Password</a></li>
                            <li>
                                <form method="POST" action="{{ route('super_admins.logout') }}">
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
                <li><a href="{{ route('super_admins.dashboard.index') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li><a href="{{ route('super_admins.customers.index') }}"><i class="fa-solid fa-users"></i> Customers</a></li>
                <li><a href="{{ route('super_admins.staffs.index') }}"><i class="fa-solid fa-users"></i> Staffs</a></li>
                <li><a href="{{ route('super_admins.riders.index') }}"><i class="fa-solid fa-motorcycle"></i> Riders</a></li>
                <li><a href="{{ route('super_admins.shop-admins.index') }}"><i class="fa-solid fa-users"></i> Shop Admins</a></li>
                <li><a href="{{ route('super_admins.super-admins.index') }}"><i class="fa-solid fa-users"></i> Super Admins</a></li>
                <li><a href="{{ route('super_admins.subscriptions.index') }}"><i class="fa-solid fa-money-bill"></i> Subscriptions</a></li>
            </ul>
        </nav>
        <div id="content">
            @yield('content')
        </div>
        <footer>Copyright. &copy; 2023 All Rights Reserved.</footer>
    </div>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
