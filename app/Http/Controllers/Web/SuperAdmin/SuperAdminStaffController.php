<?php

namespace App\Http\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SuperAdminStaffController extends Controller
{
    public function index(){
        $staffs = User::where('role_id', 2)->get();
        
        return view('superadmin.staffs', compact('staffs'));
    }
    public function search(Request $request){
        $staffs = User::where('role_id', 2)->where('email', 'like', '%' . $request->search . '%')->get();

        return view('superadmin.staffs', compact('staffs'));
    }
    public function view($id){
        $staff = User::where('role_id', 2)->find($id);

        if(!$staff){
            return abort(404);
        }

        return view('superadmin.staffs-view', compact('staff'));
    }

    public function processDelete($id){
        $staff = User::where('role_id', 2)->find($id);
        
        if(!$staff){
            return abort(404);
        }

        $staff->delete();

        return redirect()->route("super_admins.staffs.index")->with('danger', 'Staff delete successfully');
    }
}
