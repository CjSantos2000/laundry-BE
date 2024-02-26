<?php

namespace App\Http\Controllers\ShopAdmin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ShopAdminRiderController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $riders = User::where('shop_admin_id', $user->id)->where('role_id', 3)->get();

        return response()->json(['riders' => $riders]);
    }

    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users,email,NULL,id,role_id,3,shop_admin_id,' . $user->id,
            'password' => ['required', 'confirmed'],
        ]);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $rider = new User();
        $rider->role_id = 3;
        $rider->shop_admin_id = $user->id;
        $rider->first_name = $request->first_name;
        $rider->last_name = $request->last_name;
        $rider->address = $request->address;
        $rider->phone_number = $request->phone_number;
        $rider->email = $request->email;
        $rider->password = Hash::make($request->password);
        $rider->save();
        
        return response()->json(['message' => 'Successfully add rider '. $rider->id]);
    }

    public function single($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }
        
        $rider = User::where('shop_admin_id', $user->id)->where('role_id', 3)->where('id', $id)->first();
        
        return response()->json(['rider' => $rider]);
    }

    public function edit(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $rider = User::where('shop_admin_id', $user->id)->where('role_id', 3)->where('id', $id)->first();

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $rider->id,
            'password' => ['required', 'confirmed'],
        ]);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $rider->first_name = $request->first_name;
        $rider->last_name = $request->last_name;
        $rider->address = $request->address;
        $rider->email = $request->email;
        $rider->password = Hash::make($request->password);
        $rider->save();
    
        return response()->json(['message' => 'Successfully edited '.$rider->id]);
    }

    public function delete($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $rider = User::where('shop_admin_id', $user->id)
        ->where('role_id', 3)
        ->findOrFail($id);
        
        $rider->delete();

        return response()->json(['message' => 'Successfully deleted']);
    }
}
