<?php

namespace App\Http\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SuperAdminDashboardController extends Controller
{
    public function index(){
        $customers = User::where('role_id', 1)->count();
        $staffs = User::where('role_id', 2)->count();
        $riders = User::where('role_id', 3)->count();
        $shop_admins = User::where('role_id', 4)->count();
        $super_admins = User::where('role_id', 5)->count();

        $latestCustomers = User::where('role_id', 1)->latest()->take(5)->get();
        $latestStaffs = User::where('role_id', 2)->latest()->take(5)->get();
        $latestRiders = User::where('role_id', 3)->latest()->take(5)->get();
        $latestShopAdmins = User::where('role_id', 4)->latest()->take(5)->get();
        $latestSuperAdmins = User::where('role_id', 5)->latest()->take(5)->get();

        return view('superadmin.dashboard', compact('customers', 'staffs', 'riders', 'shop_admins', 'super_admins', 'latestCustomers', 'latestStaffs', 'latestRiders', 'latestShopAdmins', 'latestSuperAdmins'));
    }
}
