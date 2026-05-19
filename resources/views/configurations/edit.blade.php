<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h3>Sửa Config</h3>
<form action="{{ route('configurations.update', $configuration->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Cpu:</label>
    <input type="text" name="cpu" value="{{ $configuration->cpu }}"><br><br>

    <label>Ram:</label>
    <input type="text" name="ram" value="{{ $configuration->ram }}"><br><br>

    <label>Storage:</label>
    <input type="text" name="storage" value="{{ $configuration->storage }}"><br><br>

    <label>Gpu:</label>
    <input type="text" name="gpu" value="{{ $configuration->gpu }}"><br><br>

    <label>Screen:</label>
    <input type="text" name="screen" value="{{ $configuration->screen }}"><br><br>

    <label>Os:</label>
    <input type="text" name="os" value="{{ $configuration->os }}"><br><br>

    <label>Battery:</label>
    <input type="text" name="battery" value="{{ $configuration->battery }}"><br><br>

    <label>Camera:</label>
    <input type="text" name="camera" value="{{ $configuration->camera }}"><br><br>

    <label>Connect:</label>
    <input type="text" name="connect" value="{{ $configuration->connect }}"><br><br>

    <label>Other function:</label>
    <input type="text" name="other_function" value="{{ $configuration->other_function }}"><br><br>

    <button type="submit">Update</button>
</form>
</body>
</html>
