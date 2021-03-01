<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function getCommentForMe() {

        $comments = DB::table('comment')
                ->select(['user.id', 'user.username', 'user.fullname', 'user.phone', 'comment.comment'])
                ->where('comment.user_id_2', '=', Auth::user()->id)
                ->leftJoin('user', function ($join) {
                    $join->on('comment.user_id_1', '=', 'user.id');
                })
                ->get();
        //print ($users);
        return view('admin.comment', ['comments' => $comments]);
    }
}
