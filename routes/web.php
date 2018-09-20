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

Route::get('/', 'PagesController@root')->name('root');

Auth::routes();
//创建具有共享属性的路由组
Route::prefix('/')->middleware('auth')->group(function (){
    //name 路由名称
    // 邮箱验证页面
    Route::get('email_verify_notice','PagesController@emailVerifyNotice');
    //发送通知
    Route::get('email_verification/verify', 'EmailVerificationController@verify')->name('email_verification.verify');
   //手动发送通知
    Route::get('email_verification/send', 'EmailVerificationController@send')->name('email_verification.send');
    //检测有没有验证
    Route::middleware('email_verified')->group( function() {
        //收货地址页面
        Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
        //添加收货地址页面
        Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
        //添加地址提交
        Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');
        //修改收货地址页面
        Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');
        //修改收货地址提交
        Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
        //删除地址
        Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');

    });
});