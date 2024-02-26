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
                    <p>Shop: <span class="fw-semibold ms-3">{{ $shop_admin->shop_name }}</span></p>
                    <p>First name: <span class="fw-semibold ms-3">{{ $shop_admin->first_name }}</span></p>
                    <p>Last name: <span class="fw-semibold ms-3">{{ $shop_admin->last_name }}</span></p>
                    <p>Address: <span class="fw-semibold ms-3">{{ $shop_admin->address }}</span></p>
                    <p>Phone number: <span class="fw-semibold ms-3">{{ $shop_admin->phone_number }}</span></p>
                    <p>Email: <span class="fw-semibold ms-3">{{ $shop_admin->email }}</span></p>
                    <p>Date created: <span class="fw-semibold ms-3">{{ \Carbon\Carbon::parse($shop_admin->created_at)->format('F j, Y g:i a') }}</span></p>
                    <hr />
                    <p>Subscription: <span class="fw-semibold ms-3">{{ $shop_admin->subscription->subscription->name }}</span></p>
                    <p>Status: <span class="fw-semibold ms-3">{{ $shop_admin->subscription->status->name }}</span></p>
                    <p>Payment Screenshot: <span class="fw-semibold ms-3"><img src="{{ route('image', ['imageName' => $shop_admin->subscription->payment_screenshot == '' ? 'hey' : $shop_admin->subscription->payment_screenshot]) }}" alt="Screenshot" title="Screenshot" width="400" class="rounded"/></span></p>
                    <form action="{{ route('super_admins.shop-admins.process.status', $shop_admin->id) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="d-flex justify-content-end">
                            <button name="status_id" type="submit" value="6" class="btn btn-success me-2 {{ $shop_admin->subscription->status_id == 6 ? 'disabled' : ''}}">Successful</button>
                            <button name="status_id" type="submit" value="10" class="btn btn-danger me-2 {{ $shop_admin->subscription->status_id == 10 ? 'disabled' : ''}}">Failed</button>
                            <button name="status_id" type="submit" value="1" class="btn btn-warning {{ $shop_admin->subscription->status_id == 1 ? 'disabled' : ''}}">Pending</button>
                        </div>
                    </form>
                </div>
            </div>                    
        </div>
    </div>
@endsection