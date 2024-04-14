<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/carousel.css') }}" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg shadow" id="navbar">
      <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">WASH EASE LAUNDRY</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarTogglerDemo02"
          aria-controls="navbarTogglerDemo02"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
            <li class="nav-item">
              <a class="nav-link fw-semibold text-dark" href="{{ route('index') }}">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link fw-semibold text-dark" href="{{ route('services') }}">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-semibold text-dark" href="{{ route('contact') }}">Contact</a>
            </li>
          </ul>
          <div class="d-flex">
            <div class="dropdown">
              <a  href="{{ route('customers.login') }}">
               <i class="fa fa-user-circle" style="font-size: 40px;" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </nav>
    @yield('content')
    <footer class="pt-5 bg-washease-2">
        <div class="container pb-5">
        <div class="row">
          <div class="col-12 col-md-5 mb-3">
            <h2 class="fw-bold text-dark mb-5">Wash Ease Laundry</h2>
            <ul class="nav flex-column">
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 fw-bold"
                  >Laundry & dry cleaning picked up & delivered to your door</a
                >
              </li>
            </ul>
          </div>
          <div class="col-12 col-md-2 mb-3">
            <h2 class="fw-bold text-dark mb-5">Company</h2>
            <ul class="nav flex-column">
              <li class="nav-item mb-2">
                <a href="{{ route('index') }}" class="nav-link p-0 fw-bold"
                  >Home</a
                >
              </li>
              <li class="nav-item mb-2">
                <a href="{{ route('services') }}" class="nav-link p-0 fw-bold"
                  >Services</a
                >
              </li>
              <li class="nav-item mb-2">
                <a href="{{ route('contact') }}" class="nav-link p-0 fw-bold"
                  >Contact</a
                >
              </li>
            </ul>
          </div>
          <div class="col-6 col-md-2 mb-3">
            <h2 class="fw-bold text-dark mb-5">Support</h2>
            <ul class="nav flex-column">
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 fw-bold">FAQs</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 fw-bold">Privacy</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 fw-bold">Help</a>
              </li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-3">
            <h2 class="fw-bold text-dark mb-5">Contact Us</h2>
            <ul class="nav flex-column">
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 fw-bold">E. WashEase@gmail.com</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 fw-bold">A. 35 2nd St. Brgy.Katuparan Taguig City, Philippines</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 fw-bold">P. (+63) 9612139536</a>
              </li>
            </ul>
          </div>
          
        </div>
      </div>
        <div class="bg-washease">
          <div
          class="container d-flex flex-column flex-sm-row justify-content-between py-4 border-top"
        >
          <p class="color-washease fw-semibold">Copyright © 2024 Wash Ease</p>
          <ul class="list-unstyled d-flex">
            <li class="ms-3">
              <a class="link-body-emphasis" href="#"
                ><i class="fa-brands fa-facebook color-washease" style="font-size: 30px"></i
              ></a>
            </li>
            <li class="ms-3">
              <a class="link-body-emphasis" href="#"
                ><i class="fa-brands fa-instagram color-washease" style="font-size: 30px"></i
              ></a>
            </li>
            <li class="ms-3">
              <a class="link-body-emphasis" href="#"
                ><i class="fa-brands fa-twitter color-washease" style="font-size: 30px"></i
              ></a>
            </li>
          </ul>
          </div>
        </div>
      </footer>
      <button onclick="scrollToTop()" id="scrollToTopBtn" title="Scroll to Top" class="rounded-circle">
        <i class="fa-solid fa-arrow-up" style="font-size: 20px;"></i>
      </button>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>
