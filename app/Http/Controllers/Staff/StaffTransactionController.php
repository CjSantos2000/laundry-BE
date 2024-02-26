<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\CartItem;
use App\Models\TransactionItem;
use App\Models\Machine;

class StaffTransactionController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $transactions = Transaction::where('shop_admin_id', $user->shop_admin_id)->get();

        $response = [];

        foreach ($transactions as $transaction) {
            $response[] = [
                'id' => $transaction->id,
                'customer' => $transaction->customer,
                'status' => $transaction->status,
                'payment_method' => $transaction->payment_method,
                'name' => $transaction->name,
                'address' => $transaction->address,
                'date' => $transaction->date,
                'time' => $transaction->time,
                'special_instruction' => $transaction->special_instruction,
                'payment_screenshot' => $transaction->payment_screenshot,
                'total_price' => $transaction->total_price,
                'items' => $transaction->items,
                'created_at' => $transaction->created_at,
                'updated_at' => $transaction->updated_at,
            ];
        }


        return response()->json(['transactions' => $response]);
    }

    public function single($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $transaction = Transaction::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();

        $response = [];

        foreach ($transaction->items as $item) {
            $modifiedItem = [
                'id' => $item->id,
                "transaction_id" => $item->transaction_id,
                "additional_service_id" => $item->additional_service_id,
                "status_id" => $item->status_id,
                "service" => $item->service,
                "garmet_id" => $item->garmet_id,
                "garment" => $item->garment,
                "transaction_mode" => $item->transaction_mode,
                "additional_service" => $item->additional_service,
                "machine" => $item->machine,
                "status" => $item->status,
                "name" => $item->name,
                "quantity" => $item->quantity,
                "weight" => $item->weight
            ];
    
            $modifiedItems[] = $modifiedItem;
        }

        $response[] = [
            'id' => $transaction->id,
            'customer' => $transaction->customer,
            'shop_admin' => $transaction->shop_admin,
            'status' => $transaction->status,
            'payment_method' => $transaction->payment_method,
            'name' => $transaction->name,
            'address' => $transaction->address,
            'date' => $transaction->date,
            'time' => $transaction->time,
            'special_instruction' => $transaction->special_instruction,
            'payment_screenshot' => $transaction->payment_screenshot,
            'total_price' => $transaction->total_price,
            'items' => $modifiedItems,
            'created_at' => $transaction->created_at,
            'updated_at' => $transaction->updated_at,
        ];

        return response()->json(['transaction' => $response]);
    }

    public function edit(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $transaction = Transaction::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();

        $request->validate([
            'status_id' => 'required',
        ]);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $transaction->status_id = $request->status_id;
        $transaction->save();

        return response()->json(['message' => 'Successfully edited']);
    }

    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'shop_admin_id' => 'required',
            'payment_method_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'date' => 'required',
            'time' => 'required',
            'special_instruction' => 'required',
            'payment_screenshot' => 'required',
        ]);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $transaction = new Transaction();
        $transaction->customer_id = $user->id;
        $transaction->shop_admin_id = $request->shop_admin_id;
        $transaction->status_id = 1;
        $transaction->payment_method_id = $request->payment_method_id;
        $transaction->name = $request->name;
        $transaction->address = $request->address;
        $transaction->date = $request->date;
        $transaction->time = $request->time;
        $transaction->special_instruction = $request->special_instruction;
        $transaction->payment_screenshot = $request->payment_screenshot;
        $transaction->total_price = $request->total_price;
        $transaction->save();

        $cart_items = CartItem::where('customer_id', $user->id)->where('shop_admin_id', $transaction->shop_admin_id)->get();

        foreach ($cart_items as $cart_item) {
            $transaction_item = new TransactionItem();
            $transaction_item->transaction_id = $transaction->id;
            $transaction_item->status_id = 1;
            $transaction_item->service_id = $cart_item->service_id;
            $transaction_item->garment_id = $cart_item->garment_id;
            $transaction_item->additional_service_id = $cart_item->additional_service_id;
            $transaction_item->transaction_mode_id = $cart_item->transaction_mode_id;
            $transaction_item->name = $cart_item->name;
            $transaction_item->quantity = $cart_item->quantity;
            $transaction_item->weight = $cart_item->weight;
            $transaction_item->save();
        }

        CartItem::where('customer_id', $user->id)->where('shop_admin_id', $transaction->shop_admin_id)->delete();
        
        return response()->json(['message' => 'Successfully add transaction '. $transaction->id ]);
    }
    
    public function itemEdit(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $transaction_item = TransactionItem::where('id', $id)->first();
        // $transaction = Transaction::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();

        // $response2 = [];
        // $modifiedItems = []; // Initialize $modifiedItems as an empty array
        
        // foreach ($transaction->items as $item) {
        //     $modifiedItem = [
        //         'id' => $item->id,
        //         "transaction_id" => $item->transaction_id,
        //         "additional_service_id" => $item->additional_service_id,
        //         "status_id" => $item->status_id,
        //         "service" => $item->service,
        //         "transaction_mode" => $item->transaction_mode,
        //         "additional_service" => $item->additional_service,
        //         "machine" => $item->machine,
        //         "status" => $item->status,
        //         "name" => $item->name,
        //         "quantity" => $item->quantity,
        //         "weight" => $item->weight
        //     ];
        
        //     $modifiedItems[] = $modifiedItem;
        // }
        
        // $response2[] = [
        //     'id' => $transaction->id,
        //     'customer' => $transaction->customer,
        //     'shop_admin' => $transaction->shop_admin,
        //     'status' => $transaction->status,
        //     'payment_method' => $transaction->payment_method,
        //     'name' => $transaction->name,
        //     'address' => $transaction->address,
        //     'date' => $transaction->date,
        //     'time' => $transaction->time,
        //     'special_instruction' => $transaction->special_instruction,
        //     'payment_screenshot' => $transaction->payment_screenshot,
        //     'items' => $modifiedItems,
        //     'created_at' => $transaction->created_at,
        //     'updated_at' => $transaction->updated_at,
        // ];
        
        // $statusIdToCheck = $response2[0]['items'][0]['status_id'];
        // $areStatusIdsEqual = true;
        
        // foreach ($response2[0]['items'] as $item) {
        //     if ($item['status_id'] !== $statusIdToCheck) {
        //         $areStatusIdsEqual = false;
        //         break;
        //     }
        // }
        
        // if($areStatusIdsEqual){
        //     $transaction = Transaction::where('shop_admin_id', $user->shop_admin_id)->where('id', $transaction_item->id)->first();
        //     $transaction->status_id = $areStatusIdsEqual;
        //     $transaction->save();
        // }

        $request->validate([
            'machine_id' => 'required',
            'status_id' => 'required',
        ]);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }
        
        $transaction_item->machine_id = $request->machine_id;
        $transaction_item->status_id = $request->status_id;
        $transaction_item->save();


        $response = [];

        $response[] = [
            'transaction_id' => $transaction_item->transaction_id,
            'message' => 'Successfully edited '.$transaction_item->id.' '.$transaction_item->machine_id.' '.$transaction_item->status_id,
        ];

        return response()->json(['response' => $response ]);

    }
    
    public function itemSingle($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        // $transaction = Transaction::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();
        $transaction_item = TransactionItem::where('id', $id)->first();

        return response()->json(['transaction_item' => $transaction_item]);
    }
    
    public function machines(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $machines = Machine::where('shop_admin_id', $user->shop_admin_id)->get();

        return response()->json(['machines' => $machines]);
    }

    public function edit_machine_status(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $machine = Machine::where('shop_admin_id', $user->shop_admin_id)->where('id', $id)->first();

        $request->validate([
            'status_id' => 'required',
        ]);

        if ($user->role_id != 2) {
            return response()->json(['message' => 'Staff account only'], 401);
        }

        $machine->status_id = $request->status_id;
        $machine->save();

        return response()->json(['message' => 'Successfully edited '. $machine->id . $machine->status_id]);
    }
}
