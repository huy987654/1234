<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;
//Fuction lấy dữ liệu
    public function index()
    {
        //Query builder để lấy dữ liệu từ database
        $payments = DB::table('payments')->get();
        //Trả về dữ liệu
        return $payments;
    }
    //Function lưu dữ liệu
    public function createPayment()
    {
        //Lưu dữ liệu vào database
        DB::table('payments')->insert([
            'name' => $this->name
        ]);
    }
    //Function cập nhật dữ liệu
    public function updatePayment()
    {
        //Cập nhật dữ liệu vào database
        DB::table('payments')
            ->where('id',$this-> id)
            ->update([
            'name' => $this->name
        ]);
    }
    //Function xóa dữ liệu
    public function deletePayment()
    {
        //Xóa dữ liệu vào database
        DB::table('payments')
            ->where('id',$this-> id)
            ->delete();
    }
}
