<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerAccountController extends Controller
{
    public function editProfile(){
        return view('customer.edit-profile');
    }
    public function changePassword(){
        return view('customer.change-password');
    }
    public function processEditProfile(Request $request){
        $user = User::find(auth()->guard('customer')->user()->id);
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

        return redirect('/customers/edit-profile')->with('success', 'Profile updated successfully');
    }
    public function processChangePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('customers.account.change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(auth()->guard('customer')->user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('customers.account.change-password')->with('error', 'Incorrect old password');
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/customers/change-password')->with('success', 'Password changed successfully');
    }

    public function getImage($imageName){
        
        $path = storage_path($imageName);

        if (file_exists($path)) {
            return response()->file($path);
        }
        
        return response()->file(storage_path('default.jpg'));
    }
}
