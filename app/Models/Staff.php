<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Staff extends Model implements Authenticatable
{
    /** @use HasFactory<\Database\Factories\StaffFactory> */
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;

    protected $table = 'staffs';
    protected $guarded = [];
//Function lấy dữ liệu
    public function index()
    {
        $staffs = DB::table($this->table)->get();
        //Trả về dữ liệu
        return $staffs;
    }
    //Function lưu dữ liệu
    public function createStaff()
    {
        DB::table($this->table)->insert([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);
    }
    //Fuction update dữ liệu
    public function updateStaff($id)
    {
        DB::table($this->table)->where('id', $id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);
    }
    //Function delete dữ liệu
    public function deleteStaff($id)
    {
        DB::table($this->table)->where('id', $id)->delete();
    }
}

