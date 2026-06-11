@extends('layouts.admin')

@section('title', 'Chi tiet bao hanh')
@section('subtitle', 'Thong tin phieu bao hanh va cap nhat trang thai')

@section('content')
    <div class="toolbar" style="margin-bottom: 16px;">
        <a href="{{ route('warranties.index') }}" class="btn">Quay lai danh sach</a>
        <a href="{{ route('admin.orders.show', $warranty->order_id) }}" class="btn">Xem don hang #{{ $warranty->order_id }}</a>
    </div>

    @if(session('success'))
        <div class="card" style="margin-bottom: 16px; border-color: #bbf7d0;">
            <div class="card-body" style="color: var(--success); font-weight: 700;">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div style="display: grid; grid-template-columns: minmax(0, 1fr) 360px; gap: 18px; align-items: start;">

        {{-- Thong tin bao hanh --}}
        <section class="card">
            <div class="card-body">
                <h3 style="margin: 0 0 18px;">Thong tin bao hanh</h3>

                <div class="table-wrap">
                    <table>
                        <tbody>
                        <tr>
                            <th style="width: 180px;">Ma bao hanh</th>
                            <td style="font-weight: 900;">{{ $warranty->warranty_no }}</td>
                        </tr>
                        <tr>
                            <th>San pham</th>
                            <td>
                                {{ $warranty->product_name }}
                                <span class="text-muted"> — {{ $warranty->pv_color }}, {{ $warranty->storage }}, RAM {{ $warranty->ram }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Khach hang</th>
                            <td>
                                {{ $warranty->customer_name }}
                                <span class="text-muted"> | {{ $warranty->customer_phone }} | {{ $warranty->customer_email }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Ngay dat hang</th>
                            <td>{{ date('d/m/Y H:i', strtotime($warranty->order_date)) }}</td>
                        </tr>
                        <tr>
                            <th>Dia chi nhan hang</th>
                            <td>{{ $warranty->order_address }}</td>
                        </tr>
                        <tr>
                            <th>So luong</th>
                            <td>{{ $warranty->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Don gia</th>
                            <td>{{ number_format((float) $warranty->unit_price, 0, ',', '.') }} đ</td>
                        </tr>
                        <tr>
                            <th>Ngay bat dau BH</th>
                            <td>{{ date('d/m/Y', strtotime($warranty->start_date)) }}</td>
                        </tr>
                        <tr>
                            <th>Ngay ket thuc BH</th>
                            <td>{{ date('d/m/Y', strtotime($warranty->end_date)) }}</td>
                        </tr>
                        <tr>
                            <th>Trang thai</th>
                            <td>
                                @php
                                    $badgeClass = match($warranty->warranty_status) {
                                        'Còn bảo hành' => 'bg-success',
                                        'Đang xử lý'   => 'bg-warning',
                                        default        => 'bg-danger',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $warranty->warranty_status }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Mo ta</th>
                            <td>{{ $warranty->description ?? '—' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- Form cap nhat trang thai --}}
        <aside class="card">
            <div class="card-body">
                <h3 style="margin: 0 0 14px;">Cap nhat bao hanh</h3>

                <form method="POST"
                      action="{{ route('warranties.update', [$warranty->warranty_no, $warranty->order_detail_id]) }}"
                      style="display: grid; gap: 14px;">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="form-label">Trang thai bao hanh</label>
                        <select name="warranty_status" required>
                            @foreach(['Còn bảo hành', 'Đang xử lý', 'Hết bảo hành'] as $status)
                                <option value="{{ $status }}"
                                    {{ $warranty->warranty_status === $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Mo ta / Ghi chu</label>
                        <textarea name="description" rows="4"
                                  style="resize: vertical;">{{ $warranty->description }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Luu thay doi</button>
                </form>
            </div>
        </aside>
    </div>

    <style>
        @media (max-width: 980px) {
            main .content > div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection
