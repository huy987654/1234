<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<!-- Header -->
<header>
    <h1>Admin Panel</h1>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.users') }}">Users</a>
    </nav>
</header>

<!-- Nội dung động -->
<main>
    @yield('content')
</main>

<!-- Footer -->
<footer>
    <p>&copy; {{ date('Y') }} My Project</p>
</footer>
</body>
</html>
