<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h3>Payment List</h3>
<a href="{{ route('payments.create') }}">Add a payment</a>
<table border="1px" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th></th>
        <th></th>
    </tr>
    @foreach($payments as $payment)
        <tr>
            <td>
                {{ $payment->id }}
            </td>
            <td>
                {{ $payment->method }}
            </td>
            <td>
                <a href="{{ route('payments.edit', $payment->id) }}">Edit</a>
            </td>
            <td>
                <form method="post" action="{{ route('payments.destroy', $payment->id) }}">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
