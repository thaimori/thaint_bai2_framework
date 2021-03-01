<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class QLChallengeController extends Controller {

    public function allchallenge() {

        $challenge = DB::table('challenge')
                ->get();
        return view('admin.quanlychallenge', ['challenge' => $challenge]);
    }

    public function postChallenge(Request $request) {
        $current_time = (round(microtime(true)) * 1000);
        switch ($request->input('action')) {
            case 'themchallenge':
                //print("nopbai");
                $file = $request->file('challenge');
                //print ($file);
                $filenamewithext = $file->getClientOriginalName();
                $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
                $ext = $file->getClientOriginalExtension();
                if ($ext == 'txt') {
                    $fileNameToStore = $current_time . '_' . $filename . '.' . $ext;
                    $path = $file->storeAs('public/upload/challenge', $fileNameToStore);

                    //print ($request->username);
                    if ($path) {
                        $affected = DB::table('challenge')->insert([
                            'id' => null,
                            'tenchallenge' => $request->tenchallenge,
                            'goiy' => $request->goiy
                        ]);
                    }
                    $challenge = DB::table('challenge')
                            ->get();
                    return view('admin.quanlychallenge', ['challenge' => $challenge]);
                    break;
                } else {
                    print ('Định dạng không đúng !!!');
                    $challenge = [];
                    return view('admin.quanlychallenge', ['challenge' => $challenge]);
                }

            case 'submitdapan':
                $dapan = $request->dapan;
                //print ($dapan);

                $files = Storage::disk('public')->allFiles('/upload/challenge');
                foreach ($files as $file) {
                    $find = false;
                    preg_match('~_(.*)\.txt~', $file, $out);
//                    print ($out[1]);
                    if (strtolower($out[1]) == strtolower($dapan)) {
                        $find = true;
                        //print ($file);
                        $content = File::get(storage_path("app/public/" . $file));
                        //print ($content);
                        
                        $challenge = DB::table('challenge')->get();
                        return view('admin.quanlychallenge', ['content' => $content, 'challenge' => $challenge]);
                        break;
                    }
                };
                $content = "Đáp án chưa đúng !!!";
                $challenge = DB::table('challenge')->get();
                return view('admin.quanlychallenge', ['content' => $content, 'challenge' => $challenge]);
        }
    }

}
