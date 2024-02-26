@extends('layouts.customer')
@section('title', 'Customer - Laundry Services Transactions')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Laundry Services Transactions</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-primary">
                    <div class="row">
                        @foreach ($shop_admins->transaction_modes as $transaction_mode)
                            <div class="col-sm-6 pb-4 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">{{ $transaction_mode->name }}</h5>
                                    <a href="{{ route('customers.laundry-shops.services', $shop_admins->id) }}" class="btn btn-primary w-100 mt-2">{{ $transaction_mode->price }} pesos</a>
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