@extends('layouts.customer')
@section('title', 'Customer - Additional Laundry Services')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Additional Laundry Services</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-primary">
                    <div class="row">
                        @foreach ($service->additional_services as $additional_service)
                            <div class="col-sm-6 pb-4 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">{{ $additional_service->name }}</h5>
                                    <p class="card-text">{{ $additional_service->description }}</p>
                                    <a href="{{ route('customers.laundry-shops.garments', ['id' => $shop_admins->id, 'service_id' => $service->id]) }}" class="btn btn-primary">{{ $additional_service->price }} pesos</a>
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