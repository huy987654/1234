@extends('layouts.shop')

@section('title', 'Thanh toan - Phone Store')

@section('content')
    @php($total = 0)

    <div class="section-head">
        <div>
            <h2>Thanh toan</h2>
            <div style="color: var(--muted); font-weight: 700; margin-top: 5px;">Xac nhan thong tin nhan hang va phuong thuc thanh toan</div>
        </div>
        <a href="{{ route('carts.index') }}" class="btn">Quay lai gio hang</a>
    </div>

    <div style="display: grid; grid-template-columns: minmax(0, 1fr) 380px; gap: 18px; align-items: start;">
        <section class="panel" style="padding: 20px;">
            @if($errors->any())
                <div style="margin-bottom: 14px; padding: 12px; border-radius: 8px; background: #fee2e2; color: var(--danger); font-weight: 800;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('orders.placeOrder') }}" style="display: grid; gap: 14px;">
                @csrf
                <div>
                    <label style="display: block; font-weight: 900; margin-bottom: 7px;">Nguoi nhan</label>
                    <input type="text" name="receiver_name" value="{{ old('receiver_name', $customer->customer_name) }}" required>
                </div>
                <div>
                    <label style="display: block; font-weight: 900; margin-bottom: 7px;">So dien thoai</label>
                    <input type="text" name="receiver_phone" value="{{ old('receiver_phone', $customer->phone) }}" required>
                </div>
                <div>
                    <label style="display: block; font-weight: 900; margin-bottom: 7px;">Dia chi nhan hang</label>
                    <input type="text" name="order_address" value="{{ old('order_address') }}" placeholder="Nhap dia chi giao hang" required>
                </div>
                <div>
                    <label style="display: block; font-weight: 900; margin-bottom: 7px;">Phuong thuc thanh toan</label>
                    <select name="payment_id" required>
                        @foreach($payments as $payment)
                            <option value="{{ $payment->id }}">{{ $payment->method }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" style="min-height: 48px;">Dat hang</button>
            </form>
        </section>

        <aside class="panel" style="padding: 18px;">
            <h3 style="margin: 0 0 14px;">Tom tat don hang</h3>
            <div style="display: grid; gap: 12px;">
                @foreach($carts as $item)
                    @php($subTotal = (float) $item['price'] * (int) $item['quantity'])
                    @php($total += $subTotal)
                    <div style="border-bottom: 1px solid var(--line); padding-bottom: 12px;">
                        <div style="font-weight: 900;">{{ $item['product_name'] ?? $item['name'] ?? 'San pham' }}</div>
                        <div style="color: var(--muted); font-size: 13px; margin-top: 4px;">
                            {{ $item['storage'] ?? '--' }} - {{ $item['color'] ?? '--' }} - SL: {{ $item['quantity'] }}
                        </div>
                        <div style="font-weight: 900; color: var(--danger); margin-top: 6px;">{{ number_format($subTotal, 0, ',', '.') }} đ</div>
                    </div>
                @endforeach
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 14px;">
                <span style="font-weight: 900;">Tong tien</span>
                <span class="total-price">{{ number_format($total, 0, ',', '.') }} đ</span>
            </div>
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
