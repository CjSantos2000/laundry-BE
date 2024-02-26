<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/css/bootstrap.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" />
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <title>Shop Admin - Subscription</title>
  </head>
  <body>
    <div id="wrapper">
      <header id="header" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid p-0">
            <div id="header-logo" class="seller-center-logo">
                <div
                    class="d-flex justify-content-center align-items-center h-100 w-100"
                >
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="p-0"/>
                </div>
            </div>
        </div>
      </header>
      <div id="content" class="login-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
              <div class="col-lg-7x col-sm-10 col-12 col-md-8 mt-5">
                <div id="login-container">
                  <h2>Register: <span>{{ $subscription->name }} </span><span style="font-size: 20px" class="text-secondary">({{ $subscription->price }} pesos)</span></h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  <form action="{{ route('shop_admins.process.register', $subscription->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                    <div class="input-group mb-3 mt-4">
                      <span class="input-group-text"
                          >Payment Screenshot: </span>
                      <input
                          type="file"
                          class="form-control"
                          name="screesnhot"
                      />
                    </div>
                    <div class="input-group mb-3 mt-4">
                      <span class="input-group-text"
                          ><i class="fa-solid fa-user"></i
                      ></span>
                      <input
                          type="text"
                          class="form-control"
                          placeholder="Shop name"
                          name="shop_name"
                      />
                    </div>
                    <div class="input-group mb-3 mt-4">
                        <span class="input-group-text"
                            ><i class="fa-solid fa-user"></i
                        ></span>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="First name"
                            name="first_name"
                        />
                    </div>
                    <div class="input-group mb-3 mt-4">
                        <span class="input-group-text"
                            ><i class="fa-solid fa-user"></i
                        ></span>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Last name"
                            name="last_name"
                        />
                    </div>
                    <div class="input-group mb-3 mt-4">
                        <span class="input-group-text"
                            ><i class="fa-solid fa-user"></i
                        ></span>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Address"
                            name="address"
                        />
                    </div>
                    <div class="input-group mb-3 mt-4">
                        <span class="input-group-text"
                            ><i class="fa-solid fa-user"></i
                        ></span>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Phone number"
                            name="phone_number"
                        />
                    </div>
                    <div class="input-group mb-3 mt-4">
                        <span class="input-group-text"
                        ><i class="fa-solid fa-user"></i
                        ></span>
                        <input
                        type="text"
                        class="form-control"
                        placeholder="Email"
                        name="email"
                        />
                    </div>
                    <div class="input-group mb-3 mt-4">
                        <span class="input-group-text"
                            ><i class="fa-solid fa-lock"></i
                        ></span>
                        <input
                            type="password"
                            class="form-control"
                            placeholder="Password"
                            name="password"
                        />
                    </div>
                    <div class="input-group mb-3 mt-4">
                        <span class="input-group-text"
                            ><i class="fa-solid fa-lock"></i
                        ></span>
                        <input
                            type="password"
                            class="form-control"
                            placeholder="Confirm Password"
                            name="password_confirmation"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                      Register
                    </button>
                  </form>
                  <a href="{{ route('shop_admins.login') }}" class="btn btn-success w-100 mt-2">
                    Already have an account?
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div style="background-color: red; width: 100px; height: 1000px"></div> -->
      <footer style="margin-left: 0">
        Wash Ease Laundry. &copy; 2023 All Rights Reserved
      </footer>
    </div>
    <script
      type="text/javascript"
      src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"
    ></script>
  </body>
</html>
