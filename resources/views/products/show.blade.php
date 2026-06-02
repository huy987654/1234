@extends('layouts.admin')

@section('title', 'Cau hinh san pham')
@section('subtitle', 'Xem bien the va thong so ky thuat cua san pham')

@section('content')
    <div class="card" style="margin-bottom: 18px;">
        <div class="card-body">
            <div class="toolbar">
                <div>
                    <h2 style="margin: 0 0 8px;">{{ $product->product_name ?? 'San pham' }}</h2>
                    <div class="text-muted">
                        {{ $product->brand_name ?? 'Dang cap nhat thuong hieu' }}
                        -
                        {{ $product->product_type_name ?? 'Dang cap nhat loai' }}
                    </div>
                </div>
                <div class="actions">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Sua san pham</a>
                    <a href="{{ route('products.index') }}" class="btn">Quay lai</a>
                </div>
            </div>

            <div class="stats-grid" style="margin-bottom: 0;">
                <div class="stat-card">
                    <div class="stat-label">Gia niem yet</div>
                    <div class="stat-value" style="font-size: 22px;">{{ $product->price ?? '--' }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Ton kho tong</div>
                    <div class="stat-value" style="font-size: 22px;">{{ $product->stock_quantity ?? '--' }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">So bien the</div>
                    <div class="stat-value" style="font-size: 22px;">{{ $variants->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Ma san pham</div>
                    <div class="stat-value" style="font-size: 22px;">#{{ $product->id }}</div>
                </div>
            </div>
        </div>
    </div>

    @forelse($variants as $variant)
        <div class="card" style="margin-bottom: 18px;">
            <div class="card-body">
                <div class="toolbar">
                    <div>
                        <h3 style="margin: 0 0 6px;">Bien the {{ $variant->pv_color }}</h3>
                        <div class="text-muted">{{ $variant->desc }}</div>
                    </div>
                    <div class="actions">
                        <span class="badge bg-success">Ton: {{ $variant->pv_stock_qtt }}</span>
                        <span class="badge bg-warning">Gia: {{ $variant->pv_price }}</span>
                    </div>
                </div>

                <div class="table-wrap">
                    <table>
                        <tbody>
                        <tr>
                            <th>CPU</th>
                            <td>{{ $variant->cpu }}</td>
                            <th>RAM</th>
                            <td>{{ $variant->ram }}</td>
                        </tr>
                        <tr>
                            <th>Bo nho</th>
                            <td>{{ $variant->storage }}</td>
                            <th>GPU</th>
                            <td>{{ $variant->gpu }}</td>
                        </tr>
                        <tr>
                            <th>Man hinh</th>
                            <td>{{ $variant->screen }}</td>
                            <th>He dieu hanh</th>
                            <td>{{ $variant->os }}</td>
                        </tr>
                        <tr>
                            <th>Pin</th>
                            <td>{{ $variant->battery }}</td>
                            <th>Camera</th>
                            <td>{{ $variant->camera }}</td>
                        </tr>
                        <tr>
                            <th>Ket noi</th>
                            <td>{{ $variant->connect }}</td>
                            <th>Tinh nang khac</th>
                            <td>{{ $variant->other_function }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-body empty-cell">
                San pham nay chua co bien the va cau hinh.
            </div>
        </div>
    @endforelse
@endsection
