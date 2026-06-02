@extends('layouts.admin')

@section('title', 'Sua thuong hieu')
@section('subtitle', 'Cap nhat ten thuong hieu')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('brands.update', $brand->id) }}" class="form-grid">
                @csrf
                @method('PUT')
                <div>
                    <label class="form-label" for="name">Ten thuong hieu</label>
                    <input id="name" type="text" name="name" value="{{ $brand->brand_name ?? $brand->name }}" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Cap nhat</button>
                    <a href="{{ route('brands.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
