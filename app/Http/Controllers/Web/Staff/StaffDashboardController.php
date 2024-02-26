<?php

namespace App\Http\Controllers\Web\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function index(){
        return view('staff.dashboard');
    }
}
