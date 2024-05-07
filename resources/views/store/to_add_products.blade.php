<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Possible to Add Products</title>
</head>
<body>
    <h1>Possible to Add Products</h1>
    <ul>
    @foreach ($products as $product)
        <li>{{$product->name}} 
            <a href="/add-product/{{$product->id}}/{{$store_id}}">
                Add
            </a>
        </li>
    @endforeach
    </ul>
    @if (session()->has('success'))
        {{ session()->get('success') }}
    @endif
    @if (session()->has('error'))
        {{ session()->get('error') }}
    @endif
</body>
</html>