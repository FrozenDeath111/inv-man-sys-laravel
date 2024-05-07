<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($users))
                @foreach ($users as $user)
                <tr>
                    <td>{{$user['id']}}</td>
                    <td>{{$user['username']}}</td>
                    <td>
                    @switch($user['role'])
                        @case(1)
                            Admin
                            @break
                        @case(2)
                            Warehouse Staff
                            @break
                        @default
                            Store Manager
                    @endswitch
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>