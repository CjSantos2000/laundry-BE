<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdditionalService;

class StaffAdditionalServiceController extends Controller
{
    public function index($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staffs account only'], 401);
        }

        $additional_services = AdditionalService::where('service_id', $id)->get();

        return response()->json(['additional_services' => $additional_services]);
    }
}
