<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Cache;
use Illuminate\Support\Str;
use Request;

class EmailVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *获取通知的传递通道
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *获得通知的邮件表示
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     * 发送邮件时会调用此方法来构建邮件内容，参数就是 App\Models\User 对象
     */
    public function toMail($notifiable)
    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
        // 使用 Laravel 内置的 Str 类生成随机字符串的函数，参数就是要生成的字符串长度
        $token = Str::random(16);
        Cache::set('email_verification_' . $notifiable->email, $token, 30);
        $url = route('email_verification.verify', ['email' => $notifiable->email, 'token' => $token]);
        return (new MailMessage)
            ->greeting($notifiable->name . "您好:")
            ->subject('注册成功，请验证你的邮箱')
            ->line('请点击下方链接验证你的邮箱')
            ->action('验证', $url);
    }

    /**
     * Get the array representation of the notification.
     *获取通知的数组表示
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
