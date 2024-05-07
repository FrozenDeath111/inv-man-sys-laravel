<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Form</title>
</head>
<body>
    <h1>Product Form</h1>
    <form action="/admin/create-product" method="post">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="category" placeholder="Category">
        <input type="text" name="description" placeholder="Description">
        <select name="warehouse_id">
            @foreach ($warehouses as $warehouse)
                <option value={{$warehouse['id']}}>
                    {{$warehouse['warehouse_name']}}
                </option>
            @endforeach
        </select>
        <input type="number" name="quantity" placeholder="Quantity">
        <button type="submit">Submit</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session()->has('success'))
        {{ session()->get('success') }}
    @endif
    @if (session()->has('error'))
        {{ session()->get('error') }}
    @endif
</body>
</html>