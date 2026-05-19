<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h3>Product Type List</h3>
<a href="{{ route('productTypes.create') }}">Add a product type</a>
<table border="1px" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Name</th>

    </tr>
    @foreach($productTypes as $productType)
        <tr>
            <td>
                {{ $productType->id }}
            </td>
            <td>
                {{ $productType->product_type_name }}
            </td>
            <td>
                <a href="{{ route('productTypes.edit', $productType->id) }}">Edit</a>
            </td>
            <td>
                <form method="post" action="{{ route('productTypes.destroy', $productType->id) }}">
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
