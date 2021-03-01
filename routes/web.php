<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

//frontend

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/view/baitap/{file}', 'App\Http\Controllers\DownloadController@viewbaitap');
Route::get('/view/bailam/{file}', 'App\Http\Controllers\DownloadController@viewbailam');


//admin
Route::get('/quantri/login', 'App\Http\Controllers\LoginController@check')->name('login');
Route::post('/quantri/login', 'App\Http\Controllers\LoginController@check')->name('login');
Route::get('/quantri/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('dashboard')->middleware('auth');
Route::get('/quantri/quanlyuser', 'App\Http\Controllers\QLUserController@getComment')->name('quanlyuser')->middleware('auth');
Route::post('/quantri/quanlyuser', 'App\Http\Controllers\QLUserController@writeComment')->middleware('auth');
Route::get('/quantri/quanlysinhvien', 'App\Http\Controllers\QLSinhVienController@quanlysinhvien')->name('quanlysinhvien')->middleware('auth');
Route::post('/quantri/quanlysinhvien', 'App\Http\Controllers\QLSinhVienController@writeUpdate')->middleware('auth');

Route::get('/quantri/quanlybaitap', 'App\Http\Controllers\QLBaiTapController@quanlybaitap')->name('quanlybaitap')->middleware('auth');
Route::post('/quantri/quanlybaitap', 'App\Http\Controllers\QLBaiTapController@nopbaitap')->name('quanlybaitap')->middleware('auth');
Route::get('/quantri/editinfo', 'App\Http\Controllers\QLUserController@editinfo')->middleware('auth');
Route::post('/quantri/editinfo', 'App\Http\Controllers\QLUserController@updateinfo')->middleware('auth');
Route::get('/quantri/comment', 'App\Http\Controllers\CommentController@getCommentForMe')->middleware('auth');
//Route::post('/quantri/editinfo', 'App\Http\Controllers\QLUserController@updateinfo')->middleware('auth');
Route::get('/quantri/quanlychallenge', 'App\Http\Controllers\QLChallengeController@allchallenge')->middleware('auth');
Route::post('/quantri/quanlychallenge', 'App\Http\Controllers\QLChallengeController@postChallenge')->middleware('auth');
