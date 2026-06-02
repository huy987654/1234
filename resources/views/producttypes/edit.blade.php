@extends('layouts.admin')

@section('title', 'Sua loai san pham')
@section('subtitle', 'Cap nhat nhom san pham')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('productTypes.update', $productType->id) }}" class="form-grid">
                @csrf
                @method('PUT')
                <div>
                    <label class="form-label" for="name">Ten loai</label>
                    <input id="name" type="text" name="name" value="{{ $productType->product_type_name ?? $productType->name }}" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Cap nhat</button>
                    <a href="{{ route('productTypes.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
