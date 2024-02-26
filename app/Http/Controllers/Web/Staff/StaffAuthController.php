<?php

namespace App\Http\Controllers\Web\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffAuthController extends Controller
{
    public function login(){
        if (Auth::guard('staff')->check()) {
            return redirect('/staffs/dashboard');
        }
        return view('staff.login');
    }
    public function processLogin(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('staff')->attempt($credentials)) {
            $user = Auth::guard('staff')->user();
            
            if ($user->role_id === 2) {
                return redirect()->intended('/staffs/dashboard');
            }
    
            Auth::guard('staff')->logout();
            return redirect()->route('staffs.login')->with('error', 'Invalid credentials');
        }
        return redirect()->route('staffs.login')->with('error', 'Invalid credentials');
    }
    public function logout(){
        Auth::guard('staff')->logout();
        return redirect('/staffs/login');
    }
    public function subscription(){
        return view('staff.subscription');
    }
}
