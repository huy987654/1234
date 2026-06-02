<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Phone Store')</title>
    <style>
        :root {
            --orange: #f97316;
            --orange-dark: #ea580c;
            --orange-soft: #fff7ed;
            --orange-line: #fed7aa;
            --white: #ffffff;
            --bg: #f6f7f9;
            --text: #1f2937;
            --muted: #6b7280;
            --line: #e5e7eb;
            --danger: #dc2626;
            --success: #16a34a;
            --shadow: 0 12px 30px rgba(31, 41, 55, .08);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text);
            background: var(--bg);
        }
        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }
        input,
        select,
        textarea {
            width: 100%;
            min-height: 42px;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 10px 12px;
            background: #fff;
            color: var(--text);
            outline: none;
        }
        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, .12);
        }
        .container {
            width: min(1180px, calc(100% - 28px));
            margin: 0 auto;
        }
        .site-header {
            background: var(--orange);
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 8px 24px rgba(249, 115, 22, .24);
        }
        .header-inner {
            min-height: 68px;
            display: grid;
            grid-template-columns: 190px 1fr auto auto;
            gap: 14px;
            align-items: center;
        }
        .logo {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: .2px;
        }
        .cart-link,
        .login-link,
        .logout-shop-btn {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            padding: 9px 12px;
            background: rgba(255,255,255,.16);
            color: #fff;
            font-weight: 800;
            white-space: nowrap;
        }
        .logout-shop-btn {
            border: 0;
            cursor: pointer;
        }
        .customer-area {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .customer-name {
            color: #fff;
            font-weight: 800;
            white-space: nowrap;
        }
        .search-box {
            position: relative;
        }
        .search-box input {
            width: 100%;
            min-height: 42px;
            border: 0;
            border-radius: 8px;
            padding: 0 15px;
            outline: none;
            color: var(--text);
        }
        .subnav {
            background: #fff;
            border-bottom: 1px solid var(--line);
        }
        .subnav-inner {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 10px 0;
        }
        .subnav a {
            padding: 8px 12px;
            border-radius: 999px;
            background: var(--orange-soft);
            color: var(--orange-dark);
            font-weight: 800;
            white-space: nowrap;
        }
        main { padding: 18px 0 34px; }
        .hero-grid {
            display: grid;
            grid-template-columns: 230px 1fr 240px;
            gap: 14px;
            margin-bottom: 16px;
        }
        .panel {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: var(--shadow);
        }
        .side-menu {
            padding: 10px;
        }
        .side-menu a {
            display: block;
            padding: 11px 12px;
            border-radius: 8px;
            font-weight: 800;
            color: #334155;
        }
        .side-menu a:hover { background: var(--orange-soft); color: var(--orange-dark); }
        .hero-banner {
            min-height: 260px;
            padding: 28px;
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            align-items: center;
            background: linear-gradient(135deg, #fff 0%, #fff7ed 48%, #fed7aa 100%);
            overflow: hidden;
        }
        .hero-eyebrow {
            color: var(--orange-dark);
            font-weight: 900;
            margin-bottom: 8px;
        }
        .hero-title {
            margin: 0;
            font-size: 36px;
            line-height: 1.15;
        }
        .hero-copy {
            color: var(--muted);
            font-weight: 700;
            margin: 12px 0 18px;
        }
        .hero-phone {
            justify-self: center;
            width: 150px;
            height: 210px;
            border-radius: 24px;
            background: #111827;
            border: 9px solid #374151;
            box-shadow: 24px 24px 0 rgba(249,115,22,.18);
            position: relative;
        }
        .hero-phone:before {
            content: "";
            position: absolute;
            left: 50%;
            top: 10px;
            width: 48px;
            height: 8px;
            border-radius: 999px;
            background: #4b5563;
            transform: translateX(-50%);
        }
        .promo-stack {
            display: grid;
            gap: 14px;
        }
        .promo-box {
            padding: 18px;
            min-height: 123px;
            background: #fff;
            border: 1px solid var(--orange-line);
            border-radius: 8px;
        }
        .promo-box strong {
            color: var(--orange-dark);
            display: block;
            margin-bottom: 8px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            border: 0;
            border-radius: 8px;
            padding: 9px 13px;
            background: #eef2f7;
            color: var(--text);
            font-weight: 900;
            cursor: pointer;
        }
        .btn-primary {
            background: var(--orange);
            color: #fff;
        }
        .btn-primary:hover { background: var(--orange-dark); }
        .trust-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }
        .trust-item {
            padding: 14px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 8px;
            font-weight: 900;
        }
        .trust-item span {
            display: block;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
            margin-top: 5px;
        }
        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 12px;
            margin: 18px 0 12px;
        }
        .section-head h2 {
            margin: 0;
            font-size: 24px;
        }
        .filter-pills {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .filter-pills span {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 8px 11px;
            font-weight: 800;
            color: #475569;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }
        .product-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 14px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            min-height: 330px;
        }
        .product-thumb {
            height: 150px;
            border-radius: 8px;
            background: linear-gradient(145deg, #f8fafc, #fff7ed);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }
        .phone-art {
            width: 76px;
            height: 118px;
            border-radius: 18px;
            background: linear-gradient(145deg, #111827, #374151);
            border: 6px solid #4b5563;
            box-shadow: 13px 13px 0 rgba(249,115,22,.18);
        }
        .product-name {
            min-height: 44px;
            color: #111827;
            font-weight: 900;
            line-height: 1.35;
            margin-bottom: 8px;
        }
        .product-meta {
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .price {
            color: var(--danger);
            font-size: 20px;
            font-weight: 900;
            margin-bottom: 10px;
        }
        .tag-row {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 12px;
        }
        .tag {
            border-radius: 999px;
            background: var(--orange-soft);
            color: var(--orange-dark);
            padding: 5px 8px;
            font-size: 12px;
            font-weight: 900;
        }
        .product-actions {
            margin-top: auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 8px;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-table th,
        .cart-table td {
            padding: 14px;
            border-bottom: 1px solid var(--line);
            text-align: left;
            vertical-align: middle;
        }
        .cart-table th {
            color: #475569;
            background: #f8fafc;
            font-size: 13px;
            text-transform: uppercase;
        }
        .qty-control {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .qty-control input {
            width: 58px;
            min-height: 36px;
            border: 1px solid var(--line);
            border-radius: 8px;
            text-align: center;
        }
        .cart-summary {
            margin-top: 16px;
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
        }
        .total-price {
            font-size: 24px;
            font-weight: 900;
            color: var(--danger);
        }
        .empty {
            padding: 34px 16px;
            text-align: center;
            color: var(--muted);
            font-weight: 800;
        }

        @media (max-width: 980px) {
            .header-inner { grid-template-columns: 1fr; padding: 12px 0; }
            .customer-area { justify-content: flex-start; }
            .hero-grid { grid-template-columns: 1fr; }
            .trust-row,
            .product-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 560px) {
            .hero-banner { grid-template-columns: 1fr; }
            .hero-title { font-size: 28px; }
            .trust-row,
            .product-grid { grid-template-columns: 1fr; }
            .section-head { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a href="{{ route('shop.home') }}" class="logo">Phone Store</a>
        <form class="search-box" method="GET" action="{{ route('shop.home') }}">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Ban can tim dien thoai nao?">
        </form>
        <a href="{{ route('carts.index') }}" class="cart-link">
            Gio hang
            @php($cartCount = collect(session('carts', []))->sum('quantity'))
            @if($cartCount > 0)
                ({{ $cartCount }})
            @endif
        </a>
        <div class="customer-area">
            @php($customer = Auth::guard('customer')->user())
            @if($customer)
                <span class="customer-name">{{ $customer->customer_name }}</span>
                <a href="{{ route('orders.history') }}" class="login-link">Don hang</a>
                <form method="POST" action="{{ route('customer.logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-shop-btn">Dang xuat</button>
                </form>
            @else
                <a href="{{ route('customer.login') }}" class="login-link">Dang nhap</a>
                <a href="{{ route('customer.register') }}" class="login-link">Dang ky</a>
            @endif
        </div>
    </div>
</header>

<nav class="subnav">
    <div class="container subnav-inner">
        <a href="{{ route('shop.home') }}">Trang chu</a>
        <a href="{{ route('shop.home') }}#products">Dien thoai</a>
        <a href="{{ route('shop.home') }}#products">Phu kien</a>

        <a href="{{ route('orders.history') }}">Don hang</a>
        <a href="{{ route('carts.index') }}">Gio hang</a>
    </div>
</nav>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>
</body>
</html>
