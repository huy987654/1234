@extends('layouts.shop')

@section('title', 'Dang ky khach hang - Phone Store')

@section('content')
    <div class="panel" style="max-width: 520px; margin: 28px auto; padding: 24px;">
        <div style="margin-bottom: 20px;">
            <h2 style="margin: 0 0 8px;">Dang ky khach hang</h2>
            <div style="color: var(--muted); font-weight: 700;">Tao tai khoan de mua dien thoai nhanh hon.</div>
        </div>

        @if($errors->any())
            <div style="margin-bottom: 14px; padding: 12px; border-radius: 8px; background: #fee2e2; color: var(--danger); font-weight: 800;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('customer.register') }}">
            @csrf
            <div style="margin-bottom: 14px;">
                <label for="customer_name" style="display: block; font-weight: 900; margin-bottom: 7px;">Ho ten</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required>
            </div>

            <div style="margin-bottom: 14px;">
                <label for="phone" style="display: block; font-weight: 900; margin-bottom: 7px;">So dien thoai</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
            </div>

            <div style="margin-bottom: 14px;">
                <label for="email" style="display: block; font-weight: 900; margin-bottom: 7px;">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div style="margin-bottom: 14px;">
                <label for="password" style="display: block; font-weight: 900; margin-bottom: 7px;">Mat khau</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div style="margin-bottom: 18px;">
                <label for="password_confirmation" style="display: block; font-weight: 900; margin-bottom: 7px;">Xac nhan mat khau</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Dang ky</button>
        </form>

        <div style="margin-top: 16px; text-align: center; color: var(--muted); font-weight: 800;">
            Da co tai khoan?
            <a href="{{ route('customer.login') }}" style="color: var(--orange-dark);">Dang nhap</a>
        </div>
    </div>
@endsection
