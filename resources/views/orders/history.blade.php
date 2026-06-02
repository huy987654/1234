@extends('layouts.shop')

@section('title', 'Lich su mua hang - Phone Store')

@section('content')
    <div class="section-head">
        <div>
            <h2>Lich su mua hang</h2>
            <div style="color: var(--muted); font-weight: 700; margin-top: 5px;">Theo doi cac don hang da dat</div>
        </div>
        <a href="{{ route('shop.home') }}#products" class="btn">Tiep tuc mua hang</a>
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

    <div class="panel">
        @if($orders->count() > 0)
            <div style="overflow-x: auto;">
                <table class="cart-table">
                    <thead>
                    <tr>
                        <th>Ma don</th>
                        <th>Ngay dat</th>
                        <th>Nguoi nhan</th>
                        <th>Thanh toan</th>
                        <th>Trang thai</th>
                        <th>Tong tien</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($order->order_date)) }}</td>
                            <td>{{ $order->receiver_name }}</td>
                            <td>{{ $order->method }}</td>
                            <td><span class="tag">{{ $order->status_name }}</span></td>
                            <td style="font-weight: 900; color: var(--danger);">{{ number_format((float) $order->total_amount, 0, ',', '.') }} đ</td>
                            <td>
                                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn">Chi tiet</a>
                                    @if(in_array($order->status_name, ['Cho xac nhan', 'Dang xu ly'], true))
                                        <form method="POST" action="{{ route('orders.cancel', $order->id) }}" style="margin: 0;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn" style="color: var(--danger); border: 1px solid #fecaca;" onclick="return confirm('Ban chac chan muon huy don hang nay?')">Huy don</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty">Ban chua co don hang nao.</div>
        @endif
    </div>
@endsection
