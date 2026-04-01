<!DOCTYPE html>
<html>
<head>
    <title>Top 10 phim thời lượng > 120 phút</title>
</head>
<body>

<h1>Top 10 phim có thời lượng lớn hơn 120 phút</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>STT</th>
        <th>Tên phim</th>
        <th>Ngày phát hành</th>
        <th>Thời lượng (phút)</th>
    </tr>

    @foreach($movies as $index => $m)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $m->movie_name }}</td>
        <td>{{ \Carbon\Carbon::parse($m->release_date)->format('d/m/Y') }}</td>
        <td>{{ $m->runtime }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>