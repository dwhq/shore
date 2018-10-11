<?php

namespace App\Http\Controllers;

use App\Events\OrderReviewed;
use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\ProductSku;
use App\Models\UserAddress;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\SendReviewRequest;

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

    /**
     * @param Order $order
     * @param Request $request
     * @return Order
     * @throws InvalidRequestException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * 确认收货
     */
    public function received(Order $order,Request $request)
    {
        // 校验权限
        $this->authorize('own',$order);
        if ($order->ship_status !== Order::SHIP_STATUS_DELIVERED){
            throw new InvalidRequestException("发货状态不正确");
        }
        // 更新发货状态为已收到
        $order->update(['ship_status' =>Order::SHIP_STATUS_RECEIVED]);
        //返回原页面
        return $order;
    }
    public function review(Order $order)
    {
        //权限
        $this->authorize('own',$order);
        //判断订单是否支付
        if (!$order->paid_at){
            throw new InvalidRequestException('该订单未支付，不可评价');
        }
        // 使用 load 方法加载关联数据，避免 N + 1 性能问题
        return view('orders.review', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }
    public function sendReview(Order $order,SendReviewRequest $request)
    {
        // 校验权限
        $this->authorize('own', $order);
        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单未支付，不可评价');
        }
        // 判断是否已经评价
        if ($order->reviewed) {
            throw new InvalidRequestException('该订单已评价，不可重复提交');
        }
        $reviews = $request->input('reviews');
            \DB::transaction(function () use ($reviews, $order) {
                // 遍历用户提交的数据
                foreach ($reviews as $review) {
                    $orderItem = $order->items()->find($review['id']);
                    // 保存评分和评价
                    $orderItem->update([
                        'rating' => $review['rating'],
                        'review' => $review['review'],
                        'reviewed_at' => Carbon::now(),
                    ]);
                }
                //将订单标记为已评价订单
                $order->update(['review' => true]);
                event(new OrderReviewed($order));
            });
        return redirect()->back();
    }
}
