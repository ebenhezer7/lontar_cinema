@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">product Page</h2>
    </div>

    <section class="content">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Data product</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Judul Film</label>
                <input name="nama_produk" type="text" class="form-control" placeholder="Ex. asep123" value="{{ $product->nama_produk }}">
                @error('nama_produk')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input name="harga_produk" type="text" class="form-control" placeholder="Ex. asep123" value="{{ $product->harga_produk }}">
                @error('harga_produk')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>jam tayang</label>
                <select name="jam_tayang" class="form-control">
                    <option value="">{{ $product->jam_tayang }}</option>
                    <option value="">pilih jam tayang baru</option>
                    <option value="09.00 - 11.00">09.00 - 11.00</option>
                    <option value="11.00 - 13.00">11.00 - 13.00</option>
                    <option value="13.00 - 15.00">13.00 - 15.00</option>
                    <option value="15.00 - 17.00">15.00 - 17.00</option>
                    <option value="17.00 - 19.00">17.00 - 19.00</option>
                    <option value="19.00 - 21.00">19.00 - 21.00</option>
                    <option value="21.00 - 23.00">21.00 - 23.00</option>
                </select>
                @error('jam_tayang')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" name="submit" class="btn btn-success" value="Edit">
            </form>
        </div>
    </div>

</section> 
@endsection
