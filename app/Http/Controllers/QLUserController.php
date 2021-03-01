<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class QLUserController extends Controller {

    //
    public function quanlyuser() {
        $users = DB::table('user')->get();


        return view('admin.quanlyuser', ['users' => $users]);
    }

    public function writeComment(Request $request) {

        $method = $request->method();
        //print ($request);
        $comment = DB::table('comment')
                ->where('comment.user_id_1', Auth::user()->id)
                ->where('comment.user_id_2', $request->username)
                ->count();

        if ($comment != 0) {
            $affected = DB::table('comment')
                    ->where('comment.user_id_1', Auth::user()->id)
                    ->where('comment.user_id_2', $request->username)
                    ->update(['comment' => $request->comment]);
        } else {
            $affected = DB::table('comment')->insert([
                'comment.user_id_1' => Auth::user()->id,
                'comment.user_id_2' => $request->username,
                'comment' => $request->comment
            ]);
        }

        $users = DB::table('user')
                ->select(['user.id', 'user.username', 'user.fullname', 'user.phone', 'comment.comment'])
                ->leftJoin('comment', function ($join) {
                    $join->on('comment.user_id_2', '=', 'user.id')
                    ->where('comment.user_id_1', '=', Auth::user()->id);
                })
                ->get();
        return view('admin.quanlyuser', ['users' => $users]);
    }

    public function getComment() {

        $users = DB::table('user')
                ->select(['user.id', 'user.username', 'user.fullname', 'user.phone', 'comment.comment'])
                ->leftJoin('comment', function ($join) {
                    $join->on('comment.user_id_2', '=', 'user.id')
                    ->where('comment.user_id_1', '=', Auth::user()->id);
                })
                ->get();
        return view('admin.quanlyuser', ['users' => $users]);
    }

    public function editinfo() {
        $users = DB::table('user')
                ->where('id', '=', Auth::user()->id)
                ->get();

        //print ($users);
        return view('admin.editinfo', ['users' => $users]);
    }

    public function updateinfo(Request $request) {
        if ($request->password != '') {
            $affected = DB::table('user')
                    ->where('id', '=', Auth::user()->id)
                    ->update(['username' => $request->username,
                'password' => bcrypt($request->password),
                'fullname' => $request->fullname,
                'phone' => $request->phone]);
            //print ($affected);
        } else {
            $affected = DB::table('user')
                    ->where('id', '=', Auth::user()->id)
                    ->update(['username' => $request->username,
                'fullname' => $request->fullname,
                'phone' => $request->phone]);
        }
        $users = DB::table('user')
                ->where('id', '=', Auth::user()->id)
                ->get();

        //print ($users);
        return view('admin.editinfo', ['users' => $users]);
    }

    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */
}
