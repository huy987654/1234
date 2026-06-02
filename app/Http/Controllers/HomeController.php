<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim($request->get('q', ''));

        $products = DB::table('products')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->select(
                'products.*',
                'product_types.product_type_name',
                'brands.brand_name',
                DB::raw('MIN(CAST(product_variants.pv_price AS UNSIGNED)) as min_variant_price')
            )
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($subQuery) use ($keyword) {
                    $subQuery
                        ->where('products.product_name', 'like', '%' . $keyword . '%')
                        ->orWhere('brands.brand_name', 'like', '%' . $keyword . '%')
                        ->orWhere('product_types.product_type_name', 'like', '%' . $keyword . '%');
                });
            })
            ->groupBy(
                'products.id',
                'products.product_name',
                'products.image',
                'products.price',
                'products.stock_quantity',
                'products.product_type_id',
                'products.brand_id',
                'product_types.product_type_name',
                'brands.brand_name'
            )
            ->orderBy('products.id', 'desc')
            ->get();

        $brands = DB::table('brands')->orderBy('brand_name')->get();
        $productTypes = DB::table('product_types')->orderBy('product_type_name')->get();

        return view('shop.home', [
            'products' => $products,
            'brands' => $brands,
            'productTypes' => $productTypes,
            'keyword' => $keyword
        ]);
    }

    public function showProduct(Product $product)
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

        return view('shop.product-show', [
            'product' => $productDetail ?? $product,
            'variants' => $variants
        ]);
    }
}
