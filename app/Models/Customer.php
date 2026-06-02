<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable
{
    protected $fillable = ['customer_name', 'phone', 'email', 'password'];
    protected $hidden = ['password'];
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
