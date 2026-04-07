<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h3>Update a brand</h3>
<form method="post" action="{{route('brands.update', $brand->id)}}">
    @csrf
    @method('PUT')
    Name: <input type="text" name="name" value="{{ $brand->name }}"><br>
    <button>Update</button>
</form>
</body>
</html>
