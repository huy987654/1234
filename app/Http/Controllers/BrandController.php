<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
             $keyword = trim(request('q', ''));
             $brands = DB::table('brands')
                 ->when($keyword !== '', function ($query) use ($keyword) {
                     $query->where('brand_name', 'like', '%' . $keyword . '%');
                 })
                 ->orderBy('id', 'desc')
                 ->get();

             return view('brands.index', [
                 'brands' => $brands,
                 'keyword' => $keyword
             ]);
     }

     /**
      * Show the form for creating a new resource.
      */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        //Tạo đối tượng model
        $obj = new Brand();
        //Lấy dữ liệu từ form
        $obj->name = $request->name;
        //Gọi function lưu dữ liệu trong model
        $obj->createBrand();
        //Quay về danh sách
        return Redirect::route('brands.index')->with('success', 'Brand added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //Gọi view hiển thị form update
        return view('brands.edit', [
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        //Lấy dữ liệu
        $brand->name = $request->name;
        //Gọi function để update dữ liệu trong model
        $brand->updateBrand();
        //Quay về danh sách
        return Redirect::route('brands.index')->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //Gọi function xóa bản ghi trong db
        $brand->deleteBrand();
        //Quay lại danh sách
        return Redirect::route('brands.index')->with('success', 'Brand deleted successfully!');
    }
}
