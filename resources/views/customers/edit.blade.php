<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h3>Sửa Customer</h3>
<form action="{{ route('customers.update', $customer->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Tên:</label>
    <input type="text" name="name" value="{{ $customer->name }}"><br><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ $customer->email }}"><br><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="{{ $customer->phone }}"><br><br>

    <label>Password:</label>
    <input type="text" name="password" value="{{ $customer->password }}"><br><br>

    <button type="submit">Update</button>
</form>
</body>
</html>
