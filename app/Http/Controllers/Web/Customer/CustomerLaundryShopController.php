<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\Machine;
use App\Models\MachineType;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\TransactionMode;

class CustomerLaundryShopController extends Controller
{
    public function index(){
        $shop_admins = User::where('role_id', 4)->get();

        return view('customer.laundry-shops', compact('shop_admins'));
    }

    public function services($id,$transaction_mode_id){
        $shop_admins = User::where('role_id', 4)->where('id', $id)->first();

        return view('customer.laundry-shops-services', compact('shop_admins','transaction_mode_id'));
    }
    
    
    public function search($id){

    }
    public function transactionModes($id){
        $shop_admins = User::where('role_id', 4)->where('id', $id)->first();
     
        if (auth()->id() == 12) {
            // Log out the currently authenticated user
            auth()->logout();

            // Redirect to the login page with a message
            return redirect()->route('customers.login')->with('error', 'Customer accounts only');
        }
        return view('customer.laundry-shops-transaction-modes', compact('shop_admins'));
    }
    public function additionalServices($id, $service_id,$transaction_mode_id){
        $shop_admins = User::where('role_id', 4)->where('id', $id)->first();
        $service = Service::where('id', $service_id)->first();

        return view('customer.laundry-shops-additional-services', compact('shop_admins', 'service','transaction_mode_id'));
    }
    

    public function garments($id, $service_id,$transaction_mode_id){
        $shop_admins = User::where('role_id', 4)->where('id', $id)->first();
        $service_id = Service::where('id', $service_id)->first();
        //$transaction_mode_id = TransactionMode::where('shop_admin_id',$id)->first();
        $machine_type_id = Machine::where('shop_admin_id',$id)->first();
        $additional_service_id = AdditionalService::where('shop_admin_id',$id)->first();
        return view('customer.laundry-shops-garments', compact('shop_admins', 'service_id','transaction_mode_id','machine_type_id','additional_service_id'));
    }
}
