<?php

namespace App\Http\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminAuthController extends Controller
{
    public function login(){
        if (Auth::guard('superadmin')->check()) {
            return redirect('/super_admins/dashboard');
        }
        return view('superadmin.login');
    }
    public function processLogin(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('superadmin')->attempt($credentials)) {
            $user = Auth::guard('superadmin')->user();
            
            if ($user->role_id === 5) {
                return redirect()->intended('/super_admins/dashboard');
            }
    
            Auth::guard('superadmin')->logout();
            return redirect()->route('super_admins.login')->with('error', 'Invalid credentials');
        }
        return redirect()->route('super_admins.login')->with('error', 'Invalid credentials');
    }
    public function logout(){
        Auth::guard('superadmin')->logout();
        return redirect('/super_admins/login');
    }
    public function subscription(){
        return view('superadmin.subscription');
    }
}
