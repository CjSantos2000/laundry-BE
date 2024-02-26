<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SellingItem;

class StaffSellingItemController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $selling_items = SellingItem::where('shop_admin_id', $user->shop_admin_id)->get();

        return response()->json(['selling_items' => $selling_items]);
    }

    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048|required',
        ]);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        
        $selling_item = new SellingItem();
        $selling_item->shop_admin_id = $user->shop_admin_id;
        $selling_item->name = $request->name;
        $selling_item->quantity = $request->quantity;
        $selling_item->price = $request->price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $selling_item->image = $path;
        }

        $selling_item->save();

        return response()->json(['message' => 'Successfully add selling item '. $selling_item->id]);
    }

    public function single($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $selling_item = SellingItem::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();
        return response()->json(['selling_item' => $selling_item]);
    }

    public function edit(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $selling_item = SellingItem::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $selling_item->name = $request->name;
        $selling_item->quantity = $request->quantity;
        $selling_item->price = $request->price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $selling_item->image = $path;
        }

        $selling_item->save();

        return response()->json(['message' => 'Successfully edited '.$selling_item->updated_at. ' '. $selling_item->id]);
    }

    public function delete($id){
        $user = User::find(auth()->user()->id);
        $selling_item = SellingItem::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $selling_item->delete();
        
        return response()->json(['message' => 'Successfully deleted '. $selling_item->id]);
    }
}
