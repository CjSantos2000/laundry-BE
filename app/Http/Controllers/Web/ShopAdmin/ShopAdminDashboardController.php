<?php

namespace App\Http\Controllers\Web\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Machine;
use App\Models\Service;
use App\Models\AdditionalService;

class ShopAdminDashboardController extends Controller
{
    public function index(){
        $user = auth()->guard('shopadmin')->user();
        $staffs = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 2)->count();
        $riders = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 3)->count();
        $machines = Machine::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->count();
        $services = Service::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->count();
        $additional_services = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->count();

        $latestStaffs = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 2)->latest()->take(5)->get();
        $latestRiders = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 3)->latest()->take(5)->get();
        $latestMachines = Machine::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->latest()->take(5)->get();
        $latestServices = Service::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->orderBy('name', 'DESC')->take(5)->get();
        $latestAdditionalServices = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->orderBy('name', 'DESC')->take(5)->get();

        return view('shopadmin.dashboard', compact('staffs', 'riders', 'machines', 'services', 'additional_services', 'latestStaffs', 'latestRiders', 'latestMachines', 'latestServices', 'latestAdditionalServices'));
    }
}
