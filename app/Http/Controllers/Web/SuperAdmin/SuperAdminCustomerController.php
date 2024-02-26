<?php

namespace App\Http\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SuperAdminCustomerController extends Controller
{
    public function index(){
        $customers = User::where('role_id', 1)->get();
        
        return view('superadmin.customers', compact('customers'));
    }
    public function search(Request $request){
        $customers = User::where('role_id', 1)->where('email', 'like', '%' . $request->search . '%')->get();

        return view('superadmin.customers', compact('customers'));
    }
    public function view($id){
        $customer = User::where('role_id', 1)->find($id);

        if(!$customer){
            return abort(404);
        }

        return view('superadmin.customers-view', compact('customer'));
    }

    public function processDelete($id){
        $customer = User::where('role_id', 1)->find($id);
        
        if(!$customer){
            return abort(404);
        }

        $customer->delete();

        return redirect()->route("super_admins.customers.index")->with('danger', 'Customer delete successfully');
    }
}
