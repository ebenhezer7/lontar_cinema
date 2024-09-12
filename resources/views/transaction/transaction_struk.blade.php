<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Bioskop - LontarCinema</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .ticket {
            width: 300px;
            margin: 20px auto;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left; /* Ubah menjadi left */
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
            text-align: center;
        }
        .sub-header {
            font-size: 18px;
            font-weight: bold;
            color: #555;
            text-align: center;
        }
        .sub-sub-header {
            font-size: 14px;
            color: #555;
            text-align: center;
        }
        .content {
            margin-top: 10px; /* Ubah menjadi 10px */
            font-size: 14px;
            color: #444;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
        .barcode {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .divider {
            border-top: 1px dashed #ddd;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">LontarCinema</div>
        <div class="sub-header">Jl.Arief Rahman Hakim No.16, Subang</div>
        <div class="divider"></div>
        <div class="sub-header">Invoice Transaksi</div>
        <div class="sub-sub-header">Tanggal: {{ date('d/m/Y H:i:s') }}</div>
        <div class="divider"></div>
        <div class="content">Nomor Unik: {{ $transaction->nomor_unik }}</div>
        <div class="content">Nama Pelanggan: {{ $transaction->nama_pelanggan }}</div>
        <div class="content">Film: {{ $transaction->nama_produk }}</div>
        <div class="content">Film: {{ $transaction->jam_tayang }}</div>
        <div class="content">Kode Kursi: {{ $transaction->kode_kursi }}</div>
        <div class="divider"></div>
        <div class="content">Harga Produk:</div>
        <div style="text-align: right; margin-top: -15px;">Rp {{ number_format($transaction->harga_awal, 0, ',', '.') }}</div>
        <div class="content">Uang Bayar:</div>
        <div style="text-align: right; margin-top: -15px;">Rp {{ number_format($transaction->uang_bayar, 0, ',', '.') }}</div>
        <div class="content">Uang Kembali:</div>
        <div style="text-align: right; margin-top: -15px;">Rp {{ number_format($transaction->uang_kembali, 0, ',', '.') }}</div>
        <div class="divider"></div>
        <div class="footer">Terima Kasih Anda Telah Belanja Di LontarCinema</div>
        <div class="footer">Tiket Yang Sudah Dibeli Tidak bisa dikembalikan!</div>
    </div>
</body>
</html>
