@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Studio Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Studio</li>
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
        <h3 class="card-title">Studio</h3>
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if (Auth::user()->role == 'admin')
            <a href="{{ route('jam_tayang.create') }}" class="btn btn-success shadow">Tambah Data</a>
            <a href="{{ url('jam_tayang/pdf') }}" class="btn btn-warning shadow">Unduh PDF</a>
            <br><br>
            @endif

            <table id="users">
                <thead>
                    <tr>
                        <th>nama produk</th>
                        <th>jam tayang</th>
                        <th>durasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($jamTayangs as $data)
                <tr>
                    <td>{{ $data->nama_produk }}</td>
                    <td>{{ $data->waktu_mulai }}</td>
                    <td>{{ $data->durasi }}</td>

                    @if (Auth::user()->role == 'admin')
                    <td>
                        <form action="{{ route('jam_tayang.destroy', $data->id)}}" method="POST">
                            <a href="{{ route('jam_tayang.edit', $data->id) }}" class="btn btn-sm btn-warning shadow">Edit</a> - 
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger shadow">Hapus</button>
                        </form>
                    </td>
                    @endif
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
