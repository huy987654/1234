@extends('layouts.admin')

@section('title', 'Sua khach hang')
@section('subtitle', 'Cap nhat thong tin khach hang')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="form-grid">
                @csrf
                @method('PUT')
                <div>
                    <label class="form-label" for="name">Ten khach hang</label>
                    <input id="name" type="text" name="name" value="{{ $customer->customer_name ?? $customer->name }}" required>
                </div>
                <div>
                    <label class="form-label" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ $customer->email }}" required>
                </div>
                <div>
                    <label class="form-label" for="phone">Dien thoai</label>
                    <input id="phone" type="text" name="phone" value="{{ $customer->phone }}" required>
                </div>
                <div>
                    <label class="form-label" for="password">Mat khau</label>
                    <input id="password" type="password" name="password" value="{{ $customer->password }}">
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Cap nhat</button>
                    <a href="{{ route('customers.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
