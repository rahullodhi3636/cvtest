<?php

use Illuminate\Http\Request;
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
});

Route::post('/register', 'TripapiController@register');
Route::post('/login', 'TripapiController@login');
Route::get('/hotellist', 'TripapiController@hotellist');
Route::post('/booking', 'TripapiController@booking');
Route::get('/banquetlist', 'TripapiController@banquetlist');
Route::post('/getbookingsbyid', 'TripapiController@getbookingsbyid');
