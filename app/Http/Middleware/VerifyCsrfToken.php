<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *如果访问的 URL 能够匹配上 $except 里任意一项，Laravel 就不会去检查 CSRF Token。
     * @var array
     */
    protected $except = [
        'payment/alipay/notify',
    ];
}
