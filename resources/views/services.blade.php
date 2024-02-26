@extends('layouts.index')
@section('title', 'Services')

@section('content')
<div class="pt-5 bg-washease">
    <div class="container">
      <div class="p-5 text-center rounded-3 mt-5">
          <h1 class="text-dark fw-bold hero-title position-relative display-3"><span class="text-primary">Services We</span> Offer.</h1>
          <hr class="featurette-divider" />
      </div>
    </div>
</div>
<div class="bg-washease marketing">
    <div class="container pb-5">
        <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="card">
                    <img src="assets/images/service-5.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title text-dark fw-bolder text-center py-3">Wash Only</h3>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="card">
                    <img src="assets/images/service-4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title text-dark fw-bolder text-center py-3">Dry Only</h3>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="card">
                    <img src="assets/images/service-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title text-dark fw-bolder text-center py-3">Full Service (Wash, Dry, Fold)</h3>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="card">
                    <img src="assets/images/service-2.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title text-dark fw-bolder text-center py-3">Ironing</h3>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="card">
                    <img src="assets/images/service-3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title text-dark fw-bolder text-center py-3">Dry Cleaning</h3>
                    </div>
                    </div>
                </div>
            </div>
            <hr class="featurette-divider" />
        </div>
        </div>
    </div>
</div>
@endsection