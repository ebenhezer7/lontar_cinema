@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">Kursi Page</h2>
    </div>

    <section class="content">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Data Kursi</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('kursi.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('kursi.update', $kursi->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Kode Kursi</label>
                <input name="kode_kursi" type="text" class="form-control" placeholder="Ex. asep123" value="{{ $kursi->kode_kursi }}">
                @error('kode_kursi')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" name="submit" class="btn btn-success" value="Edit">
            </form>
        </div>
    </div>

</section> 
@endsection
