@extends('layouts.customer')
@section('title', 'Customer - Laundry Shops')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div>
                    <h2 class="title">Laundry Shops</h2>
                </div>
            </div>
            <div class="col-lg-12 mb-20">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="box">
                    <div class="row">
                        <div class="col-lg-10">
                        <form action="#" method="GET">
                                <div class="input-group mb-3 mb-lg-0">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" class="form-control" name="search" placeholder="Search by name" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary w-100">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>Image</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($shop_admins as $shop_admin)
                                            <tr style="transform: rotate(0);">
                                                <td>
                                                    <img src="{{ asset('storage/' . $shop_admin->image) }}" alt="image" width="200" height="200"/>
                                                </td>
                                                <td>{{ $shop_admin->id }}</td>
                                                <td>{{ $shop_admin->shop_name }}</td>
                                                <td>{{ $shop_admin->phone_number }}</td>
                                                <td>{{ $shop_admin->email }}</td>
                                                <td>{{ $shop_admin->address }}</td>
                                                <td>
                                                    <p>
                                                        <a href="{{ route('customers.laundry-shops.transaction-modes', $shop_admin->id) }}" title="View" class="stretched-link"></a>
                                                    </p>
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