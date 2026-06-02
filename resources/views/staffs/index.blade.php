<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dang nhap quan tri - Phone Store</title>
    <style>
        :root {
            --bg: #f4f7fb;
            --panel: #ffffff;
            --ink: #152033;
            --muted: #6d7890;
            --line: #e6ebf2;
            --brand: #0f766e;
            --brand-dark: #115e59;
            --danger: #dc2626;
            --shadow: 0 18px 45px rgba(21, 32, 51, .12);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--ink);
            background:
                linear-gradient(135deg, rgba(15,118,110,.12), rgba(37,99,235,.08)),
                var(--bg);
        }
        .login-card {
            width: min(430px, 100%);
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        .login-head {
            padding: 26px 28px;
            background: #10233f;
            color: #fff;
        }
        .login-head h1 {
            margin: 0;
            font-size: 24px;
        }
        .login-head p {
            margin: 8px 0 0;
            color: #b9c8e3;
            font-size: 14px;
        }
        .login-body {
            padding: 28px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        label {
            display: block;
            font-weight: 800;
            margin-bottom: 7px;
        }
        input {
            width: 100%;
            min-height: 44px;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 10px 12px;
            outline: none;
            color: var(--ink);
        }
        input:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(15,118,110,.12);
        }
        .btn-login {
            width: 100%;
            min-height: 44px;
            border: 0;
            border-radius: 8px;
            background: var(--brand);
            color: #fff;
            font-weight: 900;
            cursor: pointer;
        }
        .btn-login:hover {
            background: var(--brand-dark);
        }
        .alert {
            margin-bottom: 16px;
            padding: 12px;
            border-radius: 8px;
            background: #fee2e2;
            color: var(--danger);
            font-weight: 800;
        }
        .back-link {
            display: block;
            margin-top: 16px;
            text-align: center;
            color: var(--muted);
            text-decoration: none;
            font-weight: 800;
        }
    </style>
</head>
<body>
    <section class="login-card">
        <div class="login-head">
            <h1>Phone Store Admin</h1>
            <p>Dang nhap de quan ly cua hang dien thoai.</p>
        </div>

        <div class="login-body">
            @if(session('error'))
                <div class="alert">{{ session('error') }}</div>
            @endif

            <form action="{{ route('staffs.loginProcess') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Mat khau</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <button type="submit" class="btn-login">Dang nhap</button>
            </form>

            <a href="{{ route('shop.home') }}" class="back-link">Quay ve trang chu</a>
        </div>
    </section>
</body>
</html>
