@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>user page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">user</li>
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
        <h3 class="card-title">user</h3>
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if (Auth::user()->role == 'admin')
            <a href="{{ route('user.create') }}" class="btn btn-success shadow">Tambah Data</a>
            <a href="{{ url('user/pdf') }}" class="btn btn-warning shadow">Unduh PDF</a>
            <br><br>
            @endif

            <table id="users" class="display">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>username</th>
                        <th>Nama Lengkap</th>
                        <th>role</th>

                        @if (Auth::user()->role == 'admin')
                        <th>Aksi</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                <?php $no_user = 1 ?>
                @foreach ($user as $user)
                <tr>
                    <td>{{ $no_user }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->role }}</td>

                    @if (Auth::user()->role == 'admin')
                    <td>
                        <form action="{{ route('user.destroy', $user->id)}}" method="POST">
                            <a href="{{ route('user.changepassword', $user->id) }}" class="btn btn-sm  btn-success shadow">edit password</a> - 
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm  btn-warning shadow">Edit</a> - 
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('apakah kamu yakin untuk menghapus data ini?')">Hapus</button>                        
                        </form>
                    </td>
                    @endif
                </tr>
                <?php $no_user++ ?>
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