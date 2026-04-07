<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ProductType extends Model
{
    /** @use HasFactory<\Database\Factories\ProductTypeFactory> */
    use HasFactory;
//Fuction lấy dữ liệu
    public function index()
    {
        //Query builder để lấy dữ liệu từ database
        $productTypes = DB::table('product_types')->get();
        //Trả về dữ liệu
        return $productTypes;
    }
    //Function lưu dữ liệu
    public function createProductType()
    {
        //Lưu dữ liệu vào database
        DB::table('product_types')->insert([
            'product_type_name' => $this->name
        ]);
    }
    //Function cập nhật dữ liệu
    public function updateProductType()
    {
        //Cập nhật dữ liệu vào database
        DB::table('product_types')
            ->where('id',$this-> id)
            ->update([
            'product_type_name' => $this->name
        ]);
    }
    //Function xóa dữ liệu
    public function deleteProductType()
    {
        //Xóa dữ liệu vào database
        DB::table('product_types')
            ->where('id',$this-> id)
            ->delete();
    }
}
