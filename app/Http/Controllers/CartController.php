<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $carts = Session::get('carts', []);

        return view('carts.index', [
            'carts' => $carts
        ]);
    }

    public function addToCart(ProductVariant $productVariant)
    {
        $variant = DB::table('product_variants')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->join('configurations', 'product_variants.configuration_id', '=', 'configurations.id')
            ->select(
                'product_variants.*',
                'products.product_name',
                'configurations.ram',
                'configurations.storage'
            )
            ->where('product_variants.id', $productVariant->id)
            ->first();

        if (!$variant) {
            return Redirect::route('shop.home');
        }

        $carts = Session::get('carts', []);

        if (isset($carts[$variant->id])) {
            $carts[$variant->id]['quantity']++;
        } else {
            $carts[$variant->id] = [
                'product_name' => $variant->product_name,
                'color' => $variant->pv_color,
                'ram' => $variant->ram,
                'storage' => $variant->storage,
                'price' => $variant->pv_price,
                'quantity' => 1,
            ];
        }

        Session::put('carts', $carts);

        return Redirect::route('carts.index');
    }

    public function updateCart(Request $request)
    {
        $carts = Session::get('carts', []);
        $productQuantity = $request->updateQuantity ?? [];

        foreach ($productQuantity as $id => $quantity) {
            if (isset($carts[$id])) {
                $carts[$id]['quantity'] = max(1, (int) $quantity);
            }
        }

        Session::put('carts', $carts);

        return Redirect::route('carts.index');
    }

    public function removeOneProduct(ProductVariant $productVariant)
    {
        $carts = Session::get('carts', []);

        if (isset($carts[$productVariant->id])) {
            unset($carts[$productVariant->id]);
            Session::put('carts', $carts);
        }

        return Redirect::route('carts.index');
    }

    public function deleteCart()
    {
        Session::forget('carts');

        return Redirect::route('carts.index');
    }

    public function plus(ProductVariant $productVariant)
    {
        $carts = Session::get('carts', []);

        if (isset($carts[$productVariant->id])) {
            $carts[$productVariant->id]['quantity']++;
            Session::put('carts', $carts);
        }

        return Redirect::route('carts.index');
    }

    public function minus(ProductVariant $productVariant)
    {
        $carts = Session::get('carts', []);

        if (isset($carts[$productVariant->id])) {
            $carts[$productVariant->id]['quantity']--;

            if ($carts[$productVariant->id]['quantity'] <= 0) {
                unset($carts[$productVariant->id]);
            }

            Session::put('carts', $carts);
        }

        return Redirect::route('carts.index');
    }
}
