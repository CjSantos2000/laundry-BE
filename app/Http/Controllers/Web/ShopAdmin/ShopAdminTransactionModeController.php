<?php

namespace App\Http\Controllers\Web\ShopAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TransactionMode;

class ShopAdminTransactionModeController extends Controller
{
    public function index(){
        $transaction_modes = TransactionMode::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->get();

        return view('shopadmin.transaction-modes', compact('transaction_modes'));
    }
    public function search(Request $request){
        $transaction_modes = TransactionMode::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->where('name', 'like', '%' . $request->search . '%')->get();
        
        return view('shopadmin.transaction-modes', compact('transaction_modes'));
    }
    public function add(){
        return view('shopadmin.transaction-modes-add');
    }
    public function processAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.transaction-modes.add")
                ->withErrors($validator)
                ->withInput();
        }

        $transaction_mode = new TransactionMode();
        $transaction_mode->shop_admin_id = auth()->guard('shopadmin')->user()->id;
        $transaction_mode->name = $request->name;
        $transaction_mode->price = $request->price;
        $transaction_mode->save();

        return redirect()->route('shop_admins.transaction-modes.add')->with('success', 'Transaction Mode created successfully');
    }
    public function edit($id){
        $transaction_mode = TransactionMode::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);

        return view('shopadmin.transaction-modes-edit', compact('transaction_mode'));
    }
    public function processEdit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("shop_admins.transaction-modes.add")
                ->withErrors($validator)
                ->withInput();
        }

        $transaction_mode = TransactionMode::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);
        
        if(!$transaction_mode){
            return abort(404);
        }

        $transaction_mode->name = $request->name;
        $transaction_mode->price = $request->price;
        $transaction_mode->save();

        return redirect()->route('shop_admins.transaction-modes.edit', $id)->with('success', 'Transaction Mode edited successfully');
    }
    public function view($id){
        $transaction_mode = TransactionMode::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);

        return view('shopadmin.transaction-modes-view', compact('transaction_mode'));
    }
    public function processDelete($id){
        $transaction_mode = TransactionMode::where('shop_admin_id', auth()->guard('shopadmin')->user()->id)->find($id);
        
        if(!$transaction_mode){
            return abort(404);
        }

        $transaction_mode->delete();

        return redirect()->route("shop_admins.transaction-modes.index")->with('danger', 'TransactionMode delete successfully');
    }
}
