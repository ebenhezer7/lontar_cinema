@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">Transactions Page</h2>
    </div>

    <section class="content">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Add Data Transactions</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('transaction.pertanggal', ['start_date' => '2024-01-01', 'end_date' => '2024-12-31']) }}" method="GET">
                <div class="form-group">
                    <label>Tanggal Awal</label>
                    <input name="start_date" type="date" class="form-control" style="border: 1px solid rgb(88, 88, 88);">
                    @error('start_date')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input name="end_date" type="date" class="form-control" style="border: 1px solid rgb(88, 88, 88);">
                    @error('end_date')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                <h6>*Tanggal Akhir tidak masuk data</h6>
                <button type="submit" class="btn btn-success">Tampilkan Data</button>
              </form>
        </div>
    </div>

</section> 
@endsection