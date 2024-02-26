<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\CartItem;
use App\Models\TransactionItem;

class CustomerTransactionController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customers account only'], 401);
        }

        $transactions = Transaction::where('customer_id', $user->id)->get();

        $response = [];

        foreach ($transactions as $transaction) {
            $modifiedItems = [];
        
            foreach ($transaction->items as $item) {
                $modifiedItem = [
                    'id' => $item->id,
                    "transaction_id" => $item->transaction_id,
                    "service" => $item->service,
                    "transaction_mode" => $item->transaction_mode,
                    "machine" => $item->machine,
                    "garment" => $item->garment,
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
                'feedbacks' => $transaction->feedbacks,
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
        }

        return response()->json(['transactions' => $response]);
    }

    public function single($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customers account only'], 401);
        }

        $response = [];
        
        $transaction = Transaction::where('customer_id', $user->id)->where('id', $id)->first();

        $modifiedItems = [];
        $modifiedItems2 = [];
        
        foreach ($transaction->items as $item) {
            $modifiedItem = [
                'id' => $item->id,
                "transaction_id" => $item->transaction_id,
                "additional_service_id" => $item->additional_service_id,
                "service" => $item->service,
                "garment" => $item->garment,
                "transaction_mode" => $item->transaction_mode,
                "additional_service" => $item->additional_service,
                "machine" => $item->machine,
                "name" => $item->name,
                "quantity" => $item->quantity,
                "weight" => $item->weight
            ];
    
            $modifiedItems[] = $modifiedItem;
        }
    
        foreach ($transaction->feedbacks as $item) {
            $modifiedItem2 = [
                'id' => $item->id,
                'message' => $item->message,
                "transaction_id" => $item->transaction_id,
                "customer" => $item->customer,
                "rating" => $item->rating
            ];
    
            $modifiedItems2[] = $modifiedItem2;
        }

        $response[] = [
            'id' => $transaction->id,
            'customer' => $transaction->customer,
            'shop_admin' => $transaction->shop_admin,
            'status' => $transaction->status,
            'payment_method' => $transaction->payment_method,
            'feedbackss' => $modifiedItems2,
            'feedbacks' => $transaction->feedbacks,
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

        return response()->json(['response' => $response]);
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

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customers account only'], 401);
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
        
        return response()->json(['message' => 'Successfully add transaction']);
    }
}   
