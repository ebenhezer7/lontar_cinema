@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">Studio Page</h2>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data Jam Tayang</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('jam_tayang.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('jam_tayang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Produk</label>
                    <select name="id_film" class="form-control">
                        <option value="">pilih film</option>
                        @foreach($produk as $produk)
                            <option value="{{ $produk->id }}">{{ $produk->nama_produk }} | {{ $produk->jam_tayang }}</option>
                        @endforeach
                    </select>
                    @error('id_film')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Waktu Mulai</label>
                    <input name="waktu_mulai" type="text" class="form-control" placeholder="Ex. 09:00:00">
                    @error('waktu_mulai')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Durasi (menit)</label>
                    <input name="durasi" type="text" class="form-control" placeholder="Ex. 120">
                    @error('durasi')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" name="submit" class="btn btn-success" value="Tambah">
            </form>
        </div>
    </div>
</section> 
@endsection
