<?php

namespace App\Http\Controllers\Web\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use App\Models\AdditionalService;

class ShopAdminAdditionalLaundryServiceController extends Controller
{
    public function index(){
        $user = auth()->guard('shopadmin')->user();
        $additional_services = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->get();

        return view('shopadmin.additional-laundry-services', compact('additional_services'));
    }
    public function search(Request $request){
        $search = $request->search;
        $user = auth()->guard('shopadmin')->user();
        $additional_services = AdditionalService::whereHas('service', function ($query) use ($user, $search) {
            $query->where('shop_admin_id', $user->id);
        })->where('name', 'like', '%' . $search . '%')->get();

        return view('shopadmin.additional-laundry-services', compact('additional_services'));
    }
    public function add(){
        $services = Service::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->get();

        return view('shopadmin.additional-laundry-services-add', compact('services'));
    }
    public function processAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.additional-laundry-services.add")
                ->withErrors($validator)
                ->withInput();
        }

        $additional_service = new AdditionalService();
        $additional_service->service_id = $request->service_id;
        $additional_service->name = $request->name;
        $additional_service->description = $request->description;
        $additional_service->price = $request->price;
        $additional_service->save();

        return redirect()->route('shop_admins.additional-laundry-services.add')->with('success', 'Additional Laundry Service created successfully');
    }
    public function view($id){
        $user = auth()->guard('shopadmin')->user();
        $additional_services = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->find($id);

        if(!$additional_services){
            return abort(404);
        }

        return view('shopadmin.additional-laundry-services-view', compact('additional_services'));
    }
    public function edit($id){
        $user = auth()->guard('shopadmin')->user();
        $additional_service = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->find($id);

        if(!$additional_service){
            return abort(404);
        }

        $services = Service::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->get();

        return view('shopadmin.additional-laundry-services-edit', compact('additional_service', 'services'));
    }
    public function processEdit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.additional-laundry-services.add")
                ->withErrors($validator)
                ->withInput();
        }

        $user = auth()->guard('shopadmin')->user();
        $additional_services = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->find($id);
        
        if(!$additional_services){
            return abort(404);
        }

        $additional_services->name = $request->name;
        $additional_services->description = $request->description;
        $additional_services->price = $request->price;
        $additional_services->service_id = $request->service_id;
        $additional_services->save();

        return redirect()->route('shop_admins.additional-laundry-services.edit', $id)->with('success', 'Additional Laundry Service edited successfully');
    }
    public function processDelete($id){
        $user = auth()->guard('shopadmin')->user();
        $additional_services = AdditionalService::whereHas('service', function ($query) use ($user) {
            $query->where('shop_admin_id', $user->id);
        })->find($id);
        
        if(!$additional_services){
            return abort(404);
        }

        $additional_services->delete();

        return redirect()->route("shop_admins.additional-laundry-services.index")->with('danger', 'Laundry Service delete successfully');
    }
}
