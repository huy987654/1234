<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;
    public function index()
    {
        // Query builder lấy dữ liệu từ bảng brands
        $brands = DB::table('brands')->get();

        // Trả dữ liệu về cho controller
        return $brands;
    }
    //Function lưu dữ liệu lên db
    public function createBrand(): void
    {
        //Query builder lưu dữ liệu lên db
        DB::table('brands')->insert([
            'brand_name' => $this->name
        ]);
    }

    //Function update dữ liệu trên db
    public function updateBrand(): void
    {
        //Query builder update dữ liệu
        DB::table('brands')
            ->where('id', $this->id)
            ->update([
                'brand_name' => $this->name
            ]);
    }

    //Function xóa dữ liệu trên db
    public function deleteBrand(): void
    {
        //query builder xóa dữ liệu
        DB::table('brands')
            ->where('id', $this->id)
            ->delete();
    }

}
