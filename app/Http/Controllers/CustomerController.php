<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Redirect;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Tạo đối tượng của model
        $objCustomer = new Customer();
        //Gọi đến function để lấy dữ liệu trong model
        $customers = $objCustomer->index();
        //Gui len view
        return view('customers.index', [
            'customers' => $customers
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
