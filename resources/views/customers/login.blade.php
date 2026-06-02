@extends('layouts.shop')

@section('title', 'Dang nhap khach hang - Phone Store')

@section('content')
    <div class="panel" style="max-width: 460px; margin: 28px auto; padding: 24px;">
        <div style="margin-bottom: 20px;">
            <h2 style="margin: 0 0 8px;">Dang nhap khach hang</h2>
            <div style="color: var(--muted); font-weight: 700;">Dang nhap de mua hang va theo doi gio hang.</div>
        </div>

        @if(session('success'))
            <div style="margin-bottom: 14px; padding: 12px; border-radius: 8px; background: #dcfce7; color: var(--success); font-weight: 800;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="margin-bottom: 14px; padding: 12px; border-radius: 8px; background: #fee2e2; color: var(--danger); font-weight: 800;">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('customer.login') }}">
            @csrf
            <div style="margin-bottom: 14px;">
                <label for="email" style="display: block; font-weight: 900; margin-bottom: 7px;">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div style="margin-bottom: 18px;">
                <label for="password" style="display: block; font-weight: 900; margin-bottom: 7px;">Mat khau</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Dang nhap</button>
        </form>

        <div style="margin-top: 16px; text-align: center; color: var(--muted); font-weight: 800;">
            Chua co tai khoan?
            <a href="{{ route('customer.register') }}" style="color: var(--orange-dark);">Dang ky ngay</a>
        </div>
    </div>
@endsection
