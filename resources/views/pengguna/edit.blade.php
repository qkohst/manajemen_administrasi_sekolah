@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if ($errors->any())
        <div class="callout callout-danger alert alert-danger alert-dismissible fade show">
            <h5><i class="fas fa-exclamation-triangle"></i> Peringatan :</h5>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <form action="{{ route('pengguna.update', $data_pengguna->id) }}" method="POST">
            <h4><i class="nav-icon fas fa-user my-1 btn-sm-1"></i> Edit Data Pengguna</h4>
            <hr>
            {{csrf_field()}}
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <label for="name">Nama</label>
                    <input name="name" type="text" class="form-control bg-light" id="name" placeholder="Nama" value="{{$data_pengguna->name}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{$data_pengguna->email}}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control bg-light" id="password" placeholder="Password" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="role">Level</label>
                    <select name="role" id="role" class="form-control" disabled>
                        <option value="admin" @if ($data_pengguna->role == 'admin') selected @endif>Administrator</option>
                        <option value="PetugasAdministrasiSurat" @if ($data_pengguna->role == 'PetugasAdministrasiSurat') selected @endif>Petugas Administrasi Surat</option>
                        <option value="PetugasAdministrasiKeuangan" @if ($data_pengguna->role == 'PetugasAdministrasiKeuangan') selected @endif>Petugas Administrasi Keuangan</option>
                        <option value="Siswa" @if ($data_pengguna->role == 'Siswa') selected @endif>Siswa</option>
                    </select>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="{{ route('pengguna.index') }}" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection