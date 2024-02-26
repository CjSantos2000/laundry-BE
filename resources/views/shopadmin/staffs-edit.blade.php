@extends('layouts.shopadmin')
@section('title', 'Shop Admin - Edit')

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
                        <form action="{{ route("shop_admins.staffs.process.edit", $staff->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $staff->first_name }}"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="last_name" class="col-sm-12 col-lg-2 col-form-label">Last name: </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $staff->last_name }}"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="address" class="col-sm-12 col-lg-2 col-form-label">Address: </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $staff->address }}"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="phone_number" class="col-sm-12 col-lg-2 col-form-label">Phone number: </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $staff->phone_number }}"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-12 col-lg-2 col-form-label">Email: </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $staff->email }}"/>
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