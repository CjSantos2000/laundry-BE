<?php

namespace App\Http\Controllers\Web\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Garment;

class ShopAdminGarmentController extends Controller
{
    public function index(){
        $garments = Garment::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->get();

        return view('shopadmin.garments', compact('garments'));
    }
    public function search(Request $request){
        $garments = Garment::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('name', 'like', '%' . $request->search . '%')->get();
        
        return view('shopadmin.garments', compact('garments'));
    }
    public function add(){
        return view('shopadmin.garments-add');
    }
    public function processAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.garments.add")
                ->withErrors($validator)
                ->withInput();
        }

        $garment = new Garment();
        $garment->shop_admin_id = auth()->guard('shopadmin')->user()->id;
        $garment->name = $request->name;
        $garment->description = $request->description;
        $garment->price = $request->price;
        $garment->save();

        return redirect()->route('shop_admins.garments.add')->with('success', 'Garment created successfully');
    }
    public function edit($id){
        $garment = Garment::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);

        return view('shopadmin.garments-edit', compact('garment'));
    }
    public function processEdit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.garments.add")
                ->withErrors($validator)
                ->withInput();
        }

        $garment = Garment::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);
        
        if(!$garment){
            return abort(404);
        }

        $garment->name = $request->name;
        $garment->description = $request->description;
        $garment->price = $request->price;
        $garment->save();

        return redirect()->route('shop_admins.garments.edit', $id)->with('success', 'Garment edited successfully');
    }
    public function view($id){
        $garment = Garment::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);

        return view('shopadmin.garments-view', compact('garment'));
    }
    public function processDelete($id){
        $garment = Garment::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);
        
        if(!$garment){
            return abort(404);
        }

        $garment->delete();

        return redirect()->route("shop_admins.garments.index")->with('danger', 'Garment delete successfully');
    }
}
