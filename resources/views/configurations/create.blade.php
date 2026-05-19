<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h3>Thêm Config</h3>
<form action="{{ route('configurations.store') }}" method="POST">
    @csrf
    <label>Cpu:</label>
    <input type="text" name="cpu"><br><br>

    <label>Ram:</label>
    <input type="text" name="ram"><br><br>

    <label>Storage:</label>
    <input type="text" name="storage"><br><br>

    <label>Gpu:</label>
    <input type="text" name="gpu"><br><br>

    <label>Screen:</label>
    <input type="text" name="screen"><br><br>

    <label>Os:</label>
    <input type="text" name="os"><br><br>

    <label>Battery:</label>
    <input type="text" name="battery"><br><br>

    <label>Camera:</label>
    <input type="text" name="camera"><br><br>

    <label>Connect:</label>
    <input type="text" name="connect"><br><br>

    <label>Other function:</label>
    <input type="text" name="other_function"><br><br>

    <button type="submit">Save</button>
</form>
</body>
</html>
