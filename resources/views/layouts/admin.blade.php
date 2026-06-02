<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Quan tri') - Phone Store</title>
    <style>
        :root {
            --bg: #f4f7fb;
            --panel: #ffffff;
            --ink: #152033;
            --muted: #6d7890;
            --line: #e6ebf2;
            --brand: #0f766e;
            --brand-dark: #115e59;
            --accent: #2563eb;
            --danger: #dc2626;
            --warning: #d97706;
            --success: #15803d;
            --shadow: 0 14px 35px rgba(21, 32, 51, .08);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--ink);
            background: var(--bg);
        }
        a { color: inherit; text-decoration: none; }
        button, input, select, textarea { font: inherit; }

        .admin-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 260px 1fr;
        }
        .admin-sidebar {
            background: #10233f;
            color: #dbe7ff;
            padding: 24px 18px;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .brand-block {
            padding: 0 8px 24px;
            border-bottom: 1px solid rgba(255,255,255,.12);
            margin-bottom: 18px;
        }
        .brand-title {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: .3px;
            color: #fff;
        }
        .brand-subtitle {
            color: #9fb2d3;
            font-size: 13px;
            margin-top: 6px;
        }
        .nav-link {
            display: flex;
            align-items: center;
            min-height: 42px;
            padding: 10px 12px;
            border-radius: 8px;
            color: #dbe7ff;
            font-weight: 600;
            margin: 3px 0;
        }
        .nav-link:hover,
        .nav-link.active {
            background: rgba(255,255,255,.11);
            color: #fff;
        }
        .sidebar-footer {
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.12);
        }
        .staff-meta {
            padding: 0 10px 12px;
            color: #9fb2d3;
            font-size: 13px;
            line-height: 1.45;
            overflow-wrap: anywhere;
        }
        .staff-meta strong {
            display: block;
            color: #fff;
            font-size: 14px;
        }
        .logout-form {
            margin: 0;
        }
        .logout-btn {
            width: 100%;
            min-height: 42px;
            border: 0;
            border-radius: 8px;
            padding: 10px 12px;
            background: rgba(220,38,38,.18);
            color: #fecaca;
            font-weight: 800;
            text-align: left;
            cursor: pointer;
        }
        .logout-btn:hover {
            background: rgba(220,38,38,.28);
            color: #fff;
        }
        .admin-main {
            min-width: 0;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            min-height: 72px;
            padding: 16px 28px;
            background: rgba(255,255,255,.92);
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            position: sticky;
            top: 0;
            z-index: 5;
        }
        .page-title {
            margin: 0;
            font-size: 24px;
            line-height: 1.25;
        }
        .page-subtitle {
            color: var(--muted);
            font-size: 14px;
            margin-top: 4px;
        }
        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-weight: 700;
            white-space: nowrap;
        }
        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #d8f3ee;
            color: var(--brand-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }
        .content {
            padding: 28px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: var(--shadow);
        }
        .card-body { padding: 22px; }
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }
        .search-input,
        .form-control,
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            min-height: 42px;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 10px 12px;
            background: #fff;
            color: var(--ink);
            outline: none;
        }
        .search-input { max-width: 330px; }
        .form-grid {
            display: grid;
            gap: 16px;
            max-width: 720px;
        }
        .form-label {
            display: block;
            font-weight: 700;
            margin-bottom: 7px;
        }
        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            padding: 13px 14px;
            border-bottom: 1px solid var(--line);
            text-align: left;
            vertical-align: middle;
            white-space: nowrap;
        }
        th {
            background: #f8fafc;
            color: #40506a;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #f9fbff; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 38px;
            border: 0;
            border-radius: 8px;
            padding: 9px 14px;
            font-weight: 700;
            cursor: pointer;
            background: #edf2f7;
            color: var(--ink);
        }
        .btn-primary { background: var(--brand); color: #fff; }
        .btn-primary:hover { background: var(--brand-dark); }
        .btn-info { background: var(--accent); color: #fff; }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-sm { min-height: 34px; padding: 7px 10px; font-size: 13px; }
        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .actions form { margin: 0; }
        .badge {
            display: inline-flex;
            align-items: center;
            min-height: 26px;
            padding: 4px 9px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
        }
        .bg-success { background: #dcfce7; color: var(--success); }
        .bg-warning { background: #fef3c7; color: var(--warning); }
        .bg-danger { background: #fee2e2; color: var(--danger); }
        .text-muted { color: var(--muted); }
        .empty-cell {
            padding: 34px 16px;
            text-align: center;
            color: var(--muted);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(160px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        .stat-card {
            padding: 18px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: var(--shadow);
        }
        .stat-label {
            color: var(--muted);
            font-weight: 700;
            font-size: 13px;
        }
        .stat-value {
            font-size: 28px;
            font-weight: 800;
            margin-top: 10px;
        }

        @media (max-width: 920px) {
            .admin-shell { grid-template-columns: 1fr; }
            .admin-sidebar {
                position: static;
                height: auto;
                padding: 18px;
            }
            .nav-list {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 4px;
            }
            .topbar { align-items: flex-start; }
            .content { padding: 18px; }
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 560px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .nav-list,
            .stats-grid { grid-template-columns: 1fr; }
            .toolbar { align-items: stretch; }
            .toolbar .btn,
            .search-input { width: 100%; max-width: none; }
        }
    </style>
</head>
<body>
<div class="admin-shell">
    <aside class="admin-sidebar">
        <div class="brand-block">
            <div class="brand-title">Phone Store</div>
            <div class="brand-subtitle">Quan ly cua hang dien thoai</div>
        </div>

        <nav class="nav-list">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                San pham
            </a>
            <a class="nav-link {{ request()->routeIs('brands.*') ? 'active' : '' }}" href="{{ route('brands.index') }}">
                Thuong hieu
            </a>
            <a class="nav-link {{ request()->routeIs('productTypes.*') ? 'active' : '' }}" href="{{ route('productTypes.index') }}">
                Loai san pham
            </a>
            <a class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                Khach hang
            </a>
            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                Don hang
            </a>
            <a class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}" href="{{ route('payments.index') }}">
                Thanh toan
            </a>
            <a class="nav-link {{ request()->routeIs('statuses.*') ? 'active' : '' }}" href="{{ route('statuses.index') }}">
                Trang thai
            </a>
            <a class="nav-link {{ request()->routeIs('configurations.*') ? 'active' : '' }}" href="{{ route('configurations.index') }}">
                Cau hinh
            </a>
        </nav>

        <div class="sidebar-footer">
            @php($staff = Auth::guard('staff')->user())
            <div class="staff-meta">
                <strong>{{ $staff->staff_name ?? $staff->name ?? 'Admin' }}</strong>
                {{ $staff->email ?? 'admin@phonestore.local' }}
            </div>
            <form method="POST" action="{{ route('staffs.logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Dang xuat</button>
            </form>
        </div>
    </aside>

    <main class="admin-main">
        <header class="topbar">
            <div>
                <h1 class="page-title">@yield('title', 'Quan tri')</h1>
                <div class="page-subtitle">@yield('subtitle', 'Quan ly du lieu va hoat dong cua cua hang')</div>
            </div>
            <div class="topbar-user">
                <span class="avatar">AD</span>
                <span>{{ $staff->staff_name ?? $staff->name ?? 'Admin' }}</span>
            </div>
        </header>

        <section class="content">
            @if(session('success'))
                <div class="card" style="margin-bottom: 16px; border-color: #bbf7d0;">
                    <div class="card-body" style="color: var(--success); font-weight: 700;">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </section>
    </main>
</div>
</body>
</html>
