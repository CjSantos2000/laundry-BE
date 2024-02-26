<?php

namespace App\Http\Controllers\Web\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Inventory;

class StaffInventoryController extends Controller
{
    public function index(){
        $inventories = Inventory::where('shop_admin_id', auth()->guard('staff')->user()->shop_admin_id)->get();

        return view('staff.inventories', compact('inventories'));
    }
    public function search(Request $request){
        $inventories = Inventory::where('shop_admin_id', auth()->guard('staff')->user()->shop_admin_id)->where('name', 'like', '%' . $request->search . '%')->get();
        
        return view('staff.inventories', compact('inventories'));
    }
    public function add(){
        return view('staff.inventories-add');
    }
    public function processAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'name' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("staffs.inventories.add")
                ->withErrors($validator)
                ->withInput();
        }

        $inventory = new Inventory();
        $inventory->shop_admin_id = auth()->guard('staff')->user()->shop_admin_id;
        $inventory->name = $request->name;
        $inventory->quantity = $request->quantity;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $inventory->image = $path;
        }
        $inventory->save();

        return redirect()->route('staffs.inventories.add')->with('success', 'Inventory created successfully');
    }
    public function edit($id){
        $inventory = Inventory::where('shop_admin_id', auth()->guard('staff')->user()->shop_admin_id)->find($id);

        return view('staff.inventories-edit', compact('inventory'));
    }
    public function processEdit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("staffs.inventories.add")
                ->withErrors($validator)
                ->withInput();
        }

        $inventory = Inventory::where('shop_admin_id', auth()->guard('staff')->user()->shop_admin_id)->find($id);
        
        if(!$inventory){
            return abort(404);
        }

        $inventory->name = $request->name;
        $inventory->quantity = $request->quantity;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $inventory->image = $path;
        }
        $inventory->save();

        return redirect()->route('staffs.inventories.edit', $id)->with('success', 'Inventory edited successfully');
    }
    public function view($id){
        $inventory = Inventory::where('shop_admin_id', auth()->guard('staff')->user()->shop_admin_id)->find($id);

        return view('staff.inventories-view', compact('inventory'));
    }
    public function processDelete($id){
        $inventory = Inventory::where('shop_admin_id', auth()->guard('staff')->user()->shop_admin_id)->find($id);
        
        if(!$inventory){
            return abort(404);
        }

        $inventory->delete();

        return redirect()->route("staffs.inventories.index")->with('danger', 'Inventory delete successfully');
    }
}
