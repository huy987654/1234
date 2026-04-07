<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Http\Requests\StoreConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use Illuminate\Support\Facades\Redirect;
class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Tao đối tượng của model
$objConfiguration = new Configuration();
//Gọi đến function để lấy dữ liệu trong model
$configurations = $objConfiguration->index();
//Gui len view
return view('configurations.index', [
    'configurations' => $configurations
]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('configurations.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConfigurationRequest $request)
    {
        //Tạo đối tượng model
        $obj = new Configuration();
        //Lấy dữ liệu từ form
        $obj->name = $request->name;

        //Gọi function lưu dữ liệu trong model
        $obj->createConfiguration();
        //Quay về danh sách
        return Redirect::route('configurations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Configuration $configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Configuration $configuration)
    {
        //Gọi view hiển thị form update
        return view('configurations.edit', [
            'configuration' => $configuration
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConfigurationRequest $request, Configuration $configuration)
    {
        //Lấy dữ liệu
        $configuration->name = $request->name;
        //Gọi function để update dữ liệu trong model
        $configuration->updateConfiguration();
        //Quay về danh sách
        return Redirect::route('configurations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configuration $configuration)
    {
        //Gọi function để xóa ban ghi trong model
        $configuration->deleteConfiguration();
        //Quay về danh sách
        return Redirect::route('configurations.index');
    }
}
