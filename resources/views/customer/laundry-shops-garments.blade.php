@extends('layouts.customer')

@section('title', 'Customer - Laundry Services Garments')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div><h2 class="title">Laundry Services Garments</h2></div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">  @foreach ($shop_admins->garments as $garment)
            <div class="col">
                <div class="card h-100 shadow-sm">  <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">{{ $garment->name }}</h5>
                            <p class="card-text mb-0">{{ $garment->price }} pesos</p>
                        </div>
                        <p class="card-text text-muted">{{ $garment->description }}</p>
                        <form method="POST" action="{{ route('customers.cart.add') }}">
                            @csrf
                            <div class="d-flex align-items-center mb-2">
                                <p class="card-text me-2">Qty:</p>
                                <input type="number" name="quantity" value="1" class="form-control form-control-sm" style="width: 50px;">
                                <p class="card-text ms-2">kg:</p>
                                <input type="number" name="weight" value="1" class="form-control form-control-sm" style="width: 50px;">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                               
                            </div>
                            <input type="hidden" name="name" value="{{ $garment->name }}">
                            <input type="hidden" name="garment_id" value="{{ $garment->id }}">
                            <input type="hidden" name="transaction_mode_id" value="{{ $transaction_mode_id}}">
                            <input type="hidden" name="shop_admin_id" value="{{ $machine_type_id['shop_admin_id'] }}">
                            <input type="hidden" name="service_id" value="{{ $service_id['id'] }}">
                            <input type="hidden" name="machine_id" value="{{ $machine_type_id['id'] }}">
                            <input type="hidden" name="additional_service_id" value="{{ $additional_service_id['id'] }}">
                        </form>
                        <a href="{{ route('customers.index') }}" class="btn btn-outline-primary btn-sm">Checkout</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
