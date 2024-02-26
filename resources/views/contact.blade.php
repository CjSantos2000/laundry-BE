@extends('layouts.index')
@section('title', 'Contact')

@section('content')
<div class="pt-5 bg-washease">
    <div class="container">
      <div class="p-5 text-center rounded-3 mt-5">
          <h1 class="color-washease fw-bold hero-title position-relative display-3">Contact</h1>
          <hr class="featurette-divider" />
      </div>
    </div>
</div>
<div class="bg-washease marketing">
    <div class="container">
        <div class="row featurette">
        <div class="col-lg-6">
            <p class="lead text-dark mt-5 fw-bold">
            Contact Us
            </p>
            <p class="lead color-washease">
            Please use the form to message us. Because of the number of messages we receive everyday, please give us a few days to respond.
            </p>
            <p class="lead color-washease mt-3">
            <i class="fa-solid fa-phone" style="font-size: 18px"></i>
            Phone: (+63) 9612139536
            </p>
            <p class="lead color-washease">
            <i class="fa-solid fa-envelope" style="font-size: 18px"></i>
            Email: WashEase@gmail.com
            </p>
        </div>
        <div class="col-lg-6 justify-content-center d-flex">
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2 text-dark">Contact Us</h1>
            </div>
            <div class="modal-body p-5 pt-0">
                <form class="">
                <div class="row">
                    <div class="col-lg-6 col-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" id="floatingone" placeholder="Your Name">
                        <label for="floatingone">Your Name</label>
                    </div>
                    </div>
                    <div class="col-lg-6 col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" id="floatingtwo" placeholder="Your Email Address">
                        <label for="floatingtwo">Your Email Address</label>
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Message"></textarea>
                    </div>
                    </div>
                </div>
                <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Submit</button>
                </form>
            </div>
            </div>
        </div>
        <hr class="featurette-divider" />
        </div>
    </div>
</div>
@endsection