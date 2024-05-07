<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <h1>Store Manager Dashboard ({{session()->get('username')}})</h1>
    <ul>
        <li>
            <a href="/store/show-products">Show Products</a>
        </li>
        <li>
            <a href="/store/to-add-products">Add Products</a>
        </li>
    </ul>
</body>
</html>