<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use Illuminate\Support\Facades\Redirect;
class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //Tao đối tượng của model
        $objProductType = new ProductType();
        //Gọi đến function để lấy dữ liệu trong model
        $productTypes = $objProductType->index();
        //Gui len view
        return view('productTypes.index', [
            'productTypes' => $productTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('productTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductTypeRequest $request)
    {
        //
        //Tạo đối tượng model
        $obj = new ProductType();
        //Lấy dữ liệu từ form
        $obj->name = $request->name;
        //Gọi function lưu dữ liệu trong model
        $obj->createProductType();
        //Quay về danh sách
        return Redirect::route('productTypes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductType $productType)
    {
        //
        //Gọi view hiển thị form chỉnh sửa
        return view('productTypes.edit', [
            'productType' => $productType
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductTypeRequest $request, ProductType $productType)
    {
        //
        //Lấy dữ liệu từ form
        $productType->name = $request->name;
        //Gọi function lưu dữ liệu trong model
        $productType->updateProductType();
        //Quay về danh sách
        return Redirect::route('productTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductType $productType)
    {
        //
        //Gọi function xóa dữ liệu trong model
        $productType->deleteProductType();
        //Quay về danh sách
        return Redirect::route('productTypes.index');
    }
}
