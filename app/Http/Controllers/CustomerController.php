<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyword = trim(request('q', ''));
        $customers = DB::table('customers')
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($subQuery) use ($keyword) {
                    $subQuery
                        ->where('customer_name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%')
                        ->orWhere('phone', 'like', '%' . $keyword . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('customers.index', [
            'customers' => $customers,
            'keyword' => $keyword
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
        //Tạo đối tượng model
        $obj = new Customer();
        //Lấy dữ liệu từ form
        $obj->name = $request->name;
        $obj->email    = $request->email;
        $obj->phone    = $request->phone;
        $obj->password = $request->password;
        //Gọi function lưu dữ liệu trong model
        $obj->createCustomer();
        //Quay về danh sách
        return Redirect::route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
        //Gọi view hiển thị form update
        return view('customers.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
        //Lấy dữ liệu từ form
        $customer->name = $request->name;
        //Gọi function update dữ liệu trong model
        $customer->updateCustomer();
        //Quay về danh sách
        return Redirect::route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
        //Gọi function xóa bản ghi trong db
        $customer->deleteCustomer();
        //Quay về danh sách
        return Redirect::route('customers.index');
    }
}
