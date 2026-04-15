<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    // Lấy danh sách tất cả customers
    public function index()
    {
        $customers = DB::table('customers')->get();
        //Trả về dữ liệu
        return $customers;
    }

    // Thêm mới customer
    public function createCustomer()
    {
        DB::table('customers')->insert([
            'customer_name'       => $this -> name,
            'email'      =>  $this-> email,
            'phone'      => $this-> phone,
            'password'    => $this-> password
        ]);
    }

    // Cập nhật customer
    public function updateCustomer()
    {
        DB::table('customers')
            ->where('id', $this-> id)
            ->update([
                'customer_name'       => $this-> name,
                'email'      => $this-> email,
                'phone'      => $this-> phone,
                'password'    => $this-> password

            ]);
    }

    // Xóa customer
    public function deleteCustomer()
    {
        DB::table('customers')
            ->where('id', $this-> id)
            ->delete();
    }
}

