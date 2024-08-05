<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->delete();
            return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xóa.');
        }

        return redirect()->route('orders.index')->with('error', 'Không tìm thấy đơn hàng.');
    }
}
