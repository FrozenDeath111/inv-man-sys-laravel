<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory</title>
</head>
<body>
    @php
        if(isset($username)){
            echo "welcome ".$username;
        }
    @endphp
    <br>
    <a href="/dashboard">Dashboard</a>
    <br>
    <a href="/logout">Logout</a>
    <br>
    @if (isset($error))
        <h1>{{$error}}</h1>
    @endif
</body>
</html>