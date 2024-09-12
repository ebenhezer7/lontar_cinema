<style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 5px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
        font-size: 10px;
        padding: 5px;
    }
    td {
        font-size: 9px;
        padding: 2px;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #ddd;
    }
    .text-right {
        text-align: right;
    }
</style>

<h1>Laporan Transaksi</h1>
<h3>berikut merupakan daftar transaksi yang ada di LontarCinema</h3>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Nomor Unik</th>
    <th>Nama Pelanggan</th>
    <th>Judul Film</th>
    <th>Kursi</th>
    <th>Harga Produk</th>
    <th>Uang Bayar</th>
    <th>Uang Kembali</th>
    <th>Tanggal</th>
</tr>
@foreach ($transaction as $data)
<tr>
    <td>{{ $data->nomor_unik }}</td>
    <td>{{ $data->nama_pelanggan }}</td>
    <td>{{ $data->nama_produk }}</td>
    <td>{{ $data->kode_kursi }}</td>
    <td style="text-align:right;">Rp.{{ number_format($data->harga_awal) }}</td>
    <td style="text-align:right;">Rp.{{ number_format($data->uang_bayar) }}</td>
    <td style="text-align:right;">Rp.{{ number_format($data->uang_kembali) }}</td>
    <td>{{ date_format(new DateTime($data->tanggal), 'd-m-Y H:i:s') }}</td>
</tr>
@endforeach
<tr>
    <td colspan="6" style="text-align:right;">Total Income:</td>
    <td colspan="4" style="text-align:right;">Rp.{{ number_format($totalpemasukan) }}</td>
</tr>
</table>
<br>
<h4 style="margin-bottom: 5px;"><u>Eben Hezer Wangsa Djaja</u></h4>
<p style="margin-top: 5px;">Founder LontaCinema</p>