<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    //Function lấy danh sách
    public function getAllProducts(): \Illuminate\Support\Collection
    {
        //Query builder lấy toàn bộ dữ liệu
        $products = DB::table('products')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'product_types.product_type_name AS product_type_name', 'brands.brand_name AS brand_name')
            ->get();
        return $products;
    }

    //Function lưu dữ liệu
    public function createProduct(): void
    {
        //query builder lưu dữ liệu
        DB::table("products")->insert([
            'product_name' => $this->name,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'brand_id' => $this->brand_id,
            'product_type_id' => $this->product_type_id
        ]);
    }

    //function update dữ liệu
    public function updateproduct(): void
    {
        //query builder update dữ liệu
        DB::table('products')
            ->where('id', $this->id)
            ->update([
                'product_name' => $this->product_name,
                'price' => $this->price,
                'stock_quantity' => $this->stock_quantity,
                'brand_id' => $this->brand_id,
                'product_type_id' => $this->product_type_id
            ]);
    }

    //Function xóa dữ liệu
    public function deleteProduct(): void
    {
        //query builder xóa dữ liệu
        DB::table("products")
            ->where('id', $this->id)
            ->delete();
    }
}
