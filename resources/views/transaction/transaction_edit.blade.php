@extends('adminlte')
@section('content')
<style>
    .seat-container {
        display: grid;
        grid-template-columns: repeat(6, 1fr); /* 6 kursi per baris */
        gap: 10px; /* Jarak antar kursi */
        justify-content: center;
        align-items: center;
        margin-top: 10px;
    }

    .seat {
        width: 40px;
        height: 40px;
        margin: 2.5px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #eee;
        cursor: pointer;
    }

    .seat:hover {
        background-color: #0f0; /* Warna hijau saat kursor mengenai kursi */
    }

    .seat[data-status="booked"] {
        background-color: #f00; /* Warna untuk kursi yang sudah dipesan */
        cursor: not-allowed;
    }

    .seat + .seat {
        margin-left: 5px;
    }

    .selected {
        background-color: #00f; /* Warna biru untuk kursi yang dipilih */
        color: #fff; /* Warna teks putih untuk kontras */
    }
</style>
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">Transaksi Page</h2>
    </div>
    @if($message = Session::get('error'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    <section class="content ">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Transaksi Products</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>
            <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Nomor Unik</label>
                <input name="nomor_unik" type="text" class="form-control" placeholder="Ex. Ultra Milk" value="{{ $transaction->nomor_unik }}" readonly>
                @error('nomor_unik')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Kursi Lama</label>
                <select name="id_kursi" class="form-control" @readonly(true)>
                    @foreach ($kursi as $data)
                    <?php
                    if ($data->id == $transaction->id_kursi):
                        $selected = "selected";
                    else:
                        $selected = "";
                    endif;
                    ?>
                    <option {{ $selected }} value="{{ $data->id }}">
                        {{ $data->kode_kursi }}
                    </option>
                    @endforeach
                </select>
                @error('id_kursi')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <br>
            <label>Pilih Kursi</label> -          
            <input type="text" name="kode_kursi" id="selected-seat" readonly>
                <div class="seat-container">
                    @foreach ($kursi->sortBy('kode_kursi') as $item)
                        <div 
                            class="seat {{ $item->status == 'booked' ? 'booked' : '' }} {{ $item->status == 'selected' ? 'selected' : '' }}" 
                            data-status="{{ $item->status }}" 
                            data-seat-id="{{ $item->id }}" 
                            data-seat="{{ $item->kode_kursi }}"
                            onclick="selectSeat('{{ $item->id }}', '{{ $item->kode_kursi }}')">
                            {{ $item->kode_kursi }}
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="id_kursi" id="selected-id" readonly>
                <br>
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input name="nama_pelanggan" type="text" class="form-control" placeholder="Ex. 5000" value="{{ $transaction->nama_pelanggan }}">
                @error('nama_pelanggan')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Judul Film + Harga + Jam Tayang</label>
                <select name="id_produk" class="form-control" required>
                    <option>Pilih Film</option>
                    @foreach ($product as $data)
                    <?php
                    if ($data->id == $transaction->id_produk):
                        $selected = "selected";
                    else:
                        $selected = "";
                    endif;
                    ?>
                    <option {{ $selected }} value="{{ $data->id }}">
                        {{ $data->nama_produk }} - {{ $data->harga_produk }} - {{ $data->jam_tayang}}
                    </option>
                    @endforeach
                </select>
                @error('id_produk')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Uang Bayar</label>
                <input name="uang_bayar" type="number" class="form-control" placeholder="Ex. 5000" value="{{ $transaction->uang_bayar }}">
                @error('uang_bayar')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <br>
            <input type="submit" name="submit" class="btn btn-success" value="edit">
            </form>
        </div>
    </div>
    <script>
        function selectSeat(idKursi, kodeKursi) {
            document.getElementById('selected-id').value = idKursi;
            document.getElementById('selected-seat').value = kodeKursi;
    
            var seats = document.querySelectorAll('.seat');
            seats.forEach(function(seat) {
                seat.classList.remove('selected');
            });
    
            var selectedSeat = document.querySelector('.seat[data-seat-id="' + idKursi + '"]');
            selectedSeat.classList.add('selected');
        }
    </script>

</section> 
@endsection

