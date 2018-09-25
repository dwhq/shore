<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->email_verified){
            if ($request->expectsJson()){
                //从应用程序中返回一个新的响应
                //从应用程序返回一个新的JSON响应
                return response()->json(['msg'=>'请先验证邮箱',400]);
            }
            //生成到指定路由的URL
            return redirect(url('email_verify_notice'));
        }
        return $next($request);
    }
}
