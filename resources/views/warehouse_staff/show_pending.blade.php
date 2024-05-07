<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pending</title>
</head>
<body>
    <table>
        <thead>
            <th>Product ID</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($pendings as $pending)
                <tr>
                    <td>{{$pending->product_id}}</td>
                    <td>{{$pending->status}}</td>
                    <td>{{$pending->quantity}}</td>
                    <td>
                        @if ($pending->status == 'To Recieve')
                        <a href="/warehouse-staff/recieve-product/{{$pending->id}}">
                            Recieve
                        </a>
                        @else
                        <a href="/warehouse-staff/ship-product/{{$pending->id}}">
                            Ship
                        </a>
                        @endif
                        
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