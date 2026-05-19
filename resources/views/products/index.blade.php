<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shoes List</title>
</head>
<body>
<a href="{{ route('products.create') }}">Add a product</a>
<table border="1px" cellspacing="0" cellpadding="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Type</th>
        <th>Brand</th>

    </tr>
    @foreach($products as $product)
        <tr>
            <td>
                {{ $product->id }}
            </td>
            <td>
                {{ $product->product_name }}
            </td>
            <td>
                {{ $product->price }}
            </td>
            <td>
                {{ $product->stock_quantity }}
            </td>
            <td>
                {{ $product->product_type_name }}
            </td>
            <td>
                {{ $product->brand_name }}
            </td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>
            </td>
            <td>
                <form method="POST" action="{{ route('products.destroy', $product->id) }}">
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
