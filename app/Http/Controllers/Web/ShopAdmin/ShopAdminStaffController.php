<?php

namespace App\Http\Controllers\Web\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ShopAdminStaffController extends Controller
{
    public function index(){
        $staffs = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 2)->get();
        
        return view('shopadmin.staffs', compact('staffs'));
    }
    public function search(Request $request){
        $staffs = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 2)->where('email', 'like', '%' . $request->search . '%')->get();

        return view('shopadmin.staffs', compact('staffs'));
    }
    public function add(){
        return view('shopadmin.staffs-add');
    }
    public function processAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.staffs.add")
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->role_id = 2;
        $user->shop_admin_id = auth()->guard('shopadmin')->user()->id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('shop_admins.staffs.add')->with('success', 'Staff created successfully');
    }
    public function view($id){
        $staff = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 2)->find($id);

        if(!$staff){
            return abort(404);
        }

        return view('shopadmin.staffs-view', compact('staff'));
    }
    public function edit($id){
        $staff = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 2)->find($id);

        if(!$staff){
            return abort(404);
        }

        return view('shopadmin.staffs-edit', compact('staff'));
    }
    public function processEdit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required|unique:users,email,'.$id.'|email',

        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.staffs.edit", $id)
                ->withErrors($validator)
                ->withInput();
        }

        $staff = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 2)->find($id);
        
        if(!$staff){
            return abort(404);
        }

        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->address = $request->address;
        $staff->phone_number = $request->phone_number;
        $staff->email = $request->email;
        $staff->save();

        return redirect()->route('shop_admins.staffs.edit', $id)->with('success', 'Staff edited successfully');
    }

    public function processDelete($id){
        $staff = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 2)->find($id);
        
        if(!$staff){
            return abort(404);
        }

        $staff->delete();

        return redirect()->route("shop_admins.staffs.index")->with('danger', 'Staff delete successfully');
    }
}
