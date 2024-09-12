@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Transaction page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
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
        <h3 class="card-title">Transaction</h3>
        </div>
        <div class="card-body">

            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if (Auth::user()->role == 'kasir')
            <a href="{{ route('transaction.create') }}" class="btn btn-success shadow">Tambah Transaksi</a>
            <br><br>
            @endif
            @if (Auth::user()->role == 'admin')
            <a href="{{ url('transaction/pdf') }}" class="btn btn-warning shadow">Unduh PDF</a> 
            <br><br>
            @endif

            @if (Auth::user()->role == 'owner')
            <a href="{{ url('transaction/all') }}" class="btn btn-warning shadow"><i class="nav-icon fas fa-file-pdf text-home"></i> Unduh PDF Pertanggal</a>
            <br><br>
            <form action="{{ route('transaction.index') }}" method="get" class="form-inline">
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
                <a href="{{ route('transaction.index') }}" class="btn btn-danger">
                    <i class="fas fa-undo"></i> Reset
                </a>
            </form>
            <br>
            @endif     

            <table class="display" id="users">
                <thead>
                <tr>
                    <th>no</th>
                    <th>Nomor Unik</th>
                    <th>Nama Pelanggan</th>
                    <th>Judul Film</th>
                    <th>Harga Produk</th>
                    <th>Kursi</th>
                    <th>Uang Bayar</th>
                    <th>Uang Kembali</th>

                    @if (Auth::user()->role == 'owner')
                    <th>Tanggal</th>
                    @endif

                    @if (Auth::user()->role !== 'owner')
                    <th>Aksi</th>
                    @endif

                </tr>
                </thead>
                <tbody>
                <?php $no_transaksi = 1 ?>
                @foreach ($TransactionsM as $transaction)
                <tr>
                    <td>{{ $no_transaksi }}</td>
                    <td>{{ $transaction->nomor_unik }}</td>
                    <td>{{ $transaction->nama_pelanggan }}</td>
                    <td>{{ $transaction->nama_produk }}</td>
                    <td>Rp.{{ number_format($transaction->harga_produk) }}</td>
                    <td>{{ $transaction->kode_kursi }}</td>
                    <td>Rp.{{ number_format($transaction->uang_bayar) }}</td>
                    <td>Rp.{{ number_format($transaction->uang_kembali) }}</td>

                    @if (Auth::user()->role == 'owner')
                        <td>{{ date_format(new DateTime($transaction->tanggal), 'd-m-Y H:i') }}</td>
                    @endif

                    @if (Auth::user()->role !== 'owner')
                    <td>    
                        @if (Auth::user()->role == 'kasir')
                        <a href="{{ url('transaction/pdf2', $transaction->id_trans) }}" class="btn btn-sm btn-primary shadow"><i class="nav-icon fas fa-file-pdf text-home"></i>  Cetak Struk</a>
                        @endif
                        @if (Auth::user()->role == 'admin')
                        <a href="{{ route('transaction.edit', $transaction->id_trans) }}" class="btn btn-sm btn-block btn-warning shadow">Edit</a>
                        <form action="{{ route('transaction.destroy', $transaction->id_trans) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('apakah kamu yakin untuk menghapus data ini?')">Delete</button>                        
                            </form>
                        @endif
                    </td>    
                    @endif
                </tr>
                <?php $no_transaksi++ ?>
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
