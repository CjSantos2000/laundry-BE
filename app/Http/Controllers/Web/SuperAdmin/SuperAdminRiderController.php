<?php

namespace App\Http\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SuperAdminRiderController extends Controller
{
    public function index(){
        $riders = User::where('role_id', 3)->get();
        
        return view('superadmin.riders', compact('riders'));
    }
    public function search(Request $request){
        $riders = User::where('role_id', 3)->where('email', 'like', '%' . $request->search . '%')->get();

        return view('superadmin.riders', compact('riders'));
    }
    public function view($id){
        $rider = User::where('role_id', 3)->find($id);

        if(!$rider){
            return abort(404);
        }

        return view('superadmin.riders-view', compact('rider'));
    }

    public function processDelete($id){
        $rider = User::where('role_id', 3)->find($id);
        
        if(!$rider){
            return abort(404);
        }

        $rider->delete();

        return redirect()->route("super_admins.riders.index")->with('danger', 'Rider delete successfully');
    }
}
