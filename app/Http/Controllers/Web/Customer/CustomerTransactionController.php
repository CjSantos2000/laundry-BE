<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerTransactionController extends Controller
{
    public function index(){
        return view('customer.transactions');
    }
    public function view($id){
        return view('customer.transactions-view');
    }
}
