@extends('layouts.admin')

@section('title', 'Sua cau hinh')
@section('subtitle', 'Cap nhat thong so ky thuat')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('configurations.update', $configuration->id) }}" method="POST" class="form-grid">
                @csrf
                @method('PUT')
                @foreach(['cpu' => 'CPU', 'ram' => 'RAM', 'storage' => 'Bo nho', 'gpu' => 'GPU', 'screen' => 'Man hinh', 'os' => 'He dieu hanh', 'battery' => 'Pin', 'camera' => 'Camera', 'connect' => 'Ket noi', 'other_function' => 'Tinh nang khac'] as $field => $label)
                    <div>
                        <label class="form-label" for="{{ $field }}">{{ $label }}</label>
                        <input id="{{ $field }}" type="text" name="{{ $field }}" value="{{ $configuration->$field }}">
                    </div>
                @endforeach
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Cap nhat</button>
                    <a href="{{ route('configurations.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
