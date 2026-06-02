@extends('layouts.admin')

@section('title', 'Sua san pham')
@section('subtitle', 'Cap nhat thong tin san pham')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="form-grid">
                @csrf
                @method('PUT')
                <div>
                    <label class="form-label" for="product_name">Ten san pham</label>
                    <input id="product_name" type="text" name="product_name" value="{{ $product->product_name }}" required>
                </div>
                <div>
                    <label class="form-label" for="image">Anh san pham</label>
                    @if(!empty($product->image))
                        <div style="margin-bottom: 10px;">
                            <img src="{{ asset(\Illuminate\Support\Facades\Storage::url('Images/' . $product->image)) }}" alt="{{ $product->product_name }}" style="width: 90px; height: 90px; object-fit: contain; border: 1px solid var(--line); border-radius: 8px;">
                        </div>
                    @endif
                    <input id="image" type="file" name="image" accept="image/*">
                </div>
                <div>
                    <label class="form-label" for="price">Gia ban</label>
                    <input id="price" type="number" name="price" value="{{ $product->price }}" min="0" required>
                </div>
                <div>
                    <label class="form-label" for="stock_quantity">So luong ton</label>
                    <input id="stock_quantity" type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" min="0" required>
                </div>
                <div>
                    <label class="form-label" for="brand_id">Thuong hieu</label>
                    <select id="brand_id" name="brand_id" required>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" @if($brand->id == $product->brand_id) selected @endif>
                                {{ $brand->brand_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="product_type_id">Loai san pham</label>
                    <select id="product_type_id" name="product_type_id" required>
                        @foreach($product_types as $producttype)
                            <option value="{{ $producttype->id }}" @if($producttype->id == $product->product_type_id) selected @endif>
                                {{ $producttype->product_type_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Cap nhat</button>
                    <a href="{{ route('products.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
