<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductVariantController extends Controller
{
    public function index(Product $product)
    {
        $variants = DB::table('product_variants')
            ->join('configurations', 'product_variants.configuration_id', '=', 'configurations.id')
            ->select(
                'product_variants.*',
                'configurations.ram',
                'configurations.storage',
                'configurations.cpu'
            )
            ->where('product_variants.product_id', $product->id)
            ->orderBy('product_variants.id', 'desc')
            ->get();

        return view('productvariants.index', [
            'product' => $product,
            'variants' => $variants
        ]);
    }

    public function create(Product $product)
    {
        return view('productvariants.create', [
            'product' => $product,
            'configurations' => DB::table('configurations')->orderBy('id', 'desc')->get()
        ]);
    }

    public function store(StoreProductVariantRequest $request, Product $product)
    {
        DB::table('product_variants')->insert([
            'pv_price' => $request->pv_price,
            'pv_color' => $request->pv_color,
            'pv_stock_qtt' => $request->pv_stock_qtt,
            'desc' => $request->desc,
            'product_id' => $product->id,
            'configuration_id' => $request->configuration_id,
        ]);

        return Redirect::route('productVariants.index', $product->id);
    }

    public function edit(Product $product, ProductVariant $productVariant)
    {
        return view('productvariants.edit', [
            'product' => $product,
            'variant' => $productVariant,
            'configurations' => DB::table('configurations')->orderBy('id', 'desc')->get()
        ]);
    }

    public function update(UpdateProductVariantRequest $request, Product $product, ProductVariant $productVariant)
    {
        DB::table('product_variants')
            ->where('id', $productVariant->id)
            ->update([
                'pv_price' => $request->pv_price,
                'pv_color' => $request->pv_color,
                'pv_stock_qtt' => $request->pv_stock_qtt,
                'desc' => $request->desc,
                'configuration_id' => $request->configuration_id,
            ]);

        return Redirect::route('productVariants.index', $product->id);
    }

    public function destroy(Product $product, ProductVariant $productVariant)
    {
        DB::table('product_variants')
            ->where('id', $productVariant->id)
            ->delete();

        return Redirect::route('productVariants.index', $product->id);
    }
}
