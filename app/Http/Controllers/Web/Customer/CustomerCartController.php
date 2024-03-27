<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CartItem;
use App\Models\Garment;
use App\Models\Machine;

class CustomerCartController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            abort(401, 'Customers account only');
        }

        $cart_items = CartItem::where('customer_id', $user->id)->get();

        return view('customer.cart', compact('cart_items'));
    }

    public function add(Request $request)
    {
        $user = User::find(auth()->user()->id);


        if ($user->role_id != 1) {
            abort(401, 'Customer account only');
        }

        $cart_item = new CartItem();
        $cart_item->customer_id = $user->id;
        $cart_item->transaction_mode_id = $request->transaction_mode_id;
        $cart_item->shop_admin_id = $request->shop_admin_id;
        $cart_item->service_id = $request->service_id;
        $cart_item->additional_service_id = $request->additional_service_id;
        $cart_item->garment_id = $request->garment_id;
        $cart_item->machine_id = $request->machine_id;
        $cart_item->name = $request->name;
        $cart_item->quantity = $request->quantity;
        $cart_item->weight = $request->weight;
        $cart_item->save();

        if ($cart_item->machine_id) {
            $machine = Machine::find($cart_item->machine_id);
            $machine->status_id = 9;
            $machine->save();
            return redirect()->route('customers.laundry-shops.garments', [
                'id' => $request->shop_admin_id,
                'service_id' => $request->service_id,
                'transaction_mode_id'=>$request->transaction_mode_id
            ])->with('success', 'Successfully added cart items');
        }
        else{
            return redirect()->route('customers.laundry-shops.garments')->with('error', 'Machine not found');
        }
      
    }

    public function delete($id)
    {
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            abort(401, 'Customer account only');
        }

        $cart_item = CartItem::where('customer_id', $user->id)->findOrFail($id);
        
        $cart_item->delete();

        return redirect()->route('cart.index')->with('success', 'Successfully deleted');
    }

    public function machines($id)
    {
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            abort(401, 'Customer account only');
        }

        $machines = Machine::where('shop_admin_id', $id)->get();

        return response()->json(['machines' => $machines]);
    }
}
