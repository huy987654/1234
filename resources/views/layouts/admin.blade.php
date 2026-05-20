<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('brands.index') }}">Brands</a></li>
            <li><a href="{{ route('products.index') }}">Products</a></li>
            <li><a href="{{ route('admin.users') }}">Users</a></li>
        </ul>
    </aside>

    <!-- Nội dung chính -->
    <main class="content">
        @yield('content')
    </main>
</div>

<!-- Footer -->
<footer>
    <p>&copy; {{ date('Y') }} My Project</p>
</footer>
</body>
</html>
