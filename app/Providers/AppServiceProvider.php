<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //这是由于Laravel 默认使用 utf8mb4 字符， 包括支持在数据库存储「 表情」 。 如果你正在运行的 MySQL release 版本低于5.7.7 或 MariaDB release
        //版本低于10.2.2 ， 为了MySQL为它们创建索引， 你可能需要手动配置迁移生成的默认字符串长度， 你可以通过调用 AppServiceProvider 中的
        //Schema::defaultStringLength 方法来配置它：\
       Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
