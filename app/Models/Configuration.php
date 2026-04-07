<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Configuration extends Model
{
    /** @use HasFactory<\Database\Factories\ConfigurationFactory> */
    use HasFactory;
    //Fuction lấy dữ liệu
    public function index()
    {
        //Lấy dữ liệu từ database
        $configurations = DB::table('configurations')->get();
        return $configurations;
    }
    //Function lưu dữ liệu
    public function createConfiguration()
    {
        //Lưu dữ liệu vào database
        DB::table('configurations')->insert([
            'name' => $this->name
        ]);
    }
    //Function cập nhật dữ liệu
    public function updateConfiguration()
    {
        //Cập nhật dữ liệu vào database
        DB::table('configurations')
            ->where('id',$this-> id)
            ->update([
            'name' => $this->name
        ]);
    }
    //Function xóa dữ liệu
    public function deleteConfiguration()
    {
        //Xóa dữ liệu vào database
        DB::table('configurations')
            ->where('id',$this-> id)
            ->delete();
    }
}
