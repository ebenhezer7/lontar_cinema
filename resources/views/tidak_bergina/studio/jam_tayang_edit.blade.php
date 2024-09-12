@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">halaman jam Tayang </h2>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Data Jam Tayang</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('jam_tayang.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('jam_tayang.update', $jamTayangs->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Produk</label>
                    <select name="id_film" class="form-control">
                        <option value="">pilih film</option>
                        @foreach($produk as $produk)
                            <option value="{{ $produk->id }}" {{ $produk->id == $jamTayangs->id_film ? 'selected' : '' }}>{{ $produk->nama_produk }} | {{ $produk->jam_tayang }}</option>
                        @endforeach
                    </select>
                    @error('id_film')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Waktu Mulai</label>
                    <input name="waktu_mulai" type="text" class="form-control" placeholder="Ex. 09:00:00" value="{{ $jamTayangs->waktu_mulai }}">
                    @error('waktu_mulai')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Durasi (menit)</label>
                    <input name="durasi" type="text" class="form-control" placeholder="Ex. 120" value="{{ $jamTayangs->durasi }}">
                    @error('durasi')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" name="submit" class="btn btn-success" value="Edit">
            </form>
        </div>
    </div>
</section> 
@endsection
