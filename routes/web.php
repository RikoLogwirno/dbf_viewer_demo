<?php

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

use Illuminate\Http\Request;

Route::get('/login', function(Request $request) {
    if(!$request->session()->get('success'))
        return view("login");
    return redirect()->route('index');
})->name('login');

Route::post('/login', function(Request $request) {
    if($request->username == "admin" && $request->password == "admin1234") {
        $request->session()->put('success', 'true');
    }
    return redirect()->route('login');
})->name('post_login');

Route::get('/logout', function(Request $request) {
    $request->session()->forget('key');
    $request->session()->flush();
    return redirect()->route('login');
})->name('logout');

Route::get('/', 'DBFController')->name('index')->middleware('cek_session');
Route::get('/page/{offset}', 'DBFController')->name('page')->middleware('cek_session');
Route::post('/uploaddbffile/', 'DBFController@upload')->name('upload')->middleware('cek_session');
Route::get('/get_checksum/', 'DBFController@get_dbf_checksum')->name('get_checksum')->middleware('cek_session');
