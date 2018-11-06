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

//商家登录界面
Route::get('login','LoginController@create')->name('login');
//商家登录验证
Route::post('login','LoginController@store')->name('login');
//退出登录
Route::get('logout','LoginController@destroy')->name('logout');
//后台首页
Route::get('index','LoginController@index')->name('index');

//资源路由-商家注册、修改、获取已登录用户的信息
Route::resource('users','UserController');
//保存商家密码修改
Route::post('users/savepwd','UserController@savepwd')->name('users.savepwd');

//资源路由-菜品分类
Route::resource('menucategories','MenuCategoryController');
//资源路由-菜品
Route::resource('menus','MenuController');
//按搜索条件显示菜品
Route::get('search','MenuController@search')->name('search');
//按价格区间显示菜品
//Route::post('price','MenuController@price')->name('price');

//进行中的活动
Route::get('conduct','MenuController@conduct')->name('conduct');
//活动详情
Route::get('details/{activity}','MenuController@details')->name('details');

//订单列表
Route::get('orders','OrderController@index')->name('orders');
//取消订单
Route::get('order/cancel/{order}','OrderController@cancel')->name('order.cancel');
//发货
Route::get('order/delivery/{order}','OrderController@delivery')->name('order.delivery');
//订单详情
Route::get('order/details/{order}','OrderController@details')->name('order.details');
//订单量统计
Route::get('statistics','OrderController@statistics')->name('statistics');
//菜品销量统计
Route::get('sales_volume','OrderController@sales_volume')->name('sales_volume');




//Route::get('login','LoginController@login')->name('login');
////商家注册界面
//Route::get('register','LoginController@register')->name('register');
////商家首页
//Route::get('index','LoginController@index')->name('index');


