@extends('layouts.admin')

@section('title', 'Them thuong hieu')
@section('subtitle', 'Tao moi mot hang dien thoai')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('brands.store') }}" class="form-grid">
                @csrf
                <div>
                    <label class="form-label" for="name">Ten thuong hieu</label>
                    <input id="name" type="text" name="name" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Luu</button>
                    <a href="{{ route('brands.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
