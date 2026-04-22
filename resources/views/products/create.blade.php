<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<form action="{{ route('products.create') }}" method="POST">
    @csrf
    Name: <input type="text" name="name"><br>
    Price: <textarea name="price"></textarea><br>
    Stock Quantity: <textarea name="stock_quantity"></textarea><br>
    Brand: <select name="brand_id">
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}">
                {{ $brand->brand_name }}
            </option>
        @endforeach
    </select><br>
    Type: <select name="product_type_id">
        @foreach($product_types as $producttype)
            <option value="{{ $producttype->id }}">
                {{ $producttype->product_type_name }}
            </option>
        @endforeach
    </select><br>
    <button>Add</button>
</form>
</body>
</html>
