<?php

namespace App\Http\Controllers\Web\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RiderAuthController extends Controller
{
    public function login(){
        if (Auth::guard('web')->check()) {
            return redirect('/riders/dashboard');
        }
        return view('rider.login');
    }
    public function processLogin(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            
            if ($user->role_id === 3) {
                return redirect()->intended('/riders/dashboard');
            }
    
            Auth::guard('web')->logout();
            return redirect()->route('riders.login')->with('error', 'Invalid credentials');
        }
        return redirect()->route('riders.login')->with('error', 'Invalid credentials');
    }
    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
