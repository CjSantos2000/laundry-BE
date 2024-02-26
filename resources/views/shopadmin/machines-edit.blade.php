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
                            <form action="{{ route('shop_admins.machines.process.edit', $machine->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="name" class="col-sm-12 col-lg-2 col-form-label">Name: </label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $machine->name }}"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="machine_type_id" class="col-sm-12 col-lg-2 col-form-label">Type: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <select name="machine_type_id" id="machine_type_id" class="form-select form-control">
                                            <option value="1" {{ $machine->machine_type_id === 1 ? "selected" : "" }}>Wash</option>
                                            <option value="2" {{ $machine->machine_type_id === 2 ? "selected" : "" }}>Dry</option>
                                        </select>
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