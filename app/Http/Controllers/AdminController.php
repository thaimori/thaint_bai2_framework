<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller {

    //
    public function login() {
        return view('admin.login');
    }

    public function dashboard() {
        return view('admin.dashboard');
    }

    public function dashboard2() {
        return view('admin.dashboard2');
    }



}
