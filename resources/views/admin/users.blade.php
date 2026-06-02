@extends('layouts.admin')

@section('title', 'Quan ly nguoi dung')
@section('subtitle', 'Danh sach tai khoan quan tri mau')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ten</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Nguyen Van A</td>
                        <td>a@example.com</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
