<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QLBaiTapController extends Controller {

    //
    public function quanlybaitap() {

        $baitap = DB::table('baitap')
                ->select(['baitap.id', 'baitap.tenbaitap', 'baitap.filename', 'nopbaitap.filebailam'])
                ->leftJoin('nopbaitap', function ($join) {
                    $join->on('baitap.id', '=', 'nopbaitap.baitap_id')
                    ->where('nopbaitap.user_id', '=', Auth::user()->id);
                })
                ->get();
        return view('admin.quanlybaitap', ['baitap' => $baitap]);
    }

    public function nopbaitap(Request $request) {
        $current_time = (round(microtime(true)) * 1000);
        switch ($request->input('action')) {
            case 'nopbai':

                $file = $request->file('filenop');
                //print ($file);
                $filenamewithext = $request->file('filenop')->getClientOriginalName();
                $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
                $ext = $request->file('filenop')->getClientOriginalExtension();
                if ($ext == "pdf") {
                    $fileNameToStore = $current_time . '_' . $filename . '.' . $ext;
                    $path = $request->file('filenop')->storeAs('public/upload/nopbai', $fileNameToStore);

                    //print ($request->username);
                    if ($path) {
                        $count = DB::table('nopbaitap')
                                ->where('baitap_id', '=', $request->username)
                                ->where('user_id', '=', Auth::user()->id)
                                ->count();

                        if ($count == 0) {
                            $affected = DB::table('nopbaitap')->insert([
                                'id' => null,
                                'baitap_id' => $request->username,
                                'user_id' => Auth::user()->id,
                                'filebailam' => $fileNameToStore
                            ]);
                        }
                    }
                }
                $baitap = DB::table('baitap')
                        ->select(['baitap.id', 'baitap.tenbaitap', 'baitap.filename', 'nopbaitap.filebailam'])
                        ->leftJoin('nopbaitap', function ($join) {
                            $join->on('baitap.id', '=', 'nopbaitap.baitap_id')
                            ->where('nopbaitap.user_id', '=', Auth::user()->id);
                        })
                        ->get();
                return view('admin.quanlybaitap', ['baitap' => $baitap]);
                break;
            case 'thembai':
                //print("them bai tap");
                $bailam = $request->file('bailam');
                //print($bailam);
                $filenamewithext = $bailam->getClientOriginalName();
                $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
                $ext = $bailam->getClientOriginalExtension();

                if ($ext == "pdf") {
                    $fileNameToStore = $current_time . '_' . $filename . '.' . $ext;
                    $path = $bailam->storeAs('public/upload/baitap', $fileNameToStore);

                    //print ($request->username);
                    if ($path) {
                        $affected = DB::table('baitap')->insert([
                            'id' => null,
                            'tenbaitap' => $request->tenbaitap,
                            'filename' => $fileNameToStore
                        ]);
                    }
                }
                $baitap = DB::table('baitap')
                        ->select(['baitap.id', 'baitap.tenbaitap', 'baitap.filename', 'nopbaitap.filebailam'])
                        ->leftJoin('nopbaitap', function ($join) {
                            $join->on('baitap.id', '=', 'nopbaitap.baitap_id')
                            ->where('nopbaitap.user_id', '=', Auth::user()->id);
                        })
                        ->get();
                return view('admin.quanlybaitap', ['baitap' => $baitap]);
                break;
        }
    }

}
