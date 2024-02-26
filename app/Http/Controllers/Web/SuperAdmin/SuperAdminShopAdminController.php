<?php

namespace App\Http\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ShopAdminSubscription;

class SuperAdminShopAdminController extends Controller
{
    public function index(){
        $shop_admins = User::where('role_id', 4)->get();

        return view('superadmin.shop-admins', compact('shop_admins'));
    }
    public function search(Request $request){
        $shop_admins = User::where('role_id', 4)->where('email', 'like', '%' . $request->search . '%')->get();

        return view('superadmin.shop-admins', compact('shop_admins'));
    }
    public function view($id){
        $shop_admin = User::where('role_id', 4)->find($id);

        if(!$shop_admin){
            return abort(404);
        }

        return view('superadmin.shop-admins-view', compact('shop_admin'));
    }
    public function processDelete($id){
        $shop_admin = User::where('role_id', 4)->find($id);
        
        if(!$shop_admin){
            return abort(404);
        }

        $shop_admin->delete();

        return redirect()->route("super_admins.shop-admins.index")->with('danger', 'Shop Admins delete successfully');
    }
    public function processStatus(Request $request, $id){
        $subscription = ShopAdminSubscription::where('shop_admin_id', $id)->first();

        $subscription->status_id = $request->status_id;
        $subscription->save();

        return redirect()->route("super_admins.shop-admins.view", $id);
    }
}
