<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Order;
use App\Http\Requests\Administrator\OrderRequest;
use App\Models\User;

class OrderController extends Controller
{
    protected $storageDisk;

    public function __construct()
    {
        $this->storageDisk = config('image.storage.global');
    }

    public function index()
    {
        $subSequence = ['id' => 0, 'title' => 'همه ی رکوردها'];
        $orders = Order::orderByPagination();

        return view('v1.admin.pages.order.index', compact('orders', 'subSequence'));
    }

    public function userOrders(User $user)
    {
        $subSequence = ['id' => 0, 'title' => 'همه ی رکوردها'];
        $orders = $user->orders()->orderByPagination();

        return view('v1.admin.pages.order.index', compact('orders', 'subSequence'));
    }

    public function show(Order $order)
    {

        return view('v1.admin.pages.order.show', compact('order'));
    }

    public function edit(Order $order)
    {

        return view('v1.admin.pages.order.edit', compact('order'));
    }

    public function update(OrderRequest $request, Order $order)
    {
        try {

            $count = $request->input('count');
            $price = $count * $order->product->rate;

            $order->update([
                'link'  => $request->input('link'),
                'count' => $count,
                'price' => $price,
            ]);

            session()->flash('notifications', [
                'message'    => 'رکورد مورد نظر با موفقیت ویرایش شد',
                'alert_type' => 'success',
            ]);

            return redirect()->route('admin.order.show', $order->id);
        } catch (\Exception $e) {
            session()->flash('notifications', [
                'message'    => $e->getMessage() . 'خطا در انجام عملیات',
                'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }

    public function doDelete(Order $order)
    {

        try {

            $price = $order->price;
            $status = $order->payed;
            $user = $order->user;
            $order->delete();

            if ($status) {
                $user->update([
                    "balance" => $user->balance + $price,
                ]);
            }

            session()->flash('notifications', [
                'message'    => 'رکورد مورد نظر  با موفقیت بروزرسانی شد',
                'alert_type' => 'success',
            ]);

            return redirect()->route('admin.order.index');
        } catch (\Exception $e) {
            session()->flash('notifications', [
                'message'    => $e->getMessage() . 'خطا در انجام عملیات',
                'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }


}
