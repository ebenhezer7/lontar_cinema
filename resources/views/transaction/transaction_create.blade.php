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
        <h2 class="h3 mb-4 text-gray-800">transaction Page</h2>
    </div>

    <section class="content">

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Data transaction</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Kembali</a>
                <br><br>

                <form action="{{ route('transaction.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nomor Unik</label>
                        <input name="nomor_unik" type="text" class="form-control" placeholder="Ex. asep" readonly
                            value="{{ random_int(1000000000,9999999999) }}">
                        @error('nomor_unik')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <label>Kursi</label> -
                    <input type="hidden" name="id_kursi" id="terpilih-id" readonly>
                    <input type="text" name="kode_kursi" id="terpilih-seat" readonly>
                    <input type="hidden" name="id_produk" id="terpilih-id-produk" readonly>
                    
                    <!-- Tambahkan tombol untuk membuka modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pilihKursiModal"onclick="pilihKursi()">
                    Pilih Kursi
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="pilihKursiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pilih Kursi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Isi dengan elemen kursi yang sudah ada -->
                            <div id="seatSelectionContainer">
                                <label>Kursi</label> -
                                <input type="hidden" name="id_kursi" id="selected-id" readonly>
                                <input type="text" name="kode_kursi" id="selected-seat" readonly>
                                <input type="hidden" name="id_produk" id="selected-id-produk" readonly>
                                <div class="seat-container">
                                    <!-- Sort kursi berdasarkan kode_kursi -->
                                    @foreach ($kursi as $item)
                                        <div class="seat {{ $item->status === 'booked' ? 'booked' : '' }} {{ $item->status === 'selected' ? 'selected' : '' }}"
                                            data-status="{{ $item->status }}" data-seat-id="{{ $item->id }}"
                                            data-seat="{{ $item->kode_kursi }}"
                                            onclick="selectSeat('{{ $item->id }}', '{{ $item->kode_kursi }}', '{{ $item->id_jam_tayang }}')">
                                            {{ $item->kode_kursi }} 
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Tombol untuk menutup modal -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <!-- Tombol "Pilih Kursi" dapat digunakan untuk menyimpan data kursi yang dipilih -->
                            <button type="button" class="btn btn-primary" onclick="simpanDataKursi()" data-dismiss="modal">Pilih Kursi</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input name="nama_pelanggan" type="text" class="form-control" placeholder="Ex. asep">
                        @error('nama_pelanggan')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Film</label>
                        <select name="id_produk" id="harga_produk" class="form-control" required>
                            <option>Pilih Film</option>
                            @foreach ($produk as $item)
                            <option value="{{ $item->id }}" data-harga="{{ $item->harga_produk }}">
                                {{ $item->nama_produk }} - {{ $item->harga_produk }} - {{ $item->jam_tayang }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_produk')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Uang Bayar</label>
                        <input name="uang_bayar" id="uang_bayar" type="number" class="form-control"
                            placeholder="Ex. 90000">
                        @error('uang_bayar')
                        <p>{{ $error }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Uang Kembali</label>
                        <input name="uang_kembali" id="uang_kembali" type="text" class="form-control" readonly
                            Rp.(number_format)>
                        @error('uang_kembali')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" name="submit" class="btn btn-success" value="Tambah">
                </form>
            </div>
        </div>

        <script>
            function selectSeat(idKursi, kodeKursi, idJamTayang) {
                // Menetapkan nilai id_kursi dan kode_kursi ke input tersembunyi
                document.getElementById('selected-id').value = idKursi;
                document.getElementById('selected-seat').value = kodeKursi;
        
                // Menghapus kelas 'selected' dari semua kursi dan menambahkannya ke kursi yang dipilih
                var seats = document.querySelectorAll('.seat');
                seats.forEach(function (seat) {
                    seat.classList.remove('selected');
                });
        
                // Menambahkan kelas 'selected' ke kursi yang dipilih
                var selectedSeat = document.querySelector('.seat[data-seat-id="' + idKursi + '"]');
                selectedSeat.classList.add('selected');
            }
        
        
            // Menangkap peristiwa perubahan pada input uang bayar
            document.getElementById('uang_bayar').addEventListener('input', function () {
                // Mengambil nilai uang bayar dari input
                var uangBayar = parseFloat(this.value) || 0; // Konversi ke float atau gunakan nilai 0 jika tidak valid
        
                // Mengambil nilai harga_produk dari koleksi produk (gantilah dengan nilai yang sesuai)
                var hargaProduk = parseFloat({{ $produk->first()->harga_produk }}) || 0;
        
                // Menghitung uang kembali
                var uangKembali = uangBayar - hargaProduk;
        
                // Menetapkan nilai uang kembali ke input
                document.getElementById('uang_kembali').value = uangKembali.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
            });
        
            function formatRupiah(input) {
                // Mengambil nilai input
                let value = input.value;
        
                // Menghilangkan semua karakter kecuali digit
                value = value.replace(/\D/g, '');
        
                // Menambahkan tanda titik sebagai pemisah ribuan
                value = new Intl.NumberFormat('id-ID').format(value);
        
                // Menyimpan kembali nilai ke input
                input.value = value;
            }
        
            // Fungsi untuk menampilkan kursi di dalam kontainer
                
            function pilihKursi() {
                // Ambil nilai id_jam_tayang dan id_produk dari elemen formulir
                var idJamTayang = document.getElementById('id_jam_tayang').value;
                var idProduk = document.getElementById('harga_produk').value;

                // Setel nilai input tersembunyi yang akan dikirim ke halaman pilih kursi
                document.getElementById('selected-jam-tayang').value = idJamTayang;
                document.getElementById('selected-id-produk').value = idProduk;

                // Buka modal pilih kursi dengan ID tertentu dan id_jam_tayang yang dipilih
                $('#pilihKursiModal').modal('show');
            }
        
            function simpanDataKursi() {
                // Menyimpan data kursi yang dipilih ke dalam input tersembunyi
                document.getElementById('terpilih-id').value = document.getElementById('selected-id').value;
                document.getElementById('terpilih-seat').value = document.getElementById('selected-seat').value;
                document.getElementById('terpilih-jam-tayang').value = document.getElementById('selected-jam-tayang').value;
        
                // Menutup modal
                $('#pilihKursiModal').modal('hide');
            }
        </script>
        
        
    </section>
</section>
@endsection
