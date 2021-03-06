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

//Route::get('/', 'PagesController@root')->name('root');
Route::redirect('/', '/products')->name('root');
//首页
Route::get('products', 'ProductsController@index')->name('products.index');
Auth::routes();
//创建具有共享属性的路由组
Route::prefix('/')->middleware('auth')->group(function () {
    //name 路由名称
    // 邮箱验证页面
    Route::get('email_verify_notice', 'PagesController@emailVerifyNotice');
    //发送通知
    Route::get('email_verification/verify', 'EmailVerificationController@verify')->name('email_verification.verify');
    //手动发送通知
    Route::get('email_verification/send', 'EmailVerificationController@send')->name('email_verification.send');
    //检测有没有验证
    Route::middleware('email_verified')->group(function () {
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
        //添加收藏
        Route::post('products/{product}/favorite','ProductsController@favor')->name('products.favor');
        //取消收藏
        Route::delete('products/{product}/favorite','ProductsController@disfavor')->name('products.disfavor');
        //收藏列表
        Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites');
        //添加购物车
        Route::post('cart', 'CartController@add')->name('cart.add');
        //购物车页面
        Route::get('cart', 'CartController@index')->name('cart.index');
        //购物车移出商品
        Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');
        //购物车提交到订单
        Route::post('orders', 'OrdersController@store')->name('orders.store');
        //订单列表
        Route::get('orders', 'OrdersController@index')->name('orders.index');
        //订单详情页面
        Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');
        //支付订单
        Route::get('payment/{order}/alipay', 'PaymentController@payByAlipay')->name('payment.alipay');
        //支付完成跳转
        Route::get('payment/alipay/return', 'PaymentController@alipayReturn')->name('payment.alipay.return');
        //确认收货
        Route::post('orders/{order}/received', 'OrdersController@received')->name('orders.received');
        //评价商品
        Route::get('orders/{order}/review', 'OrdersController@review')->name('orders.review.show');
        Route::post('orders/{order}/review', 'OrdersController@sendReview')->name('orders.review.store');
        //申请退款
        Route::post('orders/{order}/apply_refund', 'OrdersController@applyRefund')->name('orders.apply_refund');
        //检查优惠券
        Route::get('coupon_codes/{code}', 'CouponCodesController@show')->name('coupon_codes.show');
    });
});
//支付宝回调
Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify');
//商品详情页面
Route::get('products/{product}','ProductsController@show')->name('products.show');