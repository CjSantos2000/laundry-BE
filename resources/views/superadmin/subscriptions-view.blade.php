@extends('layouts.superadmin')
@section('title', 'Shop Admin - View')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-primary">
                    <p>Name: <span class="fw-semibold ms-3">{{ $subscription->name }}</span></p>
                    <p>Price: <span class="fw-semibold ms-3">{{ $subscription->price }}</span></p>
                </div>
            </div>                    
        </div>
    </div>
@endsection