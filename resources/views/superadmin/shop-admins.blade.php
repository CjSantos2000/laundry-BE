@extends('layouts.superadmin')
@section('title', 'Super Admin - Shop Admins')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div>
                    <h2 class="title">Shop Admins</h2>
                </div>
            </div>
            <div class="col-lg-12 mb-20">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('danger'))
                    <div class="alert alert-danger">
                        {{ session('danger') }}
                    </div>
                @endif
                <div class="box">
                    <div class="row">
                        <div class="col-lg-10">
                        <form action="{{ route("super_admins.shop-admins.search") }}" method="GET">
                                <div class="input-group mb-3 mb-lg-0">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" class="form-control" name="search" placeholder="Search by email" />
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
                                        <th>ID</th>
                                        <th>Shop</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Date created</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($shop_admins as $shop_admin)
                                            <tr>
                                                <td>{{ $shop_admin->id }}</td>
                                                <td>{{ $shop_admin->shop_name }}</td>
                                                <td>{{ $shop_admin->first_name }}</td>
                                                <td>{{ $shop_admin->last_name }}</td>
                                                <td>{{ $shop_admin->email }}</td>
                                                <td>{{ $shop_admin->subscription->status->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($shop_admin->created_at)->format('F j, Y g:i a') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button">
                                                            <a href="{{ route('super_admins.shop-admins.view', $shop_admin->id) }}" title="View">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </div>
                                                        <div class="action-button">
                                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $shop_admin->id }}" title="Delete">
                                                                <i class="fa-solid fa-trash color-red"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="delete-modal-{{ $shop_admin->id }}" tabindex="-1" aria-labelledby="delete-modal-{{ $shop_admin->id }}-label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="delete-modal-{{ $shop_admin->id }}-label">Confirm Deletion</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete staff {{ $shop_admin->id }}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route("super_admins.shop-admins.process.delete", $shop_admin->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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