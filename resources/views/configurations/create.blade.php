@extends('layouts.admin')

@section('title', 'Them cau hinh')
@section('subtitle', 'Nhap thong so ky thuat cho san pham')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('configurations.store') }}" method="POST" class="form-grid">
                @csrf
                @foreach(['cpu' => 'CPU', 'ram' => 'RAM', 'storage' => 'Bo nho', 'gpu' => 'GPU', 'screen' => 'Man hinh', 'os' => 'He dieu hanh', 'battery' => 'Pin', 'camera' => 'Camera', 'connect' => 'Ket noi', 'other_function' => 'Tinh nang khac'] as $field => $label)
                    <div>
                        <label class="form-label" for="{{ $field }}">{{ $label }}</label>
                        <input id="{{ $field }}" type="text" name="{{ $field }}">
                    </div>
                @endforeach
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Luu</button>
                    <a href="{{ route('configurations.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
