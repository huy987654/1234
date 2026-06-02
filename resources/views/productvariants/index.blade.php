@extends('layouts.admin')

@section('title', 'Bien the san pham')
@section('subtitle', 'Quan ly mau sac, dung luong, gia va ton kho cua san pham')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="toolbar">
                <div>
                    <h2 style="margin: 0 0 6px;">{{ $product->product_name }}</h2>
                    <div class="text-muted">Moi bien the gan voi mot cau hinh ky thuat rieng.</div>
                </div>
                <div class="actions">
                    <a href="{{ route('productVariants.create', $product->id) }}" class="btn btn-primary">+ Them bien the</a>
                    <a href="{{ route('products.index') }}" class="btn">Quay lai</a>
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mau sac</th>
                        <th>Dung luong</th>
                        <th>RAM</th>
                        <th>Gia</th>
                        <th>Ton kho</th>
                        <th>Mo ta</th>
                        <th>Hanh dong</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($variants as $variant)
                        <tr>
                            <td>{{ $variant->id }}</td>
                            <td>{{ $variant->pv_color }}</td>
                            <td>{{ $variant->storage }}</td>
                            <td>{{ $variant->ram }}</td>
                            <td>{{ number_format((float) $variant->pv_price, 0, ',', '.') }} đ</td>
                            <td>{{ $variant->pv_stock_qtt }}</td>
                            <td>{{ $variant->desc }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('productVariants.edit', [$product->id, $variant->id]) }}" class="btn btn-sm btn-info">Sua</a>
                                    <form method="POST" action="{{ route('productVariants.destroy', [$product->id, $variant->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xoa bien the nay?')">Xoa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-cell">San pham nay chua co bien the.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
