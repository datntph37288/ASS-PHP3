<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $dates = ['ngay_nhap'];

    // cách 1 : Sử dụng quyery Builer
    public static function getAll()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('products.id', 'DESC')
            ->get();

        return $products;
    }

    // sử lý thêm sản phẩm

    public static function createProduct($data)
    {
        DB::table('products')->insert([
            'name' => $data['name'],
            'hinh_anh' => $data['hinh_anh'],
            'so_luong' => $data['so_luong'],
            'price' => $data['price'],
            'ngay_nhap' => $data['ngay_nhap'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
        ]);
        //  DB::table('products')->insert($data);
    }

    public static function updateProduct($data, $id)
    {
        DB::table('products')
            ->where('id', $id)
            ->update($data);
    }

    // Phương thức để lấy sản phẩm cùng loại
    public function getRelatedProducts($limit = 4)
    {
        return Product::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->take($limit)
            ->get();
    }
}
