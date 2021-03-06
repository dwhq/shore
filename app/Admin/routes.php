<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('users', 'UsersController@index');
    $router->get('products', 'ProductsController@index');
    $router->get('products/{id}/edit','ProductsController@edit');
    $router->put('products/{id}', 'ProductsController@update');
    //添加商品页面
    $router->get('products/create', 'ProductsController@create');
    //添加商品提交
    $router->post('products', 'ProductsController@store');
    //订单列表
    $router->get('orders', 'OrdersController@index')->name('admin.orders.index');
    //订单详情
    $router->get('orders/{order}', 'OrdersController@show')->name('admin.orders.show');
    //订单发货
    $router->post('orders/{order}/ship', 'OrdersController@ship')->name('admin.orders.ship');
    //处理退款
    $router->post('orders/{order}/refund', 'OrdersController@handleRefund')->name('admin.orders.handle_refund');
    //优惠券
    $router->get('coupon_codes', 'CouponCodesController@index');
    //添加优惠券
    $router->post('coupon_codes', 'CouponCodesController@store');
    $router->get('coupon_codes/create', 'CouponCodesController@create');
    //修改优惠券
    $router->get('coupon_codes/{id}/edit', 'CouponCodesController@edit');
    $router->put('coupon_codes/{id}', 'CouponCodesController@update');
    //删除优惠券
    $router->delete('coupon_codes/{id}', 'CouponCodesController@destroy');
});
