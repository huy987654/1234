@extends('layouts.admin')

@section('title', 'Quan ly bao hanh')
@section('subtitle', 'Danh sach phieu bao hanh san pham cua khach hang')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="toolbar">
                <form method="GET" action="{{ route('warranties.index') }}" style="flex: 1;">
                    <input type="text" name="q" value="{{ $keyword ?? '' }}" class="search-input"
                           placeholder="Tim ma bao hanh, ten khach, ten san pham...">
                </form>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Ma bao hanh</th>
                        <th>San pham</th>
                        <th>Khach hang</th>
                        <th>Ngay bat dau</th>
                        <th>Ngay ket thuc</th>
                        <th>Trang thai</th>
                        <th>Hanh dong</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($warranties as $w)
                        @php
                            $badgeClass = match($w->warranty_status) {
                                'Còn bảo hành' => 'bg-success',
                                'Đang xử lý'   => 'bg-warning',
                                default        => 'bg-danger',
                            };
                        @endphp
                        <tr>
                            <td style="font-weight: 900;">{{ $w->warranty_no }}</td>
                            <td>
                                <div style="font-weight: 800;">{{ $w->product_name }}</div>
                                <div class="text-muted" style="font-size: 13px;">{{ $w->pv_color }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 800;">{{ $w->customer_name }}</div>
                                <div class="text-muted" style="font-size: 13px;">{{ $w->customer_phone }}</div>
                            </td>
                            <td>{{ date('d/m/Y', strtotime($w->start_date)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($w->end_date)) }}</td>
                            <td>
                                <span class="badge {{ $badgeClass }}">{{ $w->warranty_status }}</span>
                            </td>
                            <td>
                                <a href="{{ route('warranties.show', [$w->warranty_no, $w->order_detail_id]) }}"
                                   class="btn btn-sm btn-info">Chi tiet</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-cell">Chua co phieu bao hanh nao.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
