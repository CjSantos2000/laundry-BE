<?php

namespace App\Http\Controllers\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\ShopAdminSubscription;
// use Illuminate\Support\Carbon;

class ShopAdminAuthController extends Controller
{
    public function test(){
        return response()->json(['message' => 'test']);
    }

    public function index(){
        return response()->json(['message' => 'index']);
    }

    public function register(Request $request){
        $request->validate([
            'shop_name' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users',
            'payment_screenshot' => 'required',
            'subscription_id' => 'required',
            'password' => ['required', 'confirmed'],
        ]);

        $user = new User();
        $user->role_id = 4;
        $user->shop_name = $request->shop_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $shop_admin_subscription = new ShopAdminSubscription();
        $shop_admin_subscription->shop_admin_id = $user->id;
        $shop_admin_subscription->status_id = 1;
        $shop_admin_subscription->subscription_id = $request->subscription_id;
        $shop_admin_subscription->payment_screenshot = $request->payment_screenshot;
        $shop_admin_subscription->save();

        // $token = $user->createToken('shop_admin_washeaselaundry_token')->plainTextToken;

        return response()->json(['message' => 'Registered successfully']);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role_id === 4 && $user->subscription->status_id === 6) {
                $token = $user->createToken('shop_admin_washeaselaundry_token')->plainTextToken;
                $response = [
                    'token' => $token,
                    'user' => $user
                ];

                return response()->json(['response' => $response]);
            }else if($user->role_id === 4 && $user->subscription->status_id === 1){
                $request->user()->tokens()->delete();
                return response()->json(['message' => 'Your account is not approved yet'], 401);
            }

            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user->role_id === 4) {
            // $request->user()->tokens()->delete();
            $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
            return response()->json(['message' => 'Successfully logged out']);
        }

        return response()->json(['message' => 'Shop Admin account only'], 401);
    }
}
