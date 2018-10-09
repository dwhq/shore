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
});
