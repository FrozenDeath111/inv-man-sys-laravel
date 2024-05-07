<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Requests</title>
</head>
<body>
    <table>
        <thead>
            <th>Product ID</th>
            <th>Storage</th>
            <th>Asked By</th>
            <th>Quantity</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td>{{$history->product_id}}</td>
                    <td>{{$history->storage}}</td>
                    <td>{{$history->handled_by}}</td>
                    <td>{{$history->quantity}}</td>
                    <td>
                    <form action="/accept-request" method="post">
                    <select name="warehouse_name">
                        @foreach ($warehouses as $warehouse)
                            <option value={{$warehouse->warehouse_name}}>{{$warehouse->warehouse_name}}</option>
                        @endforeach
                    </select>
                    <input type="text" name="history_id" hidden value={{$history->id}}>
                    <button type="submit">Accept</button>
                    </form>
                    <a href="/reject-request/{{$history->id}}">Reject</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (session()->has('success'))
        {{ session()->get('success') }}
    @endif
    @if (session()->has('error'))
        {{ session()->get('error') }}
    @endif
</body>
</html>