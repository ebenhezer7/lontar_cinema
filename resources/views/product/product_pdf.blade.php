<h1>Daftar Studio</h1>
<h3>berikut merupakan daftar studio yang ada di LontarCinema</h3>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Judul Film</th>
    <th>Harga</th>
    <th>Jam Tayang</th>
    <th>Tanggal</th>
</tr>
@foreach ($product as $data)
<tr>
    <td>{{ $data->nama_produk }}</td>
    <td>{{ $data->harga_produk }}</td>
    <td>{{ $data->jam_tayang }}</td>
    <td>{{ $data->created_at }}</td>
</tr>
@endforeach
</table>
<h4 style="margin-bottom: 5px;"><u>Eben Hezer Wangsa Djaja</u></h4>
<p style="margin-top: 5px;">Founder LontaCinema</p>