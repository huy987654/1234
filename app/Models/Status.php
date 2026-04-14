<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Status extends Model
{
    /** @use HasFactory<\Database\Factories\StatusFactory> */
    use HasFactory;
    //Function lấy dữ liệu từ database
    public function index(){
        $statuses = DB::table('statuses')->get();
        return $statuses;
    }
    //Function lưu dữ liệu vào database
    public function createStatus(){
        DB::table('statuses')->insert([
            'status_name' => $this->name
        ]);
    }
    //Function cập nhật dữ liệu vào database
    public function updateStatus()
    {
        //Cập nhật dữ liệu vào database
        DB::table('statuses')
            ->where('id',$this-> id)
            ->update([
                'status_name' => $this->name
            ]);
    }
     //Function xóa dữ liệu vào database
     public function deleteStatus(){
        DB::table('statuses')
            ->where('id', $this-> id)
            ->delete();
    }
}
