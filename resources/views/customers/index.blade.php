<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h2>Danh sách Customers</h2>
    <a href="{{ route('customers.create') }}">Thêm mới Customer</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->customer_name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->password }}</td>
                <td>
                    <a href="{{ route('customers.edit', $customer->id) }}">Edit</a> |
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table></body>
</html>
