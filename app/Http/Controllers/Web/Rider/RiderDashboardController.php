<?php

namespace App\Http\Controllers\Web\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiderDashboardController extends Controller
{
    public function index(){
        return view('rider.dashboard');
    }
}
