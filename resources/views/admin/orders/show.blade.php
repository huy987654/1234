@extends('layouts.admin')

@section('title', 'Don hang #' . $order->id)
@section('subtitle', 'Xem chi tiet va cap nhat trang thai xu ly don hang')

@section('content')
    <div class="toolbar">
        <a href="{{ route('admin.orders.index') }}" class="btn">Quay lai danh sach</a>
    </div>

    @if(session('success'))
        <div class="card" style="margin-bottom: 16px; border-color: #bbf7d0;">
            <div class="card-body" style="color: var(--success); font-weight: 700;">
                {{ session('success') }}
            </div>
        </div>
    @endif

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
                            <th>Bao hanh</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $detail)
                            @php $w = $warranties[$detail->id] ?? null; @endphp
                            <tr>
                                <td>
                                    <div style="font-weight: 900;">{{ $detail->product_name }}</div>
                                    <div class="text-muted" style="font-size: 13px;">{{ $detail->storage }} - {{ $detail->pv_color }} - RAM {{ $detail->ram }}</div>
                                </td>
                                <td>{{ number_format((float) $detail->unit_price, 0, ',', '.') }} đ</td>
                                <td>{{ $detail->quantity }}</td>
                                <td style="font-weight: 900; color: var(--danger);">{{ number_format((float) $detail->unit_price * (int) $detail->quantity, 0, ',', '.') }} đ</td>
                                <td>
                                    @if($w)
                                        @php
                                            $badgeClass = 'bg-warning';
                                            if ($w->warranty_status === 'Còn bảo hành') $badgeClass = 'bg-success';
                                            if ($w->warranty_status === 'Hết bảo hành') $badgeClass = 'bg-danger';
                                        @endphp
                                        <div style="font-size: 13px; font-weight: 800;">{{ $w->warranty_no }}</div>
                                        <span class="badge {{ $badgeClass }}" style="font-size: 11px;">{{ $w->warranty_status }}</span>
                                        <div class="text-muted" style="font-size: 12px; margin-top: 4px;">HSD: {{ date('d/m/Y', strtotime($w->end_date)) }}</div>
                                        <a href="{{ route('warranties.show', [$w->warranty_no, $detail->id]) }}" class="btn btn-sm" style="margin-top: 6px; font-size: 12px;">Chi tiet</a>
                                    @else
                                        <span class="text-muted" style="font-size: 13px;">Chua co</span>
                                    @endif
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
                                <option value="{{ $status->id }}" {{ (int) $order->status_id === (int) $status->id ? 'selected' : '' }}>{{ $status->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cap nhat trang thai</button>
                </form>

                @if($warranties->count() > 0)
                    <div style="border-top: 1px solid var(--line); margin-top: 16px; padding-top: 14px;">
                        <div style="font-weight: 800; margin-bottom: 8px;">Bao hanh da tao</div>
                        <div style="color: var(--success); font-size: 13px; font-weight: 700;">✓ {{ $warranties->count() }} phieu bao hanh</div>
                    </div>
                @endif

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
