@extends('layouts.shopadmin')
@section('title', 'Shop Admin - Machines')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div>
                    <h2 class="title">Machines</h2>
                </div>
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('shop_admins.machines.add') }}">
                        <i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;Add Machine
                    </a>
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
                        <form action="{{ route("shop_admins.machines.search") }}" method="GET">
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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Date created</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($machines as $machine)
                                            <tr>
                                                <td>{{ $machine->id }}</td>
                                                <td>{{ $machine->name }}</td>
                                                <td>{{ $machine->machine_type->name }}</td>
                                                <td>{{ $machine->status->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($machine->created_at)->format('F j, Y g:i a') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button">
                                                            <a href="{{ route('shop_admins.machines.view', $machine->id) }}" title="View">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </div>
                                                        <div class="action-button"><a href="{{ route('shop_admins.machines.edit', $machine->id) }}" title="Edit"><i class="fa-solid fa-pencil"></i></a></div>
                                                        <div class="action-button">
                                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $machine->id }}" title="Delete">
                                                                <i class="fa-solid fa-trash color-red"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="delete-modal-{{ $machine->id }}" tabindex="-1" aria-labelledby="delete-modal-{{ $machine->id }}-label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="delete-modal-{{ $machine->id }}-label">Confirm Deletion</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete machine {{ $machine->id }}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route("shop_admins.machines.process.delete", $machine) }}" method="POST">
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