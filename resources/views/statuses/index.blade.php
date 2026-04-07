<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h3>Status List</h3>
<a href="{{ route('statuses.create') }}">Add a status</a>
<table border="1px" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th></th>
        <th></th>
    </tr>
    @foreach($statuses as $status)
        <tr>
            <td>
                {{ $status->id }}
            </td>
            <td>
                {{ $status->status_name }}
            </td>
            <td>
                <a href="{{ route('statuses.edit', $status->id) }}">Edit</a>
            </td>
            <td>
                <form method="post" action="{{ route('statuses.destroy', $status->id) }}">
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
