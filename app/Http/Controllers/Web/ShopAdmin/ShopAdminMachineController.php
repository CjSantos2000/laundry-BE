<?php

namespace App\Http\Controllers\Web\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Machine;

class ShopAdminMachineController extends Controller
{
    public function index(){
        $machines = Machine::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->get();

        return view('shopadmin.machines', compact('machines'));
    }
    public function search(Request $request){
        $machines = Machine::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('name', 'like', '%' . $request->search . '%')->get();

        return view('shopadmin.machines', compact('machines'));
    }
    public function add(){
        return view('shopadmin.machines-add');
    }
    public function processAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'machine_type_id' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.machines.add")
                ->withErrors($validator)
                ->withInput();
        }

        $machine = new Machine();
        $machine->shop_admin_id = auth()->guard('shopadmin')->user()->id;
        $machine->name = $request->name;
        $machine->status_id = 1;
        $machine->machine_type_id = $request->machine_type_id;
        $machine->save();

        return redirect()->route('shop_admins.machines.add')->with('success', 'Machines created successfully');
    }
    public function view($id){
        $machine = Machine::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);

        if(!$machine){
            return abort(404);
        }

        return view('shopadmin.machines-view', compact('machine'));
    }
    public function edit($id){
        $machine = Machine::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);

        if(!$machine){
            return abort(404);
        }

        return view('shopadmin.machines-edit', compact('machine'));
    }
    public function processEdit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'machine_type_id' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.machines.add")
                ->withErrors($validator)
                ->withInput();
        }

        $machine = Machine::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);
        
        if(!$machine){
            return abort(404);
        }

        $machine->name = $request->name;
        $machine->machine_type_id = $request->machine_type_id;
        $machine->save();

        return redirect()->route('shop_admins.machines.edit', $id)->with('success', 'Machine edited successfully');
    }

    public function processDelete($id){
        $machine = Machine::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);
        
        if(!$machine){
            return abort(404);
        }

        $machine->delete();

        return redirect()->route("shop_admins.machines.index")->with('danger', 'Machine delete successfully');
    }
}
