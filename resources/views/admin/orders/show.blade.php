@extends('layouts.admin')

@section('title', 'Don hang #' . $order->id)
@section('subtitle', 'Xem chi tiet va cap nhat trang thai xu ly don hang')

@section('content')
    <div class="toolbar">
        <a href="{{ route('admin.orders.index') }}" class="btn">Quay lai danh sach</a>
    </div>

    <div style="display: grid; grid-template-columns: minmax(0, 1fr) 360px; gap: 18px; align-items: start;">
        <section class="card">
            <div class="card-body">
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>San pham</th>
                            <th>Don gia</th>
                            <th>So luong</th>
                            <th>Tam tinh</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $detail)
                            <tr>
                                <td>
                                    <div style="font-weight: 900;">{{ $detail->product_name }}</div>
                                    <div class="text-muted" style="font-size: 13px;">
                                        {{ $detail->storage }} - {{ $detail->pv_color }} - RAM {{ $detail->ram }}
                                    </div>
                                </td>
                                <td>{{ number_format((float) $detail->unit_price, 0, ',', '.') }} đ</td>
                                <td>{{ $detail->quantity }}</td>
                                <td style="font-weight: 900; color: var(--danger);">
                                    {{ number_format((float) $detail->unit_price * (int) $detail->quantity, 0, ',', '.') }} đ
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <aside class="card">
            <div class="card-body">
                <h3 style="margin: 0 0 14px;">Thong tin don hang</h3>

                <div style="display: grid; gap: 10px; color: var(--muted); font-weight: 700; margin-bottom: 18px;">
                    <div><strong style="color: var(--ink);">Khach hang:</strong> {{ $order->customer_name }}</div>
                    <div><strong style="color: var(--ink);">Email:</strong> {{ $order->email }}</div>
                    <div><strong style="color: var(--ink);">Nguoi nhan:</strong> {{ $order->receiver_name }}</div>
                    <div><strong style="color: var(--ink);">Dien thoai:</strong> {{ $order->receiver_phone }}</div>
                    <div><strong style="color: var(--ink);">Dia chi:</strong> {{ $order->order_address }}</div>
                    <div><strong style="color: var(--ink);">Thanh toan:</strong> {{ $order->method }}</div>
                    <div><strong style="color: var(--ink);">Ngay dat:</strong> {{ date('d/m/Y H:i', strtotime($order->order_date)) }}</div>
                </div>

                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" style="display: grid; gap: 12px;">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="form-label">Trang thai don hang</label>
                        <select name="status_id" required>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ (int) $order->status_id === (int) $status->id ? 'selected' : '' }}>
                                    {{ $status->status_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cap nhat trang thai</button>
                </form>

                <div style="border-top: 1px solid var(--line); margin-top: 16px; padding-top: 16px; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-weight: 900;">Tong tien</span>
                    <span style="font-weight: 900; color: var(--danger); font-size: 20px;">{{ number_format((float) $order->total_amount, 0, ',', '.') }} đ</span>
                </div>
            </div>
        </aside>
    </div>

    <style>
        @media (max-width: 980px) {
            main .content > div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection
