<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Products</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Stocks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{$product['id']}}</td>
                <td><a href="/show-product/{{$product['id']}}">{{$product['name']}}</a></td>
                <td>{{$product['category']}}</td>
                <td>
                    @foreach ($product->stocks as $stock)
                        @foreach ($stock as $item)
                        {{$item->warehouse_id}}-{{$item->warehouse_stock}}
                        @endforeach
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="/admin/add-stock" method="POST">
        <select name="product_id">
            @foreach ($products as $product)
                <option value={{$product->id}}>{{$product->name}}</option>
            @endforeach
        </select>
        <select name="warehouse_name">
            @foreach ($warehouses as $warehouse)
                <option value={{$warehouse->warehouse_name}}>{{$warehouse->warehouse_name}}</option>
            @endforeach
        </select>
        <label for="quantity">Quantity</label>
        <input type="text" id="quantitry" name="quantity" placeholder="Quantity">
        <button type="submit">Submit</button>
    </form>
    @if (session()->has('success'))
        {{ session()->get('success') }}
    @endif
    @if (session()->has('error'))
        {{ session()->get('error') }}
    @endif
</body>
</html>