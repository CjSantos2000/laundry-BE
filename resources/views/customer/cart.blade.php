@extends('layouts.customer') {{-- Assuming you have a layout file named 'app.blade.php' --}}

@section('title', 'Shopping Cart')

@section('content')
    <div class="container">
        <h1>Shopping Cart</h1>
        @foreach($cart_items as $item) {{-- Updated variable name to $cart_items --}}
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="card-text">{{ $item->quantity }} pieces</p>
                    <p class="card-text">{{ $item->weight }} kilogram</p>
                    <p class="card-text">{{ $item->shop_admin->first_name }} {{ $item->shop_admin->last_name }}</p>
                    <p class="card-text">{{ $item->transaction_mode->name }}</p>
                    <p class="card-text">{{ $item->service->name }}</p>
                    <p class="card-text">{{ $item->garment->name }}</p>
                    <p class="card-text">{{ $item->additional_service ? $item->additional_service->name : '' }}</p>
                    <p class="card-text">
                        @if ($item->machine_id)
                            {{ $item->machine->name }} ({{ $item->machine_status->name }})
                        @endif
                    </p>
                    <form action="{{ route('customers.cart.delete', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach

        @if ($cart_items->count() > 0)
            <form action="{{ route('customers.cart.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="shop_admin_id" value="{{ $shop_admin_id }}">
                <input type="hidden" name="price" value="{{ $totalPrice }}">
                <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
            </form>
        @endif
    </div>
@endsection
