@extends('layouts.master')
@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px ">
        <div class="box">
            @if(session('sukses'))
            <div class="alert alert-success" role="alert">
                    {{session('sukses')}}
            </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <h3><i class="nav-icon fas fa-user my-1 btn-sm-1"></i> Pengguna</h3>
                    <hr>
                </div>
            </div>
            <div>
                <div class="col">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahpengguna"><i class="fas fa-plus"></i>
                        Tambah Data
                    </button>
                    <br><br>
                </div>
            </div>
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelSuratmasuk'>
                        <thead>
                            <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php $no = 0;?>
                                @foreach($data_pengguna as $pengguna)
                                <?php $no++ ;?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$pengguna->name}}</td>
                                    <td>{{$pengguna->email}}</td>
                                    <td>{{$pengguna->role}}</td>
                                    <td>
                                        <a href="/pengguna/{{$pengguna->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                        <a href="/pengguna/{{$pengguna->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Tambah -->
            <div class="modal fade" id="tambahpengguna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="nav-icon fas fa-user my-1 btn-sm-1"></i> Tambah Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                            <form action="/pengguna/tambah" method="POST">
                                {{csrf_field()}}
                                    <div class="row">
                                        <div class="col">
                                            <label for="name">Nama</label>
                                            <input name="name" type="text" class="form-control bg-light" id="name" placeholder="Nama" required>
                                            <label for="email">Email</label>
                                            <input name="email" type="email" class="form-control bg-light" id="email" placeholder="Email" required>
                                            <label for="password">Password</label>
                                            <input name="password" type="password" class="form-control bg-light" id="password" placeholder="Password" required>
                                            <label for="role">Level</label>
                                            <select name="role" id="role" class="form-control bg-light" required>
                                                <option value="">-- Pilih Level Pengguna --</option>
                                                <option value="admin">Administrator</option>
                                                <option value="petugas">Petugas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
                            </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
 @endsection

