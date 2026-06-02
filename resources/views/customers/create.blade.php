@extends('layouts.admin')

@section('title', 'Them khach hang')
@section('subtitle', 'Luu thong tin khach hang moi')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('customers.store') }}" method="POST" class="form-grid">
                @csrf
                <div>
                    <label class="form-label" for="name">Ten khach hang</label>
                    <input id="name" type="text" name="name" required>
                </div>
                <div>
                    <label class="form-label" for="email">Email</label>
                    <input id="email" type="email" name="email" required>
                </div>
                <div>
                    <label class="form-label" for="phone">Dien thoai</label>
                    <input id="phone" type="text" name="phone" required>
                </div>
                <div>
                    <label class="form-label" for="password">Mat khau</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Luu</button>
                    <a href="{{ route('customers.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
