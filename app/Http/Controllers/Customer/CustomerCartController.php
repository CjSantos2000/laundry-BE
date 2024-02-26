<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CartItem;
use App\Models\Machine;

class CustomerCartController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customers account only'], 401);
        }

        $cart_items = CartItem::where('customer_id', $user->id)->get();

        $response = [];

        foreach ($cart_items as $cart_item) {
            $response[] = [
                'id' => $cart_item->id,
                'customer_id' => $cart_item->customer_id,
                'transaction_mode_id' => $cart_item->transaction_mode_id,
                'garment_id' => $cart_item->garment_id,
                'shop_admin_id' => $cart_item->shop_admin_id,
                'service_id' => $cart_item->service_id,
                'additional_service_id' => $cart_item->additional_service_id,
                'machine_id' => $cart_item->machine_id,
                'machine' => $cart_item->machine,
                'machine_status' => $cart_item->machine_id === null ? null : $cart_item->machine->status,
                'name' => $cart_item->name,
                'quantity' => $cart_item->quantity,
                'weight' => $cart_item->weight,
                'customer' => $cart_item->quantity,
                'transaction_mode' => $cart_item->transaction_mode,
                'shop_admin' => $cart_item->shop_admin,
                'service' => $cart_item->service,
                'garment' => $cart_item->garment,
                'additional_service' => $cart_item->additional_service,
                'created_at' => $cart_item->created_at,
                'updated_at' => $cart_item->updated_at,
            ];
        }

        return response()->json(['response' => $response]);
    }

    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'transaction_mode_id' => 'required',
            'shop_admin_id' => 'required',
            'service_id' => 'required',
            'garment_id' => 'required',
            'name' => 'required',
            'quantity' => 'required',
            'weight' => 'required',
        ]);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customer account only'], 401);
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

        if($cart_item->machine_id){
            $machine = Machine::find($cart_item->machine_id);
            $machine->status_id = 9;
            $machine->save();
        }

        return response()->json(['message' => 'Successfully add cart items ' . $cart_item->id]);
    }

    public function delete($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customer account only'], 401);
        }

        $cart_item = CartItem::where('customer_id', $user->id)->findOrFail($id);
        
        $cart_item->delete();

        return response()->json(['message' => 'Successfully deleted']);
    }

    public function machines($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customer account only'], 401);
        }

        $machines = Machine::where('shop_admin_id', $id)->get();

        return response()->json(['machines' => $machines]);
    }
}
