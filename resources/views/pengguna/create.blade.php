@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('pengguna.store') }}" method="POST">
            <h3><i class="nav-icon fas fa-user my-1 btn-sm-1"></i> Tambah Data Pengguna</h3>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="name">Nama</label>
                    <input name="name" type="text" class="form-control bg-light" id="name" placeholder="Nama" required>
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control bg-light" id="email" placeholder="Email"
                        required>
                </div>
                <div class="col-6">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control bg-light" id="password"
                        placeholder="Password" required>
                    <label for="role">Level</label>
                    <select name="role" id="role" class="form-control bg-light" required>
                        <option value="admin">Administrator</option>
                        <option value="petugas">Petugas</option>
                    </select>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="{{ route('pengguna.index') }}" role="button"><i
                    class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
