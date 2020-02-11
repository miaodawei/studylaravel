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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', 'ErpUserController@test');

// 设计模式路由
Route::get('/composite', 'CompositeController@composite'); // 组合模式
Route::get('/strategy', 'StrategyController@strategy'); // 策略模式
Route::get('/decorator', 'DecoratorController@decorator'); // 装饰模式
Route::get('/proxy', 'ProxyController@proxy'); // 代理模式
Route::get('/handlerrequest', 'ChainOfREsponsibilitiesController@handlerRequest'); // 职责链模式
