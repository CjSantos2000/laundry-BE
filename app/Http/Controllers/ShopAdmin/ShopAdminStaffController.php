<?php

namespace App\Http\Controllers\ShopAdmin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ShopAdminStaffController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $staffs = User::where('shop_admin_id', $user->id)->where('role_id', 2)->get();

        return response()->json(['staffs' => $staffs]);
    }

    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users,email,NULL,id,role_id,2,shop_admin_id,' . $user->id,
            'password' => ['required', 'confirmed'],
        ]);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $staff = new User();
        $staff->role_id = 2;
        $staff->shop_admin_id = $user->id;
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->address = $request->address;
        $staff->phone_number = $request->phone_number;
        $staff->email = $request->email;
        $staff->password = Hash::make($request->password);
        $staff->save();
        
        return response()->json(['message' => 'Successfully add staff ' . $staff->id]);
    }

    public function single($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }
        
        $staff = User::where('shop_admin_id', $user->id)->where('role_id', 2)->where('id', $id)->first();
        
        return response()->json(['staff' => $staff]);
    }

    public function edit(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $staff = User::where('shop_admin_id', $user->id)->where('role_id', 2)->where('id', $id)->first();

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $staff->id,
            'password' => ['required', 'confirmed'],
        ]);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->address = $request->address;
        $staff->email = $request->email;
        $staff->password = Hash::make($request->password);
        $staff->save();
    
        return response()->json(['message' => 'Successfully edited '. $staff->id]);
    }

    public function delete($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $staff = User::where('shop_admin_id', $user->id)
        ->where('role_id', 2)
        ->findOrFail($id);
        
        $staff->delete();

        return response()->json(['message' => 'Successfully deleted']);
    }
}
