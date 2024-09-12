@extends('adminlte')
@section('content')
<style>
body {
        margin: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f2f2f2;
        /* Set a light background color */
    }

    header {
        color: #fff;
        text-align: center;
        padding: 20px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        position: relative;
    }

    header::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.2;
        z-index: -1;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }
</style>

 <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>dashboard Page</h1>
                </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Blank Page</li>
                </ol>
            </div>
        </div><!-- /.container-fluid -->
  </section>
    <!-- Main content -->
    <div class="content">
      <body>
        <header
        style="background: linear-gradient(to right, rgb(0, 0, 128), rgb(45, 45, 45), rgb(128, 0, 32)); color: #fff; text-align: center; padding: 20px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; position: relative;">
        <h1 style="margin: 0; font-size: 36px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Selamat Datang - {{ Auth::User()->nama }} | {{ Auth::User()->role }}
         </h1>
        </header>
      </body>
      <br>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">product</span>
                <span class="info-box-number">
                  {{ $totalfilm }}
                  <small>item</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Transactions</span>
                <span class="info-box-number">
                  {{ $totaltransaksi }} 
                  <small>tr</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Income</span>
                <span class="info-box-number">
                  {{ number_format($totalpemasukan) }}
                  <small>Rp</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Member</span>
                <span class="info-box-number">
                  {{ $totaluser }}
                  <small>person</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-lg-6">
              <!-- Card untuk gambar -->
              <div class="card">
                  <div class="card-body">
                      <img src="data:image/jpeg;base64,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" alt="Gambar anjing">
                  </div>
              </div>
              <!-- /.card -->
          </div>
          <!-- /.col-lg-6 -->
      
          <div class="col-lg-6">
              <!-- Card untuk video -->
              <div class="card">
                  <div class="card-body">
                      <iframe width="100%" height="315" src="https://media.istockphoto.com/id/1207410662/id/video/kasir-yang-ramah-di-kasir-supermarket.mp4?s=mp4-640x640-is&k=20&c=Cr3kUAvwZK3ZLJ3wZv7kB3t_Fu7FDLNy3yQTS359kB4=" 
                              title="Video title" frameborder="0" 
                              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                              allowfullscreen>
                        </iframe>
                  </div>
              </div>
              <!-- /.card -->
          </div>
          
            <!-- /.card -->
        </div>
        
          <!-- /.col-lg-6 -->
      </div>
      <!-- /.row -->
      
        <!-- /.row -->
        
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  <!-- /.content-wrapper -->
@endsection