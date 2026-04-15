<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h3>Thêm Customer</h3>
<form action="{{ route('customers.store') }}" method="POST">
    @csrf
    <label>Tên:</label>
    <input type="text" name="name"><br><br>

    <label>Email:</label>
    <input type="email" name="email"><br><br>

    <label>Phone:</label>
    <input type="text" name="phone"><br><br>

    <label>Password:</label>
    <input type="text" name="password"><br><br>

    <button type="submit">Save</button>
</form>
</body>
</html>
