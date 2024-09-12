<h1>Daftar Studio</h1>
<h3>berikut merupakan daftar studio yang ada di LontarCinema</h3>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Studio</th>
    <th>Tanggal</th>
</tr>
@foreach ($studio as $data)
<tr>
    <td>{{ $data->studio }}</td>
    <td>{{ $data->created_at }}</td>
</tr>
@endforeach
</table>