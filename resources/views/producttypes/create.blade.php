@extends('layouts.admin')

@section('title', 'Them loai san pham')
@section('subtitle', 'Tao nhom san pham moi')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('productTypes.store') }}" class="form-grid">
                @csrf
                <div>
                    <label class="form-label" for="name">Ten loai</label>
                    <input id="name" type="text" name="name" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Luu</button>
                    <a href="{{ route('productTypes.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
