<?php
/**
 * Created by PhpStorm.
 * User: diwuh
 * Date: 2018/9/18
 * Time: 15:43
 * 公用函数
 */
if (!function_exists('route_class')){
    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }
}