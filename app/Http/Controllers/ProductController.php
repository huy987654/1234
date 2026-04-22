<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductType;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Tạo đối tượng của model
        $obj = new Product();
        //Lấy dữ liệu từ DB: Gọi function trong model
        $products = $obj->getAllProducts();
        //Gọi view hiển thị danh sách
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Lấy brand, type để truyền sang view
        //Tạo đối tượng của brand
        $objBrand = new Brand();
        //Gọi function trong Brand model
        $brands = $objBrand->index();
        //Tạo đối tượng của type
        $objType = new ProductType();
        //Gọi function trong Type model
        $types = $objType->getAllProductTypes();
        return view('products.create', [
            'brands' => $brands,
            'product_types' => $types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //Tạo đối tượng của model
        $product = new Product();
        //Lấy dữ liệu từ form về
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->brand_id = $request->brand_id;
        $product->product_type_id = $request->prodct_type_id;
        //Gọi function lưu dữ liệu trong model
        $product->createProduct();
        //Quay về danh sách
        return Redirect::route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //Tạo đối tượng của brand
        $objBrand = new Brand();
        //Gọi function trong Brand model
        $brands = $objBrand->index();
        //Tạo đối tượng của type
        $objType = new ProductType();
        //Gọi function trong Type model
        $types = $objType->getAllProductTypes();
        //Gọi view edit
        return view('products.edit', [
            'product' => $product,
            'brands' => $brands,
            'product_types' => $types
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //Lấy dữ liệu trong form
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->brand_id = $request->brand_id;
        $product->type_id = $request->type_id;
        //Gọi function trong model
        $product->updateProduct();
        //Quay về danh sách
        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //Gọi function xóa trong model
        $product->deleteProduct();
        //Quay lại danh sách
        return Redirect::route('products.index');
    }
}
