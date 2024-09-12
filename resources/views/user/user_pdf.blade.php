<h1>Daftar user</h1>
<h3>berikut merupakan daftar user yang ada di LontarCinema</h3>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>nama</th>
    <th>username</th>
    <th>role</th>
    <th>Tanggal</th>
</tr>
@foreach ($user as $data)
<tr>
    <td>{{ $data->nama }}</td>
    <td>{{ $data->username }}</td>
    <td>{{ $data->role }}</td>
    <td>{{ $data->created_at }}</td>
</tr>
@endforeach
</table>
<h4 style="margin-bottom: 5px;"><u>Eben Hezer Wangsa Djaja</u></h4>
<p style="margin-top: 5px;">Founder LontaCinema</p>