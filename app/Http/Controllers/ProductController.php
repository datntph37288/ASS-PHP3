<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $products;
     public function __construct(){
        $this->products = new Product();
     }
     public function index()
     {
         $products = $this->products->getAll();
         return view('admins.products.index', ['products' => $products]);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('admins.products.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // xử lý ảnh
        if($request -> hasFile('hinh_anh')){
            // nếu có đẩy hình ảnh lên
            $fileName = $request->file('hinh_anh')->store('uploads/product' , 'public');
        }else{
            $fileName = null;
        }
        $dataInsert = [
            'name' => $request->name,
            'hinh_anh' => $fileName,
            'so_luong' => $request->so_luong,
            'price' => $request->price,
            'ngay_nhap' => $request->ngay_nhap,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ];
        // dd($dataInsert);
        $this->products->createProduct($dataInsert);

        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = $this->products->find($id);
        $categories = DB::table('categories')->get();

        if(!$products){
            return redirect()->route('product.index');

        }

        return view('admins.products.show' , compact('products' , 'categories' , ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // lấy sản phẩm
        $products = $this->products->find($id);
        $categories = DB::table('categories')->get();

        if(!$products){
            return redirect()->route('prduct.index');

        }

        return view('admins.products.edit' , compact('products' , 'categories' , ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // xử lý logic update
    //lấy lại thông tin sản phẩm
        $products = $this->products->find($id);

        // xử lý và lưu ảnh nếu có ảnh
    if($request->hasFile('hinh_anh')){
        if($products->hinh_anh){
            Storage::disk('public')->delete($products->hinh_anh);
        }

        // lưu ảnh mới
        $fileName = $request->file('hinh_anh')->store('uploads/product' , 'public');
    }else{
        $fileName = $products->hinh_anh;

    }
    $dataUpdate = [
        'name' => $request->name,
        'hinh_anh' => $fileName,
        'so_luong' => $request->so_luong,
        'price' => $request->price,
        'ngay_nhap' => $request->ngay_nhap,
        'description' => $request->description,
        'category_id' => $request->category_id,
    ];

    $products->updateProduct($dataUpdate , $id);

    return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // xử lý xóa sản phẩm
        $products = $this->products->find($id);
        if(!$products){
            return redirect()->route('prduct.index');
        }
        // xóa hình ảnh sản phẩm
        if($products->hinh_anh){
            Storage::disk('public')->delete($products->hinh_anh);
        }
        $products->delete();
        return redirect()->route('product.index');
    }
}
