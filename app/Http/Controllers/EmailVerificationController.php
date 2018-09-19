<?php

namespace App\Http\Controllers;

use App\Models\User;
use Cache;
use Illuminate\Http\Request;
use Exception;
use App\Notifications\EmailVerificationNotification;
use Mail;
//验证邮箱
class EmailVerificationController extends Controller
{
    //
    public function verify(Request $request)
    {
        //获email 和token 参数
        $email = $request->input('email');
        $token = $request->input('token');
        if (!($email && $token)) {
            // 如果有一个为空说明不是一个合法的验证链接，直接抛出异常。
            throw new Exception('验证链接不正确');
        }
        // 从缓存中读取数据，我们把从 url 中获取的 `token` 与缓存中的值做对比
        // 如果缓存不存在或者返回的值与 url 中的 `token` 不一致就抛出异常。
        if ($token != Cache::get('email_verification_' . $email)) {
            throw new Exception('验证链接不正确或已过期');
        }
        // 根据邮箱从数据库中获取对应的用户
        // 通常来说能通过 token 校验的情况下不可能出现用户不存在
        // 但是为了代码的健壮性我们还是需要做这个判断
        $user = User::where('email', $email)->first();
        if (!$user) {
            throw new Exception('用户不存在');
        }
        // 将指定的 key 从缓存中删除，由于已经完成了验证，这个缓存就没有必要继续保留。\
        Cache::forget('email_verification_' . $email);
        //更改数据库用户验证状态
        $user->update(['email_verified' => true]);
        return view('pages.success', ['msg' => '验证成功']);
    }

    public function send(Request $request){
        $user = $request->user();
        if ($user->email_verified){
            throw new Exception('您已经验证成功了');
        }
        // 调用 notify() 方法用来发送我们定义好的通知类
        $user->notify(new EmailVerificationNotification());
        return view('pages.success', ['msg' => '邮件发送成功']);
    }
}
