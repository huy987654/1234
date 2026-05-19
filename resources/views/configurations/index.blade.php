<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h2>Danh sách Customers</h2>
    <a href="{{ route('configurations.create') }}">Thêm mới Config</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Cpu</th>
            <th>Ram</th>
            <th>Storage</th>
            <th>Gpu</th>
            <th>Screen</th>
            <th>Os</th>
            <th>Battery</th>
            <th>Camera</th>
            <th>Connect</th>
            <th>Other function</th>
            <th>Actions</th>
        </tr>
        @foreach($configurations as $configuration)
            <tr>
                <td>{{ $configuration->id }}</td>
                <td>{{ $configuration->cpu }}</td>
                <td>{{ $configuration->ram }}</td>
                <td>{{ $configuration->storage }}</td>
                <td>{{ $configuration->gpu }}</td>
                <td>{{ $configuration->screen }}</td>
                <td>{{ $configuration->os }}</td>
                <td>{{ $configuration->battery }}</td>
                <td>{{ $configuration->camera }}</td>
                <td>{{ $configuration->connect }}</td>
                <td>{{ $configuration->other_function }}</td>
                <td>
                    <a href="{{ route('configurations.edit', $configuration->id) }}">Edit</a> |
                    <form action="{{ route('configurations.destroy', $configuration->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table></body>
</html>
