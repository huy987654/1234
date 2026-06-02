@extends('layouts.admin')

@section('title', 'Them trang thai')
@section('subtitle', 'Them trang thai xu ly moi')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('statuses.store') }}" class="form-grid">
                @csrf
                <div>
                    <label class="form-label" for="name">Ten trang thai</label>
                    <input id="name" type="text" name="name" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Luu</button>
                    <a href="{{ route('statuses.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
