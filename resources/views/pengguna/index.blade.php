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
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="{{ route('pengguna.create') }}" role="button"><i
                        class="fas fa-plus"></i> Tambah Data</a>
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
                                <form action="{{ route('pengguna.destroy', $pengguna->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('pengguna.edit', $pengguna->id) }}"
                                        class="btn btn-primary btn-sm my-1 mr-sm-1"><i
                                            class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm my-1 mr-sm-1"
                                        onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                        Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
