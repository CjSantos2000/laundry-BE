<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdditionalService;

class CustomerAdditionalServiceController extends Controller
{
    public function index($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customers account only'], 401);
        }

        $additional_services = AdditionalService::where('service_id', $id)->get();

        return response()->json(['additional_services' => $additional_services]);
    }
}
