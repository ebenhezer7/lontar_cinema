@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">kursi Page</h2>
    </div>

    <section class="content">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data kursi</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('kursi.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>
            @if($message = Session::get('error'))
            <div class="alert alert-danger">{{ $message }}</div>
            @endif
            <form action="{{ route('kursi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Kode Kursi</label>
                    <input name="kode_kursi" type="text" class="form-control" placeholder="Ex. A1">
                    @error('kode_kursi')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" name="submit" class="btn btn-success" value="Tambah">
            </form>
        </div>
    </div>

</section> 
@endsection
