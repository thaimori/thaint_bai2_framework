<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QLSinhVienController extends Controller {

    public function quanlysinhvien() {
        $users = DB::table('user')->get();


        return view('admin.quanlysinhvien', ['users' => $users]);
    }

    public function writeUpdate(Request $request) {

        $method = $request->method();
        if ($request->password != '') {
        $affected = DB::table('user')
                ->where('username', '=', $request->username)
                ->update(['username' => $request->username,
                    'password' =>bcrypt($request->password),
                    'fullname' => $request->fullname,
                    'phone' => $request->phone]);
        }else {
            $affected = DB::table('user')
                ->where('username', '=', $request->username)
                ->update(['username' => $request->username,
                    'fullname' => $request->fullname,
                    'phone' => $request->phone]);
        }
        $users = DB::table('user')->get();
        return view('admin.quanlysinhvien', ['users' => $users]);
       
    }

}
