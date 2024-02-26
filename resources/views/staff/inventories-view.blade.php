@extends('layouts.staff')
@section('title', 'Staff - View')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-primary">
                    <p>Name: <span class="fw-semibold ms-3">{{ $inventory->name }}</span></p>
                    <p>Quantity: <span class="fw-semibold ms-3">{{ $inventory->quantity }}</span></p>
                    <p>Image: <span class="fw-semibold ms-3"><img src="{{ route('image', ['imageName' => $inventory->image == '' ? 'hey' : $inventory->image]) }}" alt="Image" title="Image" width="400" class="rounded"/></span></p>
                </div>
            </div>                    
        </div>
    </div>
@endsection