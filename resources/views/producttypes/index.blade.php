@extends('layouts.admin')

@section('title', 'Quan ly loai san pham')
@section('subtitle', 'Phan nhom cac dong dien thoai va phu kien')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="toolbar">
                <form method="GET" action="{{ route('productTypes.index') }}" style="flex: 1;">
                    <input type="text" name="q" value="{{ $keyword ?? request('q') }}" class="search-input" placeholder="Tim kiem loai san pham...">
                </form>
                <a href="{{ route('productTypes.create') }}" class="btn btn-primary">+ Them loai</a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ten loai</th>
                        <th>Hanh dong</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($productTypes as $productType)
                        <tr>
                            <td>{{ $productType->id }}</td>
                            <td>{{ $productType->product_type_name }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('productTypes.edit', $productType->id) }}" class="btn btn-sm btn-info">Sua</a>
                                    <form method="post" action="{{ route('productTypes.destroy', $productType->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xoa loai san pham nay?')">Xoa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty-cell">Chua co loai san pham nao.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
