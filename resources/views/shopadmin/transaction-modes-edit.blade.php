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
                        <form action="{{ route('shop_admins.transaction-modes.process.edit', $transaction_mode->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $transaction_mode->name }}"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="price" class="col-sm-12 col-lg-2 col-form-label">Name: </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $transaction_mode->price }}"/>
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