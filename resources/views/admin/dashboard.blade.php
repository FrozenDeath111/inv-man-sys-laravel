<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard ({{session()->get('username')}})</h1>
    <ul>
        <li>
            <a href="/admin/user-form">Create User</a>
        </li>
        <li>
            <a href="/admin/show-user">Show User</a>
        </li>
        <li>
            <a href="/admin/product-form">Create Product</a>
        </li>
        <li>
            <a href="/admin/show-products">Show Products</a>
        </li>
        <li>
            <a href="/admin/show-requests">Show Requests</a>
        </li>
    </ul>
</body>
</html>