@extends('layouts.customer')
@section('title', 'Customer - Laundry Services Garments')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Laundry Services Garments</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-primary">
                    <div class="row">
                        @foreach ($shop_admins->garments as $garment)
                            <div class="col-sm-6 pb-4 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $garment->name }}</h5>
                                        <p class="card-text">{{ $garment->description }}</p>
                                        <a href="#" class="btn btn-primary">{{ $garment->price }} pesos</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>                    
        </div>
    </div>
@endsection