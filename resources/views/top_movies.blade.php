<!DOCTYPE html>
<html>
<head>
    <title>Top 10 Movies</title>
</head>
<body>

<h2>Top 10 phim có doanh thu cao nhất</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>STT</th>
        <th>Tên phim</th>
        <th>Ngày phát hành</th>
        <th>Doanh thu</th>
    </tr>

    @foreach($movies as $index => $movie)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $movie->movie_name }}</td>
        <td>{{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}</td>
        <td>{{ number_format($movie->budget) }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>