@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>kursi page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">kursi</li>
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
            <h3 class="card-title">kursi</h3>
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if (Auth::user()->role == 'admin')
            <a href="{{ route('kursi.create') }}" class="btn btn-success shadow">Tambah Data</a>
            <a href="{{ url('kursi/pdf') }}" class="btn btn-warning shadow">Unduh PDF</a>
            <a href="{{ route('kursi.resetAllStatus') }}" class="btn btn-danger" id="refreshButton">Reset Semua Status</a>            <br><br>
            @endif

            <table id="users" class="display">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>kode kursi</th>
                        <th>status</th>

                        @if (Auth::user()->role == 'admin')
                        <th>Aksi</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    <?php $no_kurs = 1 ?>
                    @foreach ($kursi as $data)
                    <tr>
                        <td>{{ $no_kurs }}</td>
                        <td>{{ $data->kode_kursi }}</td>
                        <td>{{ $data->status }}</td>

                        @if (Auth::user()->role == 'admin')
                        <td>
                            <form action="{{ route('kursi.destroy', $data->id)}}" method="POST">
                                <a href="{{ route('kursi.edit', $data->id) }}" class="btn btn-sm  btn-warning shadow">Edit</a> -
                                <a href="{{ route('kursi.reset', $data->id) }}" class="btn btn-sm  btn-success shadow">reset</a> -
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('apakah kamu yakin untuk menghapus data ini?')">Delete</button>
                            </form>
                        </td>
                        @endif
                        <?php $no_kurs++ ?>
                    </tr>
                    @endforeach

                    <!-- Menampilkan data kursi dengan status 'booked' -->
                    @foreach ($kursiM as $data)
                    <tr>
                        <td>{{ $no_kurs }}</td>
                        <td>{{ $data->kode_kursi }}</td>
                        <td>{{ $data->status }}</td>
                        <td>Aksi</td>
                        <?php $no_kurs++ ?>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <!-- /.card -->
    <script>
        document.getElementById('refreshButton').addEventListener('click', function(event) {
            event.preventDefault(); // Menghentikan aksi default dari link

            var confirmation = confirm('Anda yakin ingin mereset semua status kursi?');
            if (confirmation) {
                // Redirect ke URL untuk mereset semua status kursi
                window.location.href = "{{ route('kursi.resetAllStatus') }}";
            }
        });
    </script>
</section>
<!-- /.content -->
@endsection