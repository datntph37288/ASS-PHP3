<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function index()
    {
        $products = $this->products->all();
        return view('clients.index', ['products' => $products]);
    }

    public function chiTietSP($id)
    {
        $products = $this->products->findOrFail($id);
        $relatedProducts = $products->getRelatedProducts();

        return view(
            'clients.product_detail',
            [
                'products' => $products,
                'relatedProducts' => $relatedProducts
            ]
        );
    }
}
