<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;

class CustomerServiceController extends Controller
{
    public function index($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customers account only'], 401);
        }

        $services = Service::where('shop_admin_id', $id)->get();

        $response = [];

        foreach ($services as $service) {
            $response[] = [
                'id' => $service->id,
                'shop_admin_id' => $service->shop_admin_id,
                'name' => $service->name,
                'description' => $service->description,
                'price' => $service->price,
                'additional_services' => $service->additional_services,
            ];
        }   

        return response()->json(['response' => $response]);
    }
}
