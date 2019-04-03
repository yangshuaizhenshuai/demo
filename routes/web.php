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


//生成验证码
route::any('verify/create','CaptchaController@create');

Route::prefix('index')->group(function () {
    Route::any("indexshop","Index\IndexController@IndexShop");
    Route::any("shopcontent/{id}","Index\IndexController@IndexContent");
});

Route::any("index/indexshopcar","Index\IndexController@IndexShopCar")->Middleware('session');
Route::any("index/indexuser","Index\IndexController@IndexUser");
Route::any("index/indexshop/{id}","Index\IndexController@IndexShopId");
Route::any("index","Index\IndexController@Index");
Route::post("index/indexshopajax","Index\IndexController@IndexShopAjax");
Route::post("index/isnew","Index\IndexController@IsNew");
Route::post("index/price","Index\IndexController@Price");
Route::post("index/addcart","Index\IndexController@addcart");
Route::post("index/cartdel","Index\IndexController@cartdel");
Route::any("index/add","Index\IndexController@add");
Route::any("index/min","Index\IndexController@min");
Route::any("index/changenum","Index\IndexController@changenum");
Route::any("index/search","Index\IndexController@search");
Route::any("index/searchdo","Index\IndexController@searchdo");




Route::any("address/address","Index\AddressController@address")->Middleware('session');
Route::any("address/addressadd","Index\AddressController@addressadd");
Route::any("address/addressdo","Index\AddressController@addressdo");
Route::any("address/addressdel","Index\AddressController@addressdel");
Route::any("address/addressup/{id}","Index\AddressController@addressup");
Route::any("address/addressupdo","Index\AddressController@addressupdo");
Route::any("address/addressmoren","Index\AddressController@addressmoren");

Route::prefix('user')->group(function () {
    Route::any("user","Index\UserController@User");
    Route::any("login","Index\UserController@Login");
    Route::any("register","Index\UserController@Register");
    Route::any("registerdo","Index\UserController@Registerdo");
    Route::any("findpwd","Index\UserController@Findpwd");
    Route::any("resetpassword","Index\UserController@Resetpassword");
    Route::any("create","Index\UserController@create");
    Route::any("dlicode","Index\UserController@dlicode");
});
Route::any("user/logindo","Index\UserController@Logindo");
Route::any("index/recorddetail","Index\RecordController@recorddetail");
Route::any("index/buyrecord","Index\RecordController@buyrecord");
Route::any("index/del","Index\IndexController@del");

Route::prefix('pay')->group(function () {
    route::any('payment/{id}',"Pay\PayController@payment");
    route::any('pay',"Pay\PayController@pay");
});

Route::prefix('alipay')->group(function () {
    route::any('phonepay',"AlipayController@phonepay");
    route::any('return',"AlipayController@re");
    route::any('notify',"AlipayController@notify");
});

