@extends('layouts.superadmin')
@section('title', 'Super Admin - Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Dashboard</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Customers</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-users"></i>
                                <h2 class="float-end">{{ $customers }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('super_admins.customers.index') }}">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Staffs</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-users"></i>
                                <h2 class="float-end">{{ $staffs }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('super_admins.staffs.index') }}">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Riders</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-users"></i>
                                <h2 class="float-end">{{ $riders }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('super_admins.riders.index') }}">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Shop Admins</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-users"></i>
                                <h2 class="float-end">{{ $shop_admins }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('super_admins.shop-admins.index') }}">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Super Admins</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-users"></i>
                                <h2 class="float-end">{{ $super_admins }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('super_admins.super-admins.index') }}">View more...</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>Latest Customers</h5>
                                <a href="{{ route('super_admins.customers.index') }}">see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Date created</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestCustomers as $customer)
                                            <tr>
                                                <td>{{ $customer->id }}</td>
                                                <td>{{ $customer->first_name }}</td>
                                                <td>{{ $customer->last_name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ \Carbon\Carbon::parse($customer->created_at)->format('F j, Y g:i a') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('super_admins.customers.view', $customer->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>Latest Staffs</h5>
                                <a href="{{ route('super_admins.staffs.index') }}">see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Date created</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestStaffs as $staff)
                                            <tr>
                                                <td>{{ $staff->id }}</td>
                                                <td>{{ $staff->first_name }}</td>
                                                <td>{{ $staff->last_name }}</td>
                                                <td>{{ $staff->email }}</td>
                                                <td>{{ \Carbon\Carbon::parse($staff->created_at)->format('F j, Y g:i a') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('super_admins.staffs.view', $staff->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>Latest Riders</h5>
                                <a href="{{ route('super_admins.riders.index') }}">see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Date created</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestRiders as $rider)
                                            <tr>
                                                <td>{{ $rider->id }}</td>
                                                <td>{{ $rider->first_name }}</td>
                                                <td>{{ $rider->last_name }}</td>
                                                <td>{{ $rider->email }}</td>
                                                <td>{{ \Carbon\Carbon::parse($rider->created_at)->format('F j, Y g:i a') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('super_admins.riders.view', $rider->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>Latest Shop Admins</h5>
                                <a href="{{ route('super_admins.shop-admins.index') }}">see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Date created</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestShopAdmins as $shop_admins)
                                            <tr>
                                                <td>{{ $shop_admins->id }}</td>
                                                <td>{{ $shop_admins->first_name }}</td>
                                                <td>{{ $shop_admins->last_name }}</td>
                                                <td>{{ $shop_admins->email }}</td>
                                                <td>{{ \Carbon\Carbon::parse($shop_admins->created_at)->format('F j, Y g:i a') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('super_admins.shop-admins.view', $shop_admins->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>Latest Super Admins</h5>
                                <a href="{{ route('super_admins.super-admins.index') }}">see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Date created</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestSuperAdmins as $super_admin)
                                            <tr>
                                                <td>{{ $super_admin->id }}</td>
                                                <td>{{ $super_admin->first_name }}</td>
                                                <td>{{ $super_admin->last_name }}</td>
                                                <td>{{ $super_admin->email }}</td>
                                                <td>{{ \Carbon\Carbon::parse($super_admin->created_at)->format('F j, Y g:i a') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('super_admins.super-admins.view', $super_admin->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection