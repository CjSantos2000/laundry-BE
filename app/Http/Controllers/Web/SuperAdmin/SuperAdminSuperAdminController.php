<?php

namespace App\Http\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSuperAdminController extends Controller
{
    public function index(){
        $super_admins = User::where('role_id', 5)->get();
        
        return view('superadmin.super-admins', compact('super_admins'));
    }
    public function search(Request $request){
        $super_admins = User::where('role_id', 5)->where('email', 'like', '%' . $request->search . '%')->get();

        return view('superadmin.super-admins', compact('super_admins'));
    }
    public function add(){
        return view('superadmin.super-admins-add');
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
            return redirect()->route("super_admins.super-admins.add")
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->role_id = 5;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('super_admins.super-admins.add')->with('success', 'Super Admin created successfully');
    }
    public function view($id){
        $super_admin = User::where('role_id', 5)->find($id);

        if(!$super_admin){
            return abort(404);
        }

        return view('superadmin.super-admins-view', compact('super_admin'));
    }
    public function edit($id){
        $super_admin = User::where('role_id', 5)->find($id);

        if(!$super_admin){
            return abort(404);
        }

        return view('superadmin.super-admins-edit', compact('super_admin'));
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
            return redirect()->route("super_admins.super-admins.edit", $id)
                ->withErrors($validator)
                ->withInput();
        }

        $super_admin = User::where('role_id', 5)->find($id);
        
        if(!$super_admin){
            return abort(404);
        }

        $super_admin->first_name = $request->first_name;
        $super_admin->last_name = $request->last_name;
        $super_admin->address = $request->address;
        $super_admin->phone_number = $request->phone_number;
        $super_admin->email = $request->email;
        $super_admin->save();

        return redirect()->route('super_admins.super-admins.edit', $id)->with('success', 'Super Admin edited successfully');
    }

    public function processDelete($id){
        $super_admin = User::where('role_id', 5)->find($id);
        
        if(!$super_admin){
            return abort(404);
        }

        $super_admin->delete();

        return redirect()->route("super_admins.super-admins.index")->with('danger', 'Super Admin delete successfully');
    }
}
