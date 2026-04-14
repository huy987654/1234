<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
            //Tao đối tượng của model
            $objStaff = new Staff();
            //Gọi đến function để lấy dữ liệu trong model
            $staffs = $objStaff->index();
            //Gui len view
            return view('staffs.index', [
                'staffs' => $staffs
            ]);
    }
    public function login()
    {
        return view('staffs.index');
    }
    public function loginProcess(Request $request)
   {
       if(Auth::guard('staff')->attempt($request->only('email', 'password'))){
           $request->session()->regenerate();
            return Redirect::route('brands.index');
        } else {
            return Redirect::back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
            return view('staffs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        //
        //Tạo đối tượng model
        $obj = new Staff();
        //Lấy dữ liệu từ form
        $obj->name = $request->name;
        //Gọi function lưu dữ liệu trong model
        $obj->createStaff();
        //Quay về danh sách
        return Redirect::route('staffs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //gọi view hiển thị form sửa
        return view('staffs.edit', [
            'staff' => $staff
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        //
        //Lấy dữ liệu từ form
        $staff->name = $request->name;
        //Gọi function lưu dữ liệu trong model
        $staff->updateStaff();
        //Quay về danh sách
        return Redirect::route('staffs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
        //Gọi function xóa dữ bản ghi trong model
        $staff->deleteStaff();
        //Quay về danh sách
        return Redirect::route('staffs.index');
    }
}
