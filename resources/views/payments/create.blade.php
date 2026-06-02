@extends('layouts.admin')

@section('title', 'Them thanh toan')
@section('subtitle', 'Them phuong thuc thanh toan moi')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('payments.store') }}" class="form-grid">
                @csrf
                <div>
                    <label class="form-label" for="name">Phuong thuc</label>
                    <input id="name" type="text" name="name" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Luu</button>
                    <a href="{{ route('payments.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
