<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
//后台登录
Route::domain('admin.laravel.com')->group(function(){
//商品添加路由
// Route::prefix("/brand")->middleware("islogin")->group(function(){
Route::prefix("/brand")->middleware("auth")->group(function(){
	Route::get("index","Admin\BrandController@index");
	Route::get("create","Admin\BrandController@create");
	Route::post("store","Admin\BrandController@store")->name("brandstore");
	Route::get("destroy/{id}","Admin\BrandController@destroy");
	Route::get("edit/{id}","Admin\BrandController@edit");
	Route::post("update/{id}","Admin\BrandController@update")->name("brandupdate");
});

//商品分类
Route::prefix("/cate")->middleware("auth")->group(function(){
	Route::get("category","Admin\CateController@create");
	Route::post("store","Admin\CateController@store");
	Route::get("index","Admin\CateController@index");
	Route::get("destroy/{id}","Admin\CateController@destroy");
	Route::get("edit/{id}","Admin\CateController@edit");
	Route::post("update/{id}","Admin\CateController@update");
});
//商品管理
Route::prefix("/goods")->middleware("auth")->group(function(){
	Route::match(["get","post"],"/","Admin\GoodsController@create");
	Route::post("store","Admin\GoodsController@store")->name("goodsstore");
	Route::any("index","Admin\GoodsController@index");
	Route::get("destroy/{id}","Admin\GoodsController@destroy");
	Route::get("edit/{id}","Admin\GoodsController@edit");
	Route::post("update/{id}","Admin\GoodsController@update")->name("goodsupdate");
});
//商品管理
Route::prefix("/admin")->middleware("auth")->group(function(){
	Route::get("/","Admin\Goods_Admin@create");
	Route::post("store","Admin\Goods_Admin@store");
	Route::get("index","Admin\Goods_Admin@index");
	Route::get("destroy/{id}","Admin\Goods_Admin@destroy");
	Route::get("edit/{id}","Admin\Goods_Admin@edit");
	Route::post("update/{id}","Admin\Goods_Admin@update");
});
//友情链接
Route::prefix("/area")->middleware("auth")->group(function(){
	Route::get("/","Admin\AreaController@create");
	Route::post("store","Admin\AreaController@store")->name("store");
	Route::get("index","Admin\AreaController@index");
	Route::get("destroy/{id}","Admin\AreaController@destroy");
	Route::get("edit/{id}","Admin\AreaController@edit");
	Route::post("update/{id}","Admin\AreaController@update")->name("update");
});
//后台登录
Route::view("/login","Admin.login");
// Route::any("/login","Admin\LoginController@index");
Route::post("Lofindo","Admin\LoginController@login");
//模板登录
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

});

//前台登录
Route::domain('www.laravel.com')->group(function(){
	//项目的前台模板
	//登录成功要到的页面
	Route::get("/","Index\IndexController@index")->name("shop_index");
	//登录方法
	Route::get("/login","Index\LoginController@Login");
	//注册方法
	Route::get("/reg","Index\LoginController@Reg");
	Route::post("/sendSms","Index\LoginController@sendSms");
	Route::any("/sendEmail","Index\LoginController@sendEmail");
	Route::any("/senKed","Index\LoginController@senKed");
	Route::any("/senDex","Index\LoginController@senDex");
	Route::any("/admin","Index\LoginController@admin");
	Route::any("/user","Index\LoginController@user");
	//所有商品
	Route::any("/getprolist","Index\IndexController@getprolist");
	//商品详情
	Route::any("/List/{id}","Index\IndexController@goodsList")->name("shop_goods");
	//我的
	Route::any("/getuser","Index\LoginController@getuser");
	//购物车
	Route::any("/CatrController","Index\CatrController@CatrController")->name("catrList");
	//修改购物车的方法
	Route::any("/update","Index\CatrController@update");
	//确认购物车订单方法
	Route::any("/confirmorder{id?}","Index\CatrController@confirmorder");
	//添加收货地址方法
	Route::any("/address/{id?}","Index\AddressController@address");
	Route::any("/addlist","Index\AddressController@addlist");
	Route::any("/ress","Index\AddressController@ress");
	Route::any("/adddesc","Index\AddressController@adddesc");
	//订单方法
	Route::any("/seccess","Index\AddressController@seccess");
	//添加购物车的数据
	Route::any("/getcatr","Index\IndexController@getcatr");
	// goods
	Route::get("index","IndexController@ches");
});
//测试方法
// Route::get("index","IndexController@Cookie");
// Route::get("getCookie","IndexController@getCookie");
//闭包路由
// Route::get('/aa', function () {
//     return "你好 杨文龙";
// });
//必填参数
// Route::get('/show/{id?}', function ($id=1) {
//     return $id;
// });
//走控制器方法的路由
// Route::get("/index","IndexController@index");
// // Route::view("/index","yang",["name"=>"jdhkl"]);
// Route::post("/doadd","IndexController@doadd");
// //必填参数
// Route::get("/show/{id}/{name}","IndexController@show");
// //可选参数
// Route::get("/show/{id?}/{name?}","IndexController@show")->where(["id"=>"\d+","name"=>"[\x{4e00}-\x{9fa5}]+"]);

