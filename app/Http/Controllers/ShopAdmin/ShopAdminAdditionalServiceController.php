<?php

namespace App\Http\Controllers\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdditionalService;

class ShopAdminAdditionalServiceController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $additional_services = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->get();

        $response = [];

        foreach ($additional_services as $additional_service) {
        
            $response[] = [
                'id' => $additional_service->id,
                'name' => $additional_service->name,
                'description' => $additional_service->description,
                'price' => $additional_service->price,
                'service' => $additional_service->service,
            ];
        }

        return response()->json(['response' => $response]);
    }
    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'service_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $additional_service = new AdditionalService();
        $additional_service->service_id = $request->service_id;
        $additional_service->name = $request->name;
        $additional_service->description = $request->description;
        $additional_service->price = $request->price;
        $additional_service->save();

        return response()->json(['message' => 'Successfully add additional service '. $additional_service->id]);
    }
    public function single($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $additional_service = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->where('id', $id)->first();

        return response()->json(['additional_service' => $additional_service]);
    }
    public function edit(Request $request, $id){
        $user = User::find(auth()->user()->id);

        $additional_service = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->where('id', $id)->first();

        $request->validate([
            'service_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $additional_service->service_id = $request->service_id;
        $additional_service->name = $request->name;
        $additional_service->description = $request->description;
        $additional_service->price = $request->price;
        $additional_service->save();

        return response()->json(['message' => 'Successfully edited '.$additional_service->id . ' '. $additional_service->name . ' ' . $additional_service->description]);
    }
    public function delete($id){
        $user = User::find(auth()->user()->id);
        $additional_service = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->where('id', $id)->first();

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $additional_service->delete();

        return response()->json(['message' => 'Successfully deleted '. $additional_service->id]);
    }
}
