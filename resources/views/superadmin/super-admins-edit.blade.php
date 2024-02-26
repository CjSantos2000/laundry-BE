@extends('layouts.superadmin')
@section('title', 'Super Admin - Edit')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div><h2 class="title">Edit</h1></div>
        </div>
        <div class="col-lg-12">
            <div class="box">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route("super_admins.super-admins.process.edit", $super_admin->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-3 row">
                                <label for="first_name" class="col-sm-12 col-lg-2 col-form-label">First name: </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $super_admin->first_name }}"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="last_name" class="col-sm-12 col-lg-2 col-form-label">Last name: </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $super_admin->last_name }}"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="address" class="col-sm-12 col-lg-2 col-form-label">Address: </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $super_admin->address }}"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="phone_number" class="col-sm-12 col-lg-2 col-form-label">Phone number: </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $super_admin->phone_number }}"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-12 col-lg-2 col-form-label">Email: </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $super_admin->email }}"/>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-5 mb-4">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection