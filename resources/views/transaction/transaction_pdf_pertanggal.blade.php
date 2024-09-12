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

<h1>laporan transaksi</h1>
<h3>berikut merupakan laporan transaksi berdasarkan tanggal</h3>
<table>
    <thead>
        <tr>
            <th>No Unik</th>
            <th>Nama Pelaggan</th>
            <th>Nama Produk</th>
            <th>Kursi</th>
            <th>Harga Produk</th>
            <th>Uang Bayar</th>
            <th>Uang Kembali</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaction as $data)
        <tr>
            <td>{{ $data->nomor_unik }}</td>
            <td>{{ $data->nama_pelanggan }}</td>
            <td>{{ $data->nama_produk }}</td>
            <td>{{ $data->kode_kursi }}</td>
            <td style="text-align:right;"> Rp.{{ number_format($data->harga_awal) }}</td>
            <td style="text-align:right;" >Rp.{{ number_format($data->uang_bayar) }}</td>
            <td style="text-align:right;">Rp.{{ number_format($data->uang_kembali) }}</td>
            <td>{{ date_format(new DateTime($data->tanggal), 'd-m-Y H:i:s') }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6" style="text-align:right;">Total Income:</td>
            <td colspan="4" style="text-align:right;">Rp.{{ number_format($totalIncome) }}</td>
        </tr>
    </tbody>
</table>
<br>
{{-- <p>berikut merupakan income atau pendapatan <strong>Rp.{{ number_format($totalIncome) }}</strong></p> --}}
<h4 style="margin-bottom: 5px;"><u>Eben Hezer Wangsa Djaja</u></h4>
<p style="margin-top: 5px;">Founder LontaCinema</p>
<br>