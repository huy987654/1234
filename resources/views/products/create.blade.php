@extends('layouts.admin')

@section('title', 'Them san pham')
@section('subtitle', 'Nhap thong tin san pham dien thoai moi')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="form-grid">
                @csrf
                <div>
                    <label class="form-label" for="name">Ten san pham</label>
                    <input id="name" type="text" name="name" required>
                </div>
                <div>
                    <label class="form-label" for="image">Anh san pham</label>
                    <input id="image" type="file" name="image" accept="image/*">
                </div>
                <div>
                    <label class="form-label" for="price">Gia ban</label>
                    <input id="price" type="number" name="price" min="0" required>
                </div>
                <div>
                    <label class="form-label" for="stock_quantity">So luong ton</label>
                    <input id="stock_quantity" type="number" name="stock_quantity" min="0" required>
                </div>
                <div>
                    <label class="form-label" for="brand_id">Thuong hieu</label>
                    <select id="brand_id" name="brand_id" required>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="product_type_id">Loai san pham</label>
                    <select id="product_type_id" name="product_type_id" required>
                        @foreach($product_types as $producttype)
                            <option value="{{ $producttype->id }}">{{ $producttype->product_type_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Luu</button>
                    <a href="{{ route('products.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
