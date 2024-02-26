@extends('layouts.shopadmin')
@section('title', 'Shop Admin - Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Dashboard</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Staffs</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-users"></i>
                                <h2 class="float-end">{{ $staffs }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('shop_admins.staffs.index') }}">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Riders</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-motorcycle"></i>
                                <h2 class="float-end">{{ $riders }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('shop_admins.riders.index') }}">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Machines</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-window-maximize"></i>
                                <h2 class="float-end">{{ $machines }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('shop_admins.machines.index') }}">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Laundry Services</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-square"></i>
                                <h2 class="float-end">{{ $services }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('shop_admins.laundry-services.index') }}">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Additional Laundry Service</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-splotch"></i>
                                <h2 class="float-end">{{ $additional_services }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('shop_admins.additional-laundry-services.index') }}">View more...</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>Latest Staffs</h5>
                                <a href="{{ route('shop_admins.staffs.index') }}">see more</a>
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
                                        @foreach ($latestStaffs as $latestStaff)
                                            <tr>
                                                <td>{{ $latestStaff->id }}</td>
                                                <td>{{ $latestStaff->first_name }}</td>
                                                <td>{{ $latestStaff->last_name }}</td>
                                                <td>{{ $latestStaff->email }}</td>
                                                <td>{{ \Carbon\Carbon::parse($latestStaff->created_at)->format('F j, Y g:i a') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('shop_admins.staffs.view', $latestStaff->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
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
                                <a href="{{ route('shop_admins.riders.index') }}">see more</a>
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
                                                        <div class="action-button"><a href="{{ route('shop_admins.riders.view', $rider->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
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
                                <h5>Latest Machines</h5>
                                <a href="{{ route('shop_admins.machines.index') }}">see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Date created</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestMachines as $machine)
                                            <tr>
                                                <td>{{ $machine->id }}</td>
                                                <td>{{ $machine->name }}</td>
                                                <td>{{ $machine->machine_type->name }}</td>
                                                <td>{{ $machine->status->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($machine->created_at)->format('F j, Y g:i a') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('shop_admins.machines.view', $machine->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
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
                                <h5>Latest Laundry Services</h5>
                                <a href="{{ route('shop_admins.laundry-services.index') }}">see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestServices as $service)
                                            <tr>
                                                <td>{{ $service->id }}</td>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->price }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('shop_admins.laundry-services.view', $service->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
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
                                <h5>Latest Additional Laundry Services</h5>
                                <a href="{{ route('shop_admins.additional-laundry-services.index') }}">see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Service</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestAdditionalServices as $additional_service)
                                            <tr>
                                                <td>{{ $additional_service->id }}</td>
                                                <td>{{ $additional_service->name }}</td>
                                                <td>{{ $additional_service->price }}</td>
                                                <td>{{ $additional_service->service->name }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('shop_admins.additional-laundry-services.view', $additional_service->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
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