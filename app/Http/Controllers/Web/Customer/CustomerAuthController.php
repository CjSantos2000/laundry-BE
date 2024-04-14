<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function login(){
        // if (Auth::guard('web')->check()) {
        //     return redirect('/');
        // }
        return view('customer.login');
    }
    public function register(){
        if (Auth::guard('web')->check()) {
            return redirect('/customers/dashboard');
        }
        return view('customer.register');
    }
    public function processLogin(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            
            if ($user->role_id === 1) {
                return redirect()->intended('/customers/laundry-shops');
            }
            else if ($user->role_id === 3) {
                return redirect()->intended('/riders/dashboard');
            }
            else if ($user->role_id === 2) {
                return redirect()->intended('/staffs/dashboard');
            }
            else if ($user->role_id === 5) {
                return redirect()->intended('/supderadmin/dashboard');
            } 
            else{
                return redirect()->route('customers.login')->with('error', 'Invalid credentials');

            }
           // Auth::guard('web')->logout();
            return redirect()->route('customers.login')->with('error', 'Invalid credentials');
        }
        return redirect()->route('customers.login')->with('error', 'Invalid credentials');
    }

    public function guestLogin(Request $request){
        Auth::guard('web')->loginUsingId(12); // Assuming guest user has ID 1
        return redirect()->intended('/customers/laundry-shops');
    }
    
    public function processRegister(Request $request){
        // Validation rules
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5048', 
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('customers.register')
                ->withErrors($validator)
                ->withInput();
        }
    
        $user = new User();
        $user->role_id = 1;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->latitude =0;
        $user->longtitude =0;
        $user->password = Hash::make($request->password);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $user->image = $path;
        }
        $user->save();  

        return redirect()->route('customers.login')->with('success', 'Customer created successfully');
    }
    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('index');
        
    }
}
