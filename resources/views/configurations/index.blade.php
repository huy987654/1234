@extends('layouts.admin')

@section('title', 'Quan ly cau hinh')
@section('subtitle', 'Thong so ky thuat gan voi cac san pham dien thoai')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="toolbar">
                <form method="GET" action="{{ route('configurations.index') }}" style="flex: 1;">
                    <input type="text" name="q" value="{{ $keyword ?? request('q') }}" class="search-input" placeholder="Tim kiem cau hinh...">
                </form>
                <a href="{{ route('configurations.create') }}" class="btn btn-primary">+ Them cau hinh</a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>CPU</th>
                        <th>RAM</th>
                        <th>Bo nho</th>
                        <th>Man hinh</th>
                        <th>Pin</th>
                        <th>Camera</th>
                        <th>Hanh dong</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($configurations as $configuration)
                        <tr>
                            <td>{{ $configuration->id }}</td>
                            <td>{{ $configuration->cpu }}</td>
                            <td>{{ $configuration->ram }}</td>
                            <td>{{ $configuration->storage }}</td>
                            <td>{{ $configuration->screen }}</td>
                            <td>{{ $configuration->battery }}</td>
                            <td>{{ $configuration->camera }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('configurations.edit', $configuration->id) }}" class="btn btn-sm btn-info">Sua</a>
                                    <form action="{{ route('configurations.destroy', $configuration->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xoa cau hinh nay?')">Xoa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-cell">Chua co cau hinh nao.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
