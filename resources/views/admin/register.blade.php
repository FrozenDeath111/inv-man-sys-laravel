<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <h1>Register Form</h1>
    <form action="/admin/register" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <select name="role">
            <option value="2">Warehouse Staff</option>
            <option value="3">Store Manager</option>
        </select>
        <select name="job_place">
            @foreach ($job_place as $place)
                <option value={{$place}}>{{$place}}</option>
            @endforeach
        </select>
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