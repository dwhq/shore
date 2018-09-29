<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Order $order
     * @return bool
     * 为了安全起见我们只允许订单的创建者可以看到对应的订单信息，这个需求可以通过授权策略类（Policy）来实现。
     * 通过 make:policy 命令创建一个授权策略类
     * 然后在 AuthServiceProvider 中注册这个策略：
     * app/Providers/AuthServiceProvider.php
     */
    public function own(User $user,Order $order)
    {
        return $order->user_id == $user->id;
    }
}
