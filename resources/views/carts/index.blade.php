@extends('layouts.shop')

@section('title', 'Gio hang - Phone Store')

@section('content')
    <div class="section-head">
        <div>
            <h2>Gio hang cua ban</h2>
            <div style="color: var(--muted); font-weight: 700; margin-top: 5px;">Kiem tra san pham truoc khi dat hang</div>
        </div>
        <a href="{{ route('shop.home') }}#products" class="btn">Tiep tuc mua hang</a>
    </div>

    <div class="panel">
        @if(session('error'))
            <div style="padding: 14px; border-bottom: 1px solid var(--line); color: var(--danger); font-weight: 900;">
                {{ session('error') }}
            </div>
        @endif

        @if(count($carts) > 0)
            @php($total = 0)
            <form method="POST" action="{{ route('carts.updateCart') }}">
                @csrf
                <div style="overflow-x: auto;">
                    <table class="cart-table">
                        <thead>
                        <tr>
                            <th>San pham</th>
                            <th>Gia</th>
                            <th>So luong</th>
                            <th>Tam tinh</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($carts as $id => $product)
                            @php($subTotal = (float) $product['price'] * (int) $product['quantity'])
                            @php($total += $subTotal)
                            <tr>
                                <td>
                                    <div style="font-weight: 900;">{{ $product['product_name'] ?? $product['name'] ?? 'San pham' }}</div>
                                    <div style="color: var(--muted); font-size: 13px; margin-top: 4px;">
                                        {{ $product['storage'] ?? 'Dung luong' }} - {{ $product['color'] ?? 'Mau sac' }} - RAM {{ $product['ram'] ?? '--' }}
                                    </div>
                                    <div style="color: var(--muted); font-size: 13px; margin-top: 4px;">Ma bien the: #{{ $id }}</div>
                                </td>
                                <td>{{ number_format((float) $product['price'], 0, ',', '.') }} đ</td>
                                <td>
                                    <div class="qty-control">
                                        <a href="{{ route('carts.minus', $id) }}" class="btn">-</a>
                                        <input type="number" min="1" name="updateQuantity[{{ $id }}]" value="{{ $product['quantity'] }}">
                                        <a href="{{ route('carts.plus', $id) }}" class="btn">+</a>
                                    </div>
                                </td>
                                <td style="font-weight: 900; color: var(--danger);">
                                    {{ number_format($subTotal, 0, ',', '.') }} đ
                                </td>
                                <td>
                                    <a href="{{ route('carts.removeOneProduct', $id) }}" class="btn">Xoa</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="cart-summary">
                    <div class="actions" style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button type="submit" class="btn btn-primary">Cap nhat gio hang</button>
                        <a href="{{ route('orders.checkout') }}" class="btn btn-primary">Thanh toan</a>
                        <a href="{{ route('carts.deleteCart') }}" class="btn">Xoa tat ca</a>
                    </div>
                    <div>
                        <div style="color: var(--muted); font-weight: 800; text-align: right;">Tong thanh toan</div>
                        <div class="total-price">{{ number_format($total, 0, ',', '.') }} đ</div>
                    </div>
                </div>
            </form>
        @else
            <div class="empty">
                Gio hang dang trong.
                <div style="margin-top: 14px;">
                    <a href="{{ route('shop.home') }}#products" class="btn btn-primary">Mua san pham</a>
                </div>
            </div>
        @endif
    </div>
@endsection
