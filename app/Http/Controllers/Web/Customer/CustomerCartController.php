<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerCartController extends Controller
{
    public function index(){
        return view('customer.cart');
    }
}
