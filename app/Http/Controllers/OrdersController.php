<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalException;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\ProductSku;
use App\Models\UserAddress;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\CloseOrder;
use DB;
use App\Services\CartService;

class OrdersController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 用户订单列表
     */
    public function index(Request $request)
    {
        $orders = Order::query()
            // 设置应该被加载的关系
            ->with(['items.product', 'items.productSku'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * @param Order $order
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 订单相求页面
     */
    public function show(Order $order, Request $request)
    {
        //权限
        $this->authorize('own', $order);
        //load在模型上的热切加载关系
        return view('orders.show', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }

    /**
     * @param OrderRequest $request
     * @return mixed
     * @throws InternalException
     * 添加订单
     * 利用 Laravel 的自动解析功能注入 CartService 类
     */
    public function store(OrderRequest $request, OrderService $orderService)
    {
        $user = $request->user();

        $address = UserAddress::find($request->input('address_id'));

        return $orderService->store($user, $address, $request->input('remark'), $request->input('items'));

    }
}
