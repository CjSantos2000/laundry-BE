<?php

namespace App\Http\Controllers\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;

class ShopAdminServiceController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $services = Service::where('shop_admin_id', $user->id)->get();
        
        return response()->json(['services' => $services]);
    }
    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $service = new Service();
        $service->shop_admin_id = $user->id;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();

        return response()->json(['message' => 'Successfully add service '. $service->id]);
    }
    public function single($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $service = Service::where('shop_admin_id', $user->id)->where('id', $id)->first();

        return response()->json(['service' => $service]);
    }
    public function edit(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $service = Service::where('shop_admin_id', $user->id)->where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        
        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $service->shop_admin_id = $user->id;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        
        return response()->json(['message' => 'Successfully edited '.$service->id . ' '. $service->name . ' ' . $service->description]);
    }
    public function delete($id){
        $user = User::find(auth()->user()->id);
        $service = Service::where('shop_admin_id', $user->id)->where('id', $id)->first();

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
    
        // Delete associated cart items before deleting the service
        $service->cart_items()->delete();
    
        $service->delete();
        

        return response()->json(['message' => 'Successfully deleted '. $service->id]);
    }
}
