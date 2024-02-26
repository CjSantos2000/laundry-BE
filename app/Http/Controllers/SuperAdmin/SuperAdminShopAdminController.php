<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SuperAdminShopAdminController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 5) {
            return response()->json(['message' => 'Super Admin account only'], 401);
        }

        $shop_admins = User::where('role_id', 4)->get();

        $response = [];

        foreach ($shop_admins as $shop_admin) {
            $response[] = [
                'id' => $shop_admin->id,
                'subscription' => $shop_admin->subscription,
                'shop_admin_id' => $shop_admin->shop_admin_id,
                'shop_name' => $shop_admin->shop_name,
                'role_id' => $shop_admin->role_id,
                'first_name' => $shop_admin->first_name,
                'last_name' => $shop_admin->last_name,
                'address' => $shop_admin->address,
                'phone_number' => $shop_admin->phone_number,
                'image' => $shop_admin->image,
                'email' => $shop_admin->email,
                'password' => $shop_admin->password,
                'created_at' => $shop_admin->created_at,
                'updated_at' => $shop_admin->updated_at,
            ];
        }

        return response()->json(['shop_admins' => $response]);
    }
    
    public function edit_shop_admin_status(Request $request, $id){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'status_id' => 'required',
        ]);

        if ($user->role_id != 5) {
            return response()->json(['message' => 'Super Admin account only'], 401);
        }

        $shop_admin = User::where('role_id', 4)->where('id', $id)->first();

        if (!$shop_admin) {
            return response()->json(['message' => 'Shop Admin not found'], 404);
        }
        
        $shop_admin->subscription->status_id = $request->status_id;
        $shop_admin->subscription->save();

        return response()->json(['message' => 'Successfully edited '. $shop_admin->id . $shop_admin->subscription->status_id]);

    }
}
