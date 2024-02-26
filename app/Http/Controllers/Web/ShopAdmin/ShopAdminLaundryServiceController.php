<?php

namespace App\Http\Controllers\Web\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;

class ShopAdminLaundryServiceController extends Controller
{
    public function index(){
        $services = Service::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->get();

        return view('shopadmin.laundry-services', compact('services'));
    }
    public function search(Request $request){
        $services = Service::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('name', 'like', '%' . $request->search . '%')->get();

        return view('shopadmin.laundry-services', compact('services'));
    }
    public function add(){
        return view('shopadmin.laundry-services-add');
    }
    public function processAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.laundry-services.add")
                ->withErrors($validator)
                ->withInput();
        }

        $service = new Service();
        $service->shop_admin_id = auth()->guard('shopadmin')->user()->id;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();

        return redirect()->route('shop_admins.laundry-services.add')->with('success', 'Laundry Service created successfully');
    }
    public function view($id){
        $service = Service::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);

        if(!$service){
            return abort(404);
        }

        return view('shopadmin.laundry-services-view', compact('service'));
    }
    public function edit($id){
        $service = Service::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);

        if(!$service){
            return abort(404);
        }

        return view('shopadmin.laundry-services-edit', compact('service'));
    }
    public function processEdit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.laundry-services.add")
                ->withErrors($validator)
                ->withInput();
        }

        $service = Service::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);
        
        if(!$service){
            return abort(404);
        }

        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();

        return redirect()->route('shop_admins.laundry-services.edit', $id)->with('success', 'Laundry Service edited successfully');
    }
    public function processDelete($id){
        $service = Service::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);
        
        if(!$service){
            return abort(404);
        }

        $service->delete();

        return redirect()->route("shop_admins.laundry-services.index")->with('danger', 'Laundry Service delete successfully');
    }
}
