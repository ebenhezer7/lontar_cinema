@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>History  page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">transaction</li>
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
            <h3 class="card-title">Halaman Log</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('log.index') }}" method="get" class="form-inline">
                <div class="form-group mx-2">
                    <label for="start_date" class="mr-2">Tanggal Awal :</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="form-group mx-2">
                    <label for="end_date" class="mr-2">Tanggal Akhir :</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Cari
                </button>
                <a href="{{ route('log.index') }}" class="btn btn-danger">
                    <i class="fas fa-undo"></i> Reset
                </a>
            </form>
            <br><br>
            <table id="users" class="display">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Nama User</th>
                        <th>aktifitas</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no_log = 1 ?>
                    @foreach ($data as $log)
                    <tr>
                        <td>{{ $no_log }}</td>
                        <td>{{ $log->nama }}</td>
                        <td>{{ $log->activity }}</td>
                        <td>{{ $log->created_at->toDayDateTimeString() }}</td>
                    </tr>
                    <?php $no_log++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection