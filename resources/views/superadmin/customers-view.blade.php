@extends('layouts.superadmin')
@section('title', 'Super Admin - View')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-primary">
                    <p>First name: <span class="fw-semibold ms-3">{{ $customer->first_name }}</span></p>
                    <p>Last name: <span class="fw-semibold ms-3">{{ $customer->last_name }}</span></p>
                    <p>Address: <span class="fw-semibold ms-3">{{ $customer->address }}</span></p>
                    <p>Phone number: <span class="fw-semibold ms-3">{{ $customer->phone_number }}</span></p>
                    <p>Email: <span class="fw-semibold ms-3">{{ $customer->email }}</span></p>
                    <p>Date created: <span class="fw-semibold ms-3">{{ \Carbon\Carbon::parse($customer->created_at)->format('F j, Y g:i a') }}</span></p>
                </div>
            </div>                    
        </div>
    </div>
@endsection