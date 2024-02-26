<?php

namespace App\Http\Controllers\Web\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ShopAdminAccountController extends Controller
{
    public function editProfile(){
        return view('shopadmin.edit-profile');
    }
    public function changePassword(){
        return view('shopadmin.change-password');
    }
    public function processEditProfile(Request $request){
        $user = User::find(auth()->guard('shopadmin')->user()->id);
        $user->shop_name = $request->shop_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $user->image = $path;
        }
        
        $user->save();

        return redirect('/shop_admins/edit-profile')->with('success', 'Profile updated successfully');
    }
    public function processChangePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('shop_admins.account.change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(auth()->guard('shopadmin')->user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('shop_admins.account.change-password')->with('error', 'Incorrect old password');
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/shop_admins/change-password')->with('success', 'Password changed successfully');
    }
}
