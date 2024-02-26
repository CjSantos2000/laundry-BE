<?php

namespace App\Http\Controllers\Web\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffTransactionController extends Controller
{
    public function index(){
        return view('staff.transactions');
    }
    public function add(){
        return view('staff.transactions-add');
    }
    public function view(){
        return view('staff.transactions-view');
    }
    public function edit(){
        return view('staff.transactions-edit');
    }
}
