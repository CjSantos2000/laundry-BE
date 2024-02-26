<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Feedback;

class CustomerFeedbackController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customers account only'], 401);
        }

        $feedbacks = Feedback::where('customer_id', $user->id)->get();
        
        return response()->json(['feedbacks' => $feedbacks]);
    }

    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'transaction_id' => 'required',
            'message' => 'required',
            'rating' => 'required'
        ]);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customers account only'], 401);
        }

        $feedback = new Feedback();
        $feedback->customer_id = $user->id;
        $feedback->transaction_id = $request->transaction_id;
        $feedback->message = $request->message;
        $feedback->rating = $request->rating;
        $feedback->save();

        return response()->json(['message' => 'Successfully add feedback ' . $feedback->id]);
    }


    public function delete($id){
        $user = User::find(auth()->user()->id);

        if ($user->role_id != 1) {
            return response()->json(['message' => 'Customer account only'], 401);
        }

        $feedback = Feedback::where('customer_id', $user->id)->findOrFail($id);
        
        $feedback->delete();

        return response()->json(['message' => 'Successfully deleted '. $feedback->id ]);
    }
}
