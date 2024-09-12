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
            <h5 class="card-title">Edit Data user</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('user.update', $user->id) }}" method="POST">
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
                <label>Nama Lengkap</label>
                <input name="nama" type="text" class="form-control" placeholder="Ex. Ultra Milk" value="{{ $user->nama }}">
                @error('nama')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option>Pilih Role</option>
                    @if($user->role == 'admin')
                    <option value="admin" selected>Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="owner">Owner</option>
                    @endif

                    @if($user->role == 'kasir') 
                    <option value="admin">Admin</option>
                    <option value="kasir" selected>Kasir</option>
                    <option value="owner">Owner</option>
                    @endif

                    @if($user->role == 'owner') 
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="owner" selected>Owner</option>
                    @endif
                </select>
                @error('role')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" name="submit" class="btn btn-success" value="Edit">
            </form>
        </div>
    </div>

</section> 
@endsection
