<!DOCTYPE html>
<html>

<head>
    <title>Visitor Stats</title>
</head>

<body>
    <h1>Visitor Stats</h1>

    <h2>Unique Visitors</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>IP Address</th>
                <th>Last Page</th>
                <th>Visited At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->id }}</td>
                    <td>{{ $visitor->ip_address }}</td>
                    <td>{{ $visitor->last_page }}</td>
                    <td>{{ $visitor->visited_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Page Visits</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Page</th>
                <th>Visits</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pageVisits as $pageVisit)
                <tr>
                    <td>{{ $pageVisit->page }}</td>
                    <td>{{ $pageVisit->visits }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
