<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class CustomerDashboardController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customers account only'], 401);
        }

        $shop_admins = User::where('role_id', 4)->get();

        $response = [];

        foreach ($shop_admins as $shop_admin) {
            $resTransactions = [];
            $transactions = Transaction::where('shop_admin_id', $shop_admin->id )->get();
            
            foreach($transactions as $transaction){
                $resTransactions[] = [
                    "id" => $transaction->id,
                    "shop_admin_id" => $transaction->shop_admin_id,
                    "customer_id" => $transaction->customer_id,
                    "status_id" => $transaction->status_id,
                    "payment_method_id" => $transaction->payment_method_id,
                    "name" => $transaction->name,
                    "address" => $transaction->address,
                    "date" => $transaction->date,
                    "time" => $transaction->time,
                    "special_instruction" => $transaction->special_instruction,
                    "payment_screenshot" => $transaction->payment_screenshot,
                    "created_at" => $transaction->created_at,
                    "updated_at" => $transaction->updated_at,
                    "feedbacks" => $transaction->feedbacks
                ];
            }

            $response[] = [
                'transactions' => $resTransactions,
                'id' => $shop_admin->id,
                "shop_admin_id" => $shop_admin->shop_admin_id,
                "role_id" => $shop_admin->role_id,
                "first_name" => $shop_admin->first_name,
                "last_name" => $shop_admin->last_name,
                "shop_name" => $shop_admin->shop_name,
                "address" => $shop_admin->address,
                "phone_number" => $shop_admin->phone_number,
                "image" => $shop_admin->image,
                "email" => $shop_admin->email,
                'created_at' => $shop_admin->created_at,
                'updated_at' => $shop_admin->updated_at,
            ];
        }

        return response()->json(['shop_admins' => $response]);
    }
}
