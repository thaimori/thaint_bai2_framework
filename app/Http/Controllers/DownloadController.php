<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    //
    public function viewbaitap(Request $request) {
        $name = $request->file;
        //print ($request->file);
        //$download = Storage::disk('public')->get("upload/baitap/".$request->file);
        $download = storage_path("app\\public\\upload\\baitap\\" . $name);
        print ($download);
        $header = array(
          'Content-Type: application/pdf',  
        );
        return Response::download($download, $name, $header);
        //return response()->file($download);
    }
    public function viewbailam(Request $request) {
        $name = $request->file;
        //print ($request->file);
        //$download = Storage::disk('public')->get("upload/baitap/".$request->file);
        $download = storage_path("app\\public\\upload\\nopbai\\" . $name);
        print ($download);
        $header = array(
          'Content-Type: application/pdf',  
        );
        return Response::download($download, $name, $header);
        //return response()->file($download);
    }
}
