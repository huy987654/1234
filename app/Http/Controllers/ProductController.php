<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductType;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyword = trim(request('q', ''));

        $products = DB::table('products')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'product_types.product_type_name AS product_type_name', 'brands.brand_name AS brand_name')
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($subQuery) use ($keyword) {
                    $subQuery
                        ->where('products.product_name', 'like', '%' . $keyword . '%')
                        ->orWhere('brands.brand_name', 'like', '%' . $keyword . '%')
                        ->orWhere('product_types.product_type_name', 'like', '%' . $keyword . '%');
                });
            })
            ->orderBy('products.id', 'desc')
            ->get();

        return view('products.index', [
            'products' => $products,
            'keyword' => $keyword
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
        $image = $request->file('image');
        if ($image != null) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $product->image = $imageName;

            if (!Storage::disk('public')->exists('Images/' . $imageName)) {
                Storage::disk('public')->putFileAs('Images', $image, $imageName);
            }
        }
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->brand_id = $request->brand_id;
        $product->product_type_id = $request->product_type_id;
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
        $productDetail = DB::table('products')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'product_types.product_type_name', 'brands.brand_name')
            ->where('products.id', $product->id)
            ->first();

        $variants = DB::table('product_variants')
            ->join('configurations', 'product_variants.configuration_id', '=', 'configurations.id')
            ->select(
                'product_variants.*',
                'configurations.cpu',
                'configurations.ram',
                'configurations.storage',
                'configurations.gpu',
                'configurations.screen',
                'configurations.os',
                'configurations.battery',
                'configurations.camera',
                'configurations.connect',
                'configurations.other_function'
            )
            ->where('product_variants.product_id', $product->id)
            ->get();

        return view('products.show', [
            'product' => $productDetail ?? $product,
            'variants' => $variants
        ]);
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
        $product->product_name = $request->product_name;
        $image = $request->file('image');
        if ($image != null) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $product->image = $imageName;

            if (!Storage::disk('public')->exists('Images/' . $imageName)) {
                Storage::disk('public')->putFileAs('Images', $image, $imageName);
            }
        }
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->brand_id = $request->brand_id;
        $product->product_type_id = $request->product_type_id;
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
