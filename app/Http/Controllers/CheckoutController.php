<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = array_sum(array_map(fn ($item) => $item['price'] * $item['quantity'], $cart));
        return view('clients.checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $orderItems = json_decode($request->input('order_items'), true);

        $total = $this->calculateOrderTotal($orderItems);

        $order = new Order();
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->payment_method = $request->input('payment_method');
        $order->total = $total;
        $order->status = 'pending';

        if (auth()->check()) {
            $order->user_id = auth()->id();
        }

        $order->save();

        $request->session()->forget('cart');

        return redirect('/')->with('success', 'Đơn hàng đã được đặt thành công!');
    }


    private function calculateOrderTotal($orderItems)
    {
        $total = 0;
        foreach ($orderItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
