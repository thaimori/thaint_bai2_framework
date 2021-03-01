<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {


    public function index() {
        //print (Auth::check());
        if (Auth::check()) {
            //print(storage_path("app/public/"));
            return view('admin.dashboard');
        } else {
            return view('admin.login');
        }
    }

}
