<h1>Daftar Products</h1>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>kursi</th>
    <th>Tanggal</th>
</tr>
@foreach ($kursi as $data)
<tr>
    <td>{{ $data->kode_kursi }}</td>
    <td>{{ $data->created_at }}</td>
</tr>
@endforeach
</table>
<h4 style="margin-bottom: 5px;"><u>Eben Hezer Wangsa Djaja</u></h4>
<p style="margin-top: 5px;">Founder LontaCinema</p>