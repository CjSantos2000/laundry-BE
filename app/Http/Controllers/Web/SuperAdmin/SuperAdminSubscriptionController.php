<?php

namespace App\Http\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;

class SuperAdminSubscriptionController extends Controller
{
    public function index(){
        $subscriptions = Subscription::all();

        return view('superadmin.subscriptions', compact('subscriptions'));
    }
    public function search(Request $request){
        $subscriptions = Subscription::where('name', 'like', '%' . $request->search . '%')->get();
        
        return view('superadmin.subscriptions', compact('subscriptions'));
    }
    public function add(){
        return view('superadmin.subscriptions-add');
    }
    public function processAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("super_admins.subscriptions.add")
                ->withErrors($validator)
                ->withInput();
        }

        $subscription = new Subscription();
        $subscription->name = $request->name;
        $subscription->price = $request->price;
        $subscription->save();

        return redirect()->route('super_admins.subscriptions.add')->with('success', 'Subscription created successfully');
    }
    public function edit($id){
        $subscription = Subscription::find($id);

        return view('superadmin.subscriptions-edit', compact('subscription'));
    }
    public function processEdit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route("super_admins.subscriptions.add")
                ->withErrors($validator)
                ->withInput();
        }

        $subscription = Subscription::find($id);
        
        if(!$subscription){
            return abort(404);
        }

        $subscription->name = $request->name;
        $subscription->price = $request->price;
        $subscription->save();

        return redirect()->route('super_admins.subscriptions.edit', $id)->with('success', 'Subscription edited successfully');
    }
    public function view($id){
        $subscription = Subscription::find($id);

        return view('superadmin.subscriptions-view', compact('subscription'));
    }
    public function processDelete($id){
        $subscription = Subscription::find($id);
        
        if(!$subscription){
            return abort(404);
        }

        $subscription->delete();

        return redirect()->route("super_admins.subscriptions.index")->with('danger', 'Subscription delete successfully');
    }
}
