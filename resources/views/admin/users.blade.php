@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
    <h2>Danh sách người dùng</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
        </tr>
        <!-- Ví dụ dữ liệu -->
        <tr>
            <td>1</td>
            <td>Nguyễn Văn A</td>
            <td>a@example.com</td>
        </tr>
    </table>
@endsection
