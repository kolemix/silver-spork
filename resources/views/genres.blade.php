<!DOCTYPE html>
<html>
<head>
    <title>Danh sách thể loại phim</title>
</head>
<body>

<h1>Danh sách thể loại phim</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>STT</th>
        <th>Tên thể loại</th>
        <th>Tên tiếng Việt</th>
    </tr>

    @foreach($data as $index => $item)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->genre_name }}</td>
        <td>{{ $item->genre_name_vn }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>