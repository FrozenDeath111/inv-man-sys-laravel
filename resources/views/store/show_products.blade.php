<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Product</title>
</head>
<body>
    <h1>Product List</h1>
    <table>
        <thead>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Store Stock</th>
            <th>Sale Stock</th>
            <th>Warehouse Stock</th>
        </thead>
        <tbody>
            @foreach ($storeProducts as $product)
                <tr>
                    <td>{{$product->product_id}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->in_stock}}</td>
                    <td>{{$product->sale_stock}}</td>
                    <td>{{$product->warehouse_stock}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="/request-stock" method="POST">
        <select name="product_id">
            @foreach ($storeProducts as $product)
                <option value={{$product->product_id}}>{{$product->product_name}}</option>
            @endforeach
        </select>
        <label for="request_stock">Request Amount</label>
        <input id="request_stock" type="number" name="requested_stock" placeholder="Stock Quantity">
        <button type="submit">Request</button>
    </form>
    <form action="/sale-stock" method="POST">
        <select name="product_id">
            @foreach ($storeProducts as $product)
                <option value={{$product->product_id}}>{{$product->product_name}}</option>
            @endforeach
        </select>
        <label for="sale-stock">Sale Amount</label>
        <input id="sale_stock" type="number" name="sale_stock" placeholder="Stock Quantity">
        <button type="submit">Sale</button>
    </form>
    @if (session()->has('success'))
        {{ session()->get('success') }}
    @endif
    @if (session()->has('error'))
        {{ session()->get('error') }}
    @endif
</body>
</html>