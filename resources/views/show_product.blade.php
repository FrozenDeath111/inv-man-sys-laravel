<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    @if (isset($product))
        <h3>Product ID: {{$product['id']}}</h3>
        <h3>Product Name: {{$product['name']}}</h3>
        <h3>Product Category: {{$product['category']}}</h3>
        <p>Product Description: {{$product['description']}}</p>
    @else
        <h1>Not Available</h1>
    @endif
</body>
</html>