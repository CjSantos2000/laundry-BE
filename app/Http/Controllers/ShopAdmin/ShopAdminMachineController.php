<?php

namespace App\Http\Controllers\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Machine;

class ShopAdminMachineController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $machines = Machine::where('shop_admin_id', $user->id)->get();
        
        $response = [];

        foreach ($machines as $machine) {
            $response[] = [
                'id' => $machine->id,
                'name' => $machine->name,
                'status_id' => $machine->status_id,
                'machine_type' => $machine->machine_type,
                'created_at' => $machine->created_at,
                'updated_at' => $machine->updated_at,
            ];
        }

        return response()->json(['response' => $response]);
    }

    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'machine_type_id' => 'required',
            'name' => 'required',
        ]);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $machine = new Machine();
        $machine->shop_admin_id = $user->id;
        $machine->name = $request->name;
        $machine->status_id = 1;
        $machine->machine_type_id = $request->machine_type_id;
        $machine->save();

        return response()->json(['message' => 'Successfully add machine' . $machine->id]);
    }

    public function single($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }
        
        $machine = Machine::where('shop_admin_id', $user->id)->where('id', $id)->first();
    

        return response()->json(['machine' => $machine]);
    }

    public function edit(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $machine = Machine::where('shop_admin_id', $user->id)->where('id', $id)->first();

        $request->validate([
            'machine_type_id' => 'required',
            'status_id' => 'required',
            'name' => 'required',
        ]);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $machine->name = $request->name;
        $machine->status_id = 1;
        $machine->machine_type_id = $request->machine_type_id;
        $machine->save();

        return response()->json(['message' => 'Successfully edited '. $id]);
    }

    public function delete($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 4) {
            return response()->json(['message' => 'Shop Admin account only'], 401);
        }

        $machine = Machine::where('shop_admin_id', $user->id)->findOrFail($id);
        
        $machine->delete();

        return response()->json(['message' => 'Successfully deleted']);
    }
}
