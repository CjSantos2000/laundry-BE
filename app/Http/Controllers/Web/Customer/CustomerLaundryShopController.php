<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;

class CustomerLaundryShopController extends Controller
{
    public function index(){
        $shop_admins = User::where('role_id', 4)->get();

        return view('customer.laundry-shops', compact('shop_admins'));
    }
    public function services($id){
        $shop_admins = User::where('role_id', 4)->where('id', $id)->first();

        return view('customer.laundry-shops-services', compact('shop_admins'));
    }
    public function search($id){

    }
    public function transactionModes($id){
        $shop_admins = User::where('role_id', 4)->where('id', $id)->first();

        return view('customer.laundry-shops-transaction-modes', compact('shop_admins'));
    }
    public function additionalServices($id, $service_id){
        $shop_admins = User::where('role_id', 4)->where('id', $id)->first();
        $service = Service::where('id', $service_id)->first();

        return view('customer.laundry-shops-additional-services', compact('shop_admins', 'service'));
    }
    public function garments($id, $service_id){
        $shop_admins = User::where('role_id', 4)->where('id', $id)->first();
        $service = Service::where('id', $service_id)->first();

        return view('customer.laundry-shops-garments', compact('shop_admins', 'service'));
    }
}
