<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }
    public function dashboard(){
        $products = $this->products->all();
        return view('clients.index', ['products' => $products]);
    }
}
