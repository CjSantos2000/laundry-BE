<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{  
    public function index(){
        return view('index');
    }
    public function services(){
        return view('services');
    }
    public function contact(){
        return view('contact');
    }
}
