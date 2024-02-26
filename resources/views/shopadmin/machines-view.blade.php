@extends('layouts.shopadmin')
@section('title', 'Shop Admin - View')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-primary">
                    <p>Name: <span class="fw-semibold ms-3">{{ $machine->name }}</span></p>
                    <p>Type: <span class="fw-semibold ms-3">{{ $machine->machine_type->name }}</span></p>
                    <p>Status: <span class="fw-semibold ms-3">{{ $machine->status->name }}</span></p>
                    <p>Date created: <span class="fw-semibold ms-3">{{ \Carbon\Carbon::parse($machine->created_at)->format('F j, Y g:i a') }}</span></p>
                </div>
            </div>                    
        </div>
    </div>
@endsection