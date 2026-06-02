@extends('layouts.admin')

@section('title', 'Quan ly thuong hieu')
@section('subtitle', 'Danh sach cac hang dien thoai dang kinh doanh')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="toolbar">
                <form method="GET" action="{{ route('brands.index') }}" style="flex: 1;">
                    <input type="text" name="q" value="{{ $keyword ?? request('q') }}" class="search-input" placeholder="Tim kiem thuong hieu...">
                </form>
                <a href="{{ route('brands.create') }}" class="btn btn-primary">+ Them thuong hieu</a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ten thuong hieu</th>
                        <th>Hanh dong</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-sm btn-info">Sua</a>
                                    <form method="post" action="{{ route('brands.destroy', $brand->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xoa thuong hieu nay?')">Xoa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty-cell">Chua co thuong hieu nao.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
