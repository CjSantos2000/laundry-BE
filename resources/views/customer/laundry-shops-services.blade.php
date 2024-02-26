@extends('layouts.customer')
@section('title', 'Customer - Laundry Services')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Laundry Services</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-primary">
                    <div class="row">
                        @foreach ($shop_admins->services as $services)
                          <div class="col-sm-6 pb-4 mb-sm-0">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">{{ $services->name }}</h5>
                                <p class="card-text">{{ $services->description }}</p>
                                <a href="{{ route('customers.laundry-shops.additional-services', ['id' => $shop_admins->id, 'service_id' => $services->id]) }}" class="btn btn-primary">{{ $services->price }} pesos</a>
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