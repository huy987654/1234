@extends('layouts.shop')

@section('title', 'Chi tiet don hang #' . $order->id . ' - Phone Store')

@section('content')
    <div class="section-head">
        <div>
            <h2>Don hang #{{ $order->id }}</h2>
            <div style="color: var(--muted); font-weight: 700; margin-top: 5px;">
                Dat luc {{ date('d/m/Y H:i', strtotime($order->order_date)) }}
            </div>
        </div>
        <a href="{{ route('orders.history') }}" class="btn">Lich su mua hang</a>
    </div>

    @if(session('success'))
        <div class="panel" style="padding: 14px; margin-bottom: 14px; color: var(--success); font-weight: 900;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="panel" style="padding: 14px; margin-bottom: 14px; color: var(--danger); font-weight: 900;">
            {{ session('error') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 340px; gap: 18px; align-items: start;">
        <section class="panel">
            <div style="overflow-x: auto;">
                <table class="cart-table">
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
                                <div style="color: var(--muted); font-size: 13px; margin-top: 4px;">
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
        </section>

        <aside class="panel" style="padding: 18px;">
            <h3 style="margin: 0 0 12px;">Thong tin don hang</h3>
            <div style="display: grid; gap: 10px; color: var(--muted); font-weight: 800;">
                <div><strong style="color: var(--text);">Trang thai:</strong> {{ $order->status_name }}</div>
                <div><strong style="color: var(--text);">Thanh toan:</strong> {{ $order->method }}</div>
                <div><strong style="color: var(--text);">Nguoi nhan:</strong> {{ $order->receiver_name }}</div>
                <div><strong style="color: var(--text);">Dien thoai:</strong> {{ $order->receiver_phone }}</div>
                <div><strong style="color: var(--text);">Dia chi:</strong> {{ $order->order_address }}</div>
            </div>
            <div style="border-top: 1px solid var(--line); margin-top: 14px; padding-top: 14px; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: 900;">Tong tien</span>
                <span class="total-price">{{ number_format((float) $order->total_amount, 0, ',', '.') }} đ</span>
            </div>
            @if(in_array($order->status_name, ['Cho xac nhan', 'Dang xu ly'], true))
                <form method="POST" action="{{ route('orders.cancel', $order->id) }}" style="margin-top: 14px;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn" style="width: 100%; color: var(--danger); border: 1px solid #fecaca;" onclick="return confirm('Ban chac chan muon huy don hang nay?')">
                        Huy don hang
                    </button>
                </form>
            @endif
        </aside>
    </div>

    <style>
        @media (max-width: 900px) {
            main .container > div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection
