@extends('layouts.admin')

@section('title', 'Quan ly san pham')
@section('subtitle', 'Theo doi ton kho, thuong hieu va trang thai kinh doanh')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="toolbar">
                <form method="GET" action="{{ route('products.index') }}" style="flex: 1;">
                    <input type="text" name="q" value="{{ $keyword ?? request('q') }}" class="search-input" placeholder="Tim kiem san pham...">
                </form>
                <a href="{{ route('products.create') }}" class="btn btn-primary">+ Them san pham</a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Ma SP</th>
                        <th>Anh</th>
                        <th>Ten san pham</th>
                        <th>Thuong hieu</th>
                        <th>Loai</th>
                        <th>Ton kho</th>
                        <th>Trang thai</th>
                        <th>Hanh dong</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $p)
                        @php($stock = $p->stock_quantity ?? $p->stock ?? 0)
                        <tr>
                            <td>{{ $p->product_code ?? $p->id }}</td>
                            <td>
                                @if(!empty($p->image))
                                    <img src="{{ asset(\Illuminate\Support\Facades\Storage::url('Images/' . $p->image)) }}" alt="{{ $p->product_name ?? 'San pham' }}" style="width: 54px; height: 54px; object-fit: contain; border-radius: 8px; border: 1px solid var(--line);">
                                @else
                                    <span class="text-muted">Chua co anh</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.show', $p->id) }}" style="color: var(--accent); font-weight: 800;">
                                    {{ $p->product_name ?? $p->name ?? 'Chua dat ten' }}
                                </a>
                            </td>
                            <td>{{ $p->brand_name ?? $p->brand ?? 'Dang cap nhat' }}</td>
                            <td>{{ $p->product_type_name ?? $p->product_type ?? 'Dang cap nhat' }}</td>
                            <td>{{ $stock }}</td>
                            <td>
                                @if($stock > 10)
                                    <span class="badge bg-success">Con hang</span>
                                @elseif($stock > 0)
                                    <span class="badge bg-warning">Sap het</span>
                                @else
                                    <span class="badge bg-danger">Het hang</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('products.edit', $p->id) }}" class="btn btn-sm btn-info">Sua</a>
                                    <a href="{{ route('products.show', $p->id) }}" class="btn btn-sm">Cau hinh</a>
                                    <a href="{{ route('productVariants.index', $p->id) }}" class="btn btn-sm">Bien the</a>
                                    <form action="{{ route('products.destroy', $p->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xoa san pham nay?')">Xoa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-cell">Chua co san pham nao.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
