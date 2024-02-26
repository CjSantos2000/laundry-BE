<?php

namespace App\Http\Controllers\Web\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ShopAdminRiderController extends Controller
{
    // public function index(){
    //     return view('shopadmin.riders');
    // }
    // public function add(){
    //     return view('shopadmin.riders-add');
    // }
    // public function view(){
    //     return view('shopadmin.riders-view');
    // }
    // public function edit(){
    //     return view('shopadmin.riders-edit');
    // }
    public function index(){
        $riders = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 3)->get();
        
        return view('shopadmin.riders', compact('riders'));
    }
    public function search(Request $request){
        $riders = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 3)->where('email', 'like', '%' . $request->search . '%')->get();

        return view('shopadmin.riders', compact('riders'));
    }
    public function add(){
        return view('shopadmin.riders-add');
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
            return redirect()->route("shop_admins.riders.add")
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->role_id = 3;
        $user->shop_admin_id = auth()->guard('shopadmin')->user()->id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('shop_admins.riders.add')->with('success', 'Rider created successfully');
    }
    public function view($id){
        $rider = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 3)->find($id);

        if(!$rider){
            return abort(404);
        }

        return view('shopadmin.riders-view', compact('rider'));
    }
    public function edit($id){
        $rider = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 3)->find($id);

        if(!$rider){
            return abort(404);
        }

        return view('shopadmin.riders-edit', compact('rider'));
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
            return redirect()->route("shop_admins.riders.edit", $id)
                ->withErrors($validator)
                ->withInput();
        }

        $rider = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 3)->find($id);
        
        if(!$rider){
            return abort(404);
        }

        $rider->first_name = $request->first_name;
        $rider->last_name = $request->last_name;
        $rider->address = $request->address;
        $rider->phone_number = $request->phone_number;
        $rider->email = $request->email;
        $rider->save();

        return redirect()->route('shop_admins.riders.edit', $id)->with('success', 'Rider edited successfully');
    }

    public function processDelete($id){
        $rider = User::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('role_id', 3)->find($id);
        
        if(!$rider){
            return abort(404);
        }

        $rider->delete();

        return redirect()->route("shop_admins.riders.index")->with('danger', 'Rider delete successfully');
    }
}
