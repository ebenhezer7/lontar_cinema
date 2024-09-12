@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">user Page</h2>
    </div>

    <section class="content">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data user</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('user.change', $user->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label>username</label>
                <input name="username" type="text" class="form-control" placeholder="Ex. asep123" value="{{ $user->username }}" readonly>
                @error('username')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>role</label>
                <input name="role" type="text" class="form-control" placeholder="Ex. asep123" value="{{ $user->role }}" readonly>
                @error('role')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>new password</label>
                <input name="new_password" type="password" class="form-control" placeholder="Ex. asep123">
                @error('new_password')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Retype password</label>
                <input name="password_confirm" type="password" class="form-control" placeholder="Retype password">
                @error('password_confirm')
                    <p>{{ $message }}</p>
                @enderror
              </div>
            <input type="submit" name="submit" class="btn btn-success" value="simpan password baru">
            </form>
        </div>
    </div>

</section> 
@endsection
