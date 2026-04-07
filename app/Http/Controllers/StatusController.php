<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use Illuminate\Support\Facades\Redirect;
class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //Tao đối tượng của model
        $objStatus = new Status();
        //Gọi đến function để lấy dữ liệu trong model
        $statuses = $objStatus->index();
        //Gui len view
        return view('statuses.index', [
            'statuses' => $statuses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request)
    {
        //
        //Tạo đối tượng model
        $obj = new Status();
        //Lấy dữ liệu từ form
        $obj->name = $request->name;
        //Gọi function lưu dữ liệu trong model
        $obj->createStatus();
        //Quay về danh sách
        return Redirect::route('statuses.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        //
        //gọi view hiển thị form update
        return view('statuses.edit', [
            'status' => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, Status $status)
    {
        //
        //Lấy dữ liệu
        $status->name = $request->name;
        //Gọi function lưu dữ liệu trong model
        $status->updateStatus();

        //Quay về danh sách
        return Redirect::route('statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        //
        $status->deleteStatus();
        //Quay về danh sách
        return Redirect::route('statuses.index');
    }
}
