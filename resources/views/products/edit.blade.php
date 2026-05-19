<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
</head>
<body>
<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    Name: <input type="text" name="product_name" value="{{ $product->product_name }}"><br>

    Price: <input type="number" name="price" value="{{ $product->price }}"><br>

    Stock: <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}"><br>

    Brand: <select name="brand_id">
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}"
                    @if($brand->id == $product->brand_id) selected @endif>
                {{ $brand->brand_name }}
            </option>
        @endforeach
    </select><br>

    Type: <select name="product_type_id">
        @foreach($product_types as $producttype)
            <option value="{{ $producttype->id }}"
                    @if($producttype->id == $product->product_type_id) selected @endif>
                {{ $producttype->product_type_name }}
            </option>
        @endforeach
    </select><br>

    <button>Update</button>
</form>
</body>
</html>
