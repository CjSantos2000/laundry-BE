<?php

namespace App\Http\Controllers\Web\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiderRideHistoryController extends Controller
{
    public function index(){
        return view('rider.ride-histories');
    }
    public function add(){
        return view('rider.ride-histories-add');
    }
    public function view(){
        return view('rider.ride-histories-view');
    }
    public function edit(){
        return view('rider.ride-histories-edit');
    }
}
