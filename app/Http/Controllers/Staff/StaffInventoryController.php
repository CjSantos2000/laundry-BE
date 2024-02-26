<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inventory;

class StaffInventoryController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $inventories = Inventory::where('shop_admin_id', $user->shop_admin_id)->get();

        return response()->json(['inventories' => $inventories]);
    }

    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'type' => 'required',
        ]);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        
        $inventory = new Inventory();
        $inventory->transaction_id = 0;
        $inventory->shop_admin_id = $user->shop_admin_id;
        $inventory->name = $request->name;
        $inventory->quantity = $request->quantity;
        $inventory->type = $request->type;
        $inventory->save();

        return response()->json(['message' => 'Successfully add inventory '. $inventory->id]);
    }

    public function single($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $inventory = Inventory::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();
        return response()->json(['inventory' => $inventory]);
    }

    public function edit(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $inventory = Inventory::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'type' => 'required',
        ]);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $inventory->name = $request->name;
        $inventory->quantity = $request->quantity;
        $inventory->type = $request->type;
        $inventory->save();

        return response()->json(['message' => 'Successfully edited '.$inventory->created_at. ' '. $inventory->id]);
    }

    public function delete($id){
        $user = User::find(auth()->user()->id);
        $inventory = Inventory::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $inventory->delete();
        
        return response()->json(['message' => 'Successfully deleted '. $inventory->id]);
    }
}
