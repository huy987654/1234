<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h3>Brand List</h3>
<a href="{{ route('brands.create') }}">Add a brand</a>
<table border="1px" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th></th>
        <th></th>
    </tr>
    @foreach($brands as $brand)
        <tr>
            <td>
                {{ $brand->id }}
            </td>
            <td>
                {{ $brand->brand_name }}
            </td>
            <td>
                <a href="{{ route('brands.edit', $brand->id) }}">Edit</a>
            </td>
            <td>
                <form method="post" action="{{ route('brands.destroy', $brand->id) }}">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
