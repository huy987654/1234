@extends('layouts.admin')

@section('title', 'Quan ly don hang')
@section('subtitle', 'Theo doi don dat hang va trang thai xu ly cua khach hang')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="toolbar">
                <form method="GET" action="{{ route('admin.orders.index') }}" style="flex: 1;">
                    <input type="text" name="q" value="{{ $keyword ?? request('q') }}" class="search-input" placeholder="Tim ma don, ten, sdt, email...">
                </form>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Ma don</th>
                        <th>Khach hang</th>
                        <th>Nguoi nhan</th>
                        <th>Ngay dat</th>
                        <th>Thanh toan</th>
                        <th>Trang thai</th>
                        <th>Tong tien</th>
                        <th>Hanh dong</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                <div style="font-weight: 800;">{{ $order->customer_name }}</div>
                                <div class="text-muted" style="font-size: 13px;">{{ $order->email }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 800;">{{ $order->receiver_name }}</div>
                                <div class="text-muted" style="font-size: 13px;">{{ $order->receiver_phone }}</div>
                            </td>
                            <td>{{ date('d/m/Y H:i', strtotime($order->order_date)) }}</td>
                            <td>{{ $order->method }}</td>
                            <td><span class="badge bg-warning">{{ $order->status_name }}</span></td>
                            <td style="font-weight: 900; color: var(--danger);">{{ number_format((float) $order->total_amount, 0, ',', '.') }} đ</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">Chi tiet</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-cell">Chua co don hang nao.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
