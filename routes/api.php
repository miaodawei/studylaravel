<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/process', 'TestController@testProcessWrite');
Route::any('/testco', 'TestController@testCo');

Route::middleware(['client'])->group(function () {
    Route::any('/test_passport_auth', 'TestController@testPassPortAuth');
    Route::any('/passport_auth', 'TestController@testPassPortAuth');
    Route::any('/test_user', 'TestController@testGetPassportUser');
});

Route::any('/testb', 'TestController@testBlock');
Route::any('/testc', 'TestController@testCoroutine');
Route::any('/testco', 'TestController@runCo');
Route::any('/testco2', 'TestController@runCo2');
Route::any('/daochu', 'FileController@reportExcel');
Route::any('/daochu2', 'FileController@reportExcel2');
Route::any('/daochu3', 'FileController@reportExcel3');
Route::any('/daochu4', 'FileController@reportExcel4');

