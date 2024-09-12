@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">Transaction Page</h2>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data Transaction</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>
            <form action="{{ route('transaction.ambiljam') }}" method="POST">
                @csrf
                <label>Jam Tayang</label>
                <select name="id_jam_tayang" id="id_jam_tayang">
                    @foreach ($jamTayang as $item)
                        <option value="{{ $item->id }}">{{ $item->waktu_mulai }} -({{ $item->nama_produk }})</option>
                    @endforeach
                </select>
                <br><br>
                <input type="submit" name="submit" class="btn btn-success" value="Pilih Kursi">
            </form>            
        </div>
    </div>
</section>
@endsection