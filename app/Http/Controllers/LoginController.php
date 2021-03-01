<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    //
    public function check(Request $request) {
        
        $method = $request->method();
        if ($method == "POST") {
            $arr = [
                'username' => $request->username,
                'password' => $request->password
            ];

            if (Auth::attempt($arr)) {
                $user = Auth::user();
                //echo "1",$user;
                
                Auth::login($user);
                return redirect('/quantri/dashboard');
            } else {
                return "Khong thanh cong";
            }
        } else {
            $user = Auth::user();
            if (Auth::check()) {
                return redirect()->intended('dashboard');
            } else {
                return view('admin.login');
            }
        }


        //return redirect('/quantri/login');
    }

}
