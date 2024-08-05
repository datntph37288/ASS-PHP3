<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('clients.cart.index', compact('cart'));
    }

    public function update(Request $request)
    {
        $cart = Session::get('cart', []);
        $quantities = $request->input('quantities', []);

        foreach ($quantities as $id => $quantity) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;
            }
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        $cart = Session::get('cart', []);
        $id = $request->input('id');

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.index');
    }
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = \App\Models\Product::find($productId);

        if ($product) {
            $cart = Session::get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'image' => $product->hinh_anh
                ];
            }

            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
    }
}
