@extends('layouts.admin')

@section('title', 'Sua trang thai')
@section('subtitle', 'Cap nhat ten trang thai')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('statuses.update', $status->id) }}" class="form-grid">
                @csrf
                @method('PUT')
                <div>
                    <label class="form-label" for="name">Ten trang thai</label>
                    <input id="name" type="text" name="name" value="{{ $status->status_name ?? $status->name }}" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Cap nhat</button>
                    <a href="{{ route('statuses.index') }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
