<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class CustomerAuthController extends Controller
{
    public function test(){
        return response()->json(['message' => 'test']);
    }

    public function index(){
        return response()->json(['message' => 'index']);
    }

    public function register(Request $request){
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed'],
        ]);

        $user = new User();
        $user->role_id = 1;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('customer_washeaselaundry_token')->plainTextToken;

        $response = [
            'token' => $token,
            'user' => $user
        ];

        return response()->json(['response' => $response]);

    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role_id === 1) {
                $token = $user->createToken('customer_washeaselaundry_token')->plainTextToken;

                $response = [
                    'token' => $token,
                    'user' => $user
                ];

                return response()->json(['response' => $response]);
            }

            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Customers account only'], 401);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user->role_id === 1) {
            // $request->user()->tokens()->delete();
            $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
            return response()->json(['message' => 'Successfully logged out']);
        }

        return response()->json(['message' => 'Customers account only'], 401);
    }
}
