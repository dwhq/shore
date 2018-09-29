<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalException;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\ProductSku;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\CloseOrder;
use DB;

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
    public function show(Order $order,Request $request)
    {
        //权限
        $this->authorize('own', $order);
        //load在模型上的热切加载关系
        return view('orders.show',['order'=>$order->load(['items.productSku', 'items.product'])]);
    }

    /**
     * @param OrderRequest $request
     * @return mixed
     * @throws InternalException
     * 添加订单
     */
    public function store(OrderRequest $request)
    {
        $user = $request->user();
        //开启一个数据库事物
        try {
            $order = DB::transaction(function () use ($user, $request) {
                $address = UserAddress::find($request->input('address_id'));
                //更新此地址的最后使用时间
                $address->update(['last_user_at' => Carbon::now()]);
                //创建一个订单
                $order = new Order([
                    'address' => [
                        // 将地址信息放入订单中
                        'address' => $address->full_address,
                        'zip' => $address->zip,
                        'contact_name' => $address->contact_name,
                        'contact_phone' => $address->contact_phone,
                    ],
                    'remark' => $request->input('remark'),
                    'total_amount' => 0,
                ]);
                //订单关联到当前用户
                /**
                 * 将模型实例与给定的母公司相关联
                 * associate 将$order实例关联到user()实例
                 */
                $order->user()->associate($user);
                //写入数据库
                $order->save();
                $totalAmount = 0;
                $items = $request->input('items');
                //遍历用户提交的sku
                foreach ($items as $data) {
                    $sku = ProductSku::find($data['sku_id']);
                    // 创建一个 OrderItem 并直接与当前订单关联
                    $item = $order->items()->make([
                        'amount' => $data['amount'],
                        'price' => $sku->price,
                    ]);
                    $item->product()->associate($sku->product_id);
                    $item->productSku()->associate($sku);
                    $item->save();
                    $totalAmount += $sku->price * $data['amount'];
                    if ($sku->decreaseStock($data['amount']) <= 0) {
                        throw new InternalException('该商品库存不足');
                    }
                }
                //更新订单总额
                $order->update(['total_amount' => $totalAmount]);
                //将下单的商品从购物车移除
                $skuIds = collect($request->input('items'))->pluck('sku_id');
                $user->cartItems()->whereIn('product_sku_id', $skuIds)->delete();
                return $order;
            });
            //Dispatch a job to its appropriate handler
            $this->dispatch(new CloseOrder($order, config('app.order_ttl')));
            return $order;
        } catch (\Throwable $e) {
            throw new InternalException($e);
        }

    }
}
