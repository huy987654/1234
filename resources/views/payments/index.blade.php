@extends('layouts.admin')

@section('title', 'Quan ly thanh toan')
@section('subtitle', 'Cac phuong thuc thanh toan khach hang co the su dung')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="toolbar">
                <form method="GET" action="{{ route('payments.index') }}" style="flex: 1;">
                    <input type="text" name="q" value="{{ $keyword ?? request('q') }}" class="search-input" placeholder="Tim kiem phuong thuc...">
                </form>
                <a href="{{ route('payments.create') }}" class="btn btn-primary">+ Them thanh toan</a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Phuong thuc</th>
                        <th>Hanh dong</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->method }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-sm btn-info">Sua</a>
                                    <form method="post" action="{{ route('payments.destroy', $payment->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xoa phuong thuc thanh toan nay?')">Xoa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty-cell">Chua co phuong thuc thanh toan nao.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
