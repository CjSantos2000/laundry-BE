<?php

namespace App\Http\Controllers\Web\Customer;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerTransactionController extends Controller
{
    public function index(){
        if (Auth::id() == 12) {
            // Log out the currently authenticated user
            Auth::logout();

            // Redirect to the login page with a message
            return redirect()->route('customers.login')->with('error', 'Registered Customers Only');
        }
        return view('customer.transactions');
    }
    public function view($id){
        return view('customer.transactions-view');
    }
}
