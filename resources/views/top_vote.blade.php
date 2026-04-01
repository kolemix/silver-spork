<!DOCTYPE html>
<html>
<head>
    <title>Top 10 phim điểm cao nhất</title>
</head>
<body>

<h1>Top 10 phim có điểm bình chọn cao nhất</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>STT</th>
        <th>Tên phim</th>
        <th>Ngày phát hành</th>
        <th>Điểm đánh giá</th>
    </tr>

    @foreach($movies as $index => $m)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $m->movie_name }}</td>
        <td>{{ \Carbon\Carbon::parse($m->release_date)->format('d/m/Y') }}</td>
        <td>{{ $m->vote_average }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>