<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EditInfoController extends Controller
{
    public function editinfo() {
        $users = DB::table('user')
                ->where('id','=',Auth::user()->id)
                ->get();


        return view('admin.quanlysinhvien', ['users' => $users]);
    }
}
