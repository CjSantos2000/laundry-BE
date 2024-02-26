<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminAuthController extends Controller
{
    public function test(){
        return response()->json(['message' => 'test']);
    }

    public function index(){
        return response()->json(['message' => 'index']);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role_id === 5) {
                $token = $user->createToken('super_admin_washeaselaundry_token')->plainTextToken;
                $response = [
                    'token' => $token,
                    'user' => $user
                ];

                return response()->json(['response' => $response]);
            }

            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Super Admin account only'], 401);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user->role_id === 5) {
            // $request->user()->tokens()->delete();
            $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
            return response()->json(['message' => 'Successfully logged out']);
        }

        return response()->json(['message' => 'Super Admin account only'], 401);
    }
}
