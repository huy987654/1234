<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomerAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('customers.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6|confirmed',
        ]);

        Customer::create([
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return Redirect::route('customer.login')->with('success', 'Dang ky thanh cong. Vui long dang nhap.');
    }

    public function showLoginForm()
    {
        return view('customers.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();

            return Redirect::route('shop.home')->with('success', 'Dang nhap thanh cong.');
        }

        return Redirect::back()->with('error', 'Sai email hoac mat khau.');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('shop.home')->with('success', 'Dang xuat thanh cong.');
    }
}
