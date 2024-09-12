@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>product Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">product</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">
    <!-- Default box -->
    <div class="card elevation-2">
        <div class="card-header">
        <h3 class="card-title">product</h3>
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif
            @if($message = Session::get('error'))
            <div class="alert alert-danger">{{ $message }}</div>
            @endif

            @if (Auth::user()->role == 'admin')
            <a href="{{ route('product.create') }}" class="btn btn-success shadow">Tambah Data</a>
            <a href="{{ url('product/pdf') }}" class="btn btn-warning shadow">Unduh PDF</a>
            <br><br>
            @endif

            <table id="users" class="display">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Judul Film</th>
                        <th>Harga</th>
                        <th>Jam tayang</th>

                        @if (Auth::user()->role == 'admin')
                        <th>Aksi</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                <?php $no_pro = 1 ?>
                @foreach ($product as $data)
                <tr>
                    <td>{{ $no_pro}}</td>
                    <td>{{ $data->nama_produk }}</td>
                    <td>{{ $data->harga_produk }}</td>
                    <td>{{ $data->jam_tayang }}</td>

                    @if (Auth::user()->role == 'admin')
                    <td>
                        <form action="{{ route('product.destroy', $data->id)}}" method="POST">
                            <a href="{{ route('product.edit', $data->id) }}" class="btn btn-sm  btn-warning shadow">Edit</a> - 
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('apakah kamu yakin untuk menghapus data ini?')">Delete</button>                        
                        </form>
                    </td>
                    @endif
                    <?php $no_pro++ ?>
                </tr>
                @endforeach
            </tbody>
            </table>
            <br>
        </div>
    </div>
    <!-- /.card -->
  
    </section>
<!-- /.content -->
@endsection