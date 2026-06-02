@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Theo doi doanh thu, don hang va du lieu cua hang')

@section('content')
    @php
        $maxDailyRevenue = max(array_column($dailyRevenue, 'value')) ?: 1;
        $maxMonthlyRevenue = max(array_column($monthlyRevenue, 'value')) ?: 1;
    @endphp

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Doanh thu hom nay</div>
            <div class="stat-value">{{ number_format((float) $revenueToday, 0, ',', '.') }}đ</div>
            <div class="text-muted">Chi tinh don da hoan thanh</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Doanh thu thang {{ $currentMonth }}</div>
            <div class="stat-value">{{ number_format((float) $revenueThisMonth, 0, ',', '.') }}đ</div>
            <div class="text-muted">Tong trong thang hien tai</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Doanh thu nam {{ $currentYear }}</div>
            <div class="stat-value">{{ number_format((float) $revenueThisYear, 0, ',', '.') }}đ</div>
            <div class="text-muted">Tong doanh thu trong nam</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Don cho xu ly</div>
            <div class="stat-value">{{ $pendingOrderCount }}</div>
            <div class="text-muted">Cho xac nhan va dang xu ly</div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">San pham</div>
            <div class="stat-value">{{ $productCount }}</div>
            <div class="text-muted">Tong so mat hang</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Khach hang</div>
            <div class="stat-value">{{ $customerCount }}</div>
            <div class="text-muted">Tai khoan da luu</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Don hang</div>
            <div class="stat-value">{{ $orderCount }}</div>
            <div class="text-muted">Tat ca trang thai</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: minmax(0, 1.5fr) minmax(320px, .9fr); gap: 18px; align-items: stretch;">
        <section class="card">
            <div class="card-body">
                <div class="toolbar">
                    <div>
                        <h2 style="margin: 0 0 6px;">Doanh thu theo ngay</h2>
                        <div class="text-muted">Thang {{ $currentMonth }}/{{ $currentYear }}</div>
                    </div>
                </div>

                <div class="chart chart-daily">
                    @foreach($dailyRevenue as $day)
                        @php($height = max(3, ($day['value'] / $maxDailyRevenue) * 100))
                        <div class="bar-item" title="Ngay {{ $day['label'] }}: {{ number_format($day['value'], 0, ',', '.') }}đ">
                            <div class="bar-value">{{ $day['value'] > 0 ? number_format($day['value'] / 1000000, 1, ',', '.') . 'tr' : '' }}</div>
                            <div class="bar-track">
                                <div class="bar-fill" style="height: {{ $height }}%;"></div>
                            </div>
                            <div class="bar-label">{{ $day['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="card">
            <div class="card-body">
                <div class="toolbar">
                    <div>
                        <h2 style="margin: 0 0 6px;">Doanh thu theo thang</h2>
                        <div class="text-muted">Nam {{ $currentYear }}</div>
                    </div>
                </div>

                <div class="month-list">
                    @foreach($monthlyRevenue as $month)
                        @php($width = max(2, ($month['value'] / $maxMonthlyRevenue) * 100))
                        <div class="month-row">
                            <div class="month-name">{{ $month['label'] }}</div>
                            <div class="month-track">
                                <div class="month-fill" style="width: {{ $width }}%;"></div>
                            </div>
                            <div class="month-value">{{ number_format($month['value'], 0, ',', '.') }}đ</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    <style>
        .chart {
            min-height: 300px;
            display: grid;
            align-items: end;
            gap: 7px;
            padding-top: 18px;
        }
        .chart-daily {
            grid-template-columns: repeat({{ count($dailyRevenue) }}, minmax(18px, 1fr));
        }
        .bar-item {
            min-width: 0;
            display: grid;
            grid-template-rows: 22px 230px 22px;
            gap: 7px;
            text-align: center;
        }
        .bar-value {
            color: var(--muted);
            font-size: 11px;
            font-weight: 800;
            overflow: hidden;
            white-space: nowrap;
        }
        .bar-track {
            height: 230px;
            border-radius: 8px;
            background: #edf2f7;
            display: flex;
            align-items: end;
            overflow: hidden;
        }
        .bar-fill {
            width: 100%;
            border-radius: 8px 8px 0 0;
            background: linear-gradient(180deg, #14b8a6, #0f766e);
        }
        .bar-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 800;
        }
        .month-list {
            display: grid;
            gap: 13px;
        }
        .month-row {
            display: grid;
            grid-template-columns: 38px minmax(0, 1fr) 110px;
            align-items: center;
            gap: 10px;
        }
        .month-name,
        .month-value {
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
        }
        .month-value {
            text-align: right;
            color: var(--ink);
        }
        .month-track {
            height: 16px;
            border-radius: 999px;
            overflow: hidden;
            background: #edf2f7;
        }
        .month-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #2563eb, #14b8a6);
        }
        @media (max-width: 1100px) {
            main .content > div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }
        @media (max-width: 760px) {
            .chart {
                overflow-x: auto;
                grid-template-columns: repeat({{ count($dailyRevenue) }}, 22px);
                padding-bottom: 8px;
            }
            .bar-item {
                width: 22px;
            }
            .month-row {
                grid-template-columns: 34px minmax(0, 1fr);
            }
            .month-value {
                grid-column: 2;
                text-align: left;
            }
        }
    </style>
@endsection
