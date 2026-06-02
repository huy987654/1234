@extends('layouts.admin')

@section('title', 'Sua thanh toan')
@section('subtitle', 'Cap nhat phuong thuc thanh toan')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('payments.update', $payment->id) }}" class="form-grid">
                @csrf
                @method('PUT')
                <div>
                    <label class="form-label" for="name">Phuong thuc</label>
                    <input id="name" type="text" name="name" value="{{ $payment->method ?? $payment->name }}" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Cap nhat</button>
                    <a href="{{ route('payments.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
