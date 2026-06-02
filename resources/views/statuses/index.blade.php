@extends('layouts.admin')

@section('title', 'Quan ly trang thai')
@section('subtitle', 'Cac trang thai dung cho don hang va quy trinh xu ly')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="toolbar">
                <form method="GET" action="{{ route('statuses.index') }}" style="flex: 1;">
                    <input type="text" name="q" value="{{ $keyword ?? request('q') }}" class="search-input" placeholder="Tim kiem trang thai...">
                </form>
                <a href="{{ route('statuses.create') }}" class="btn btn-primary">+ Them trang thai</a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ten trang thai</th>
                        <th>Hanh dong</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($statuses as $status)
                        <tr>
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->status_name }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('statuses.edit', $status->id) }}" class="btn btn-sm btn-info">Sua</a>
                                    <form method="post" action="{{ route('statuses.destroy', $status->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xoa trang thai nay?')">Xoa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty-cell">Chua co trang thai nao.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
