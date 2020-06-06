@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 20px 20px  ">
  <div class="box">
    @if(session('sukses'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{session('sukses')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
    <div class="row">
      <div class="col">
        <h3><i class="nav-icon fas fa-users my-0 btn-sm-1"></i> Tambah Anggota Rombongan Belajar</h3>
        <hr>
      </div>
    </div>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      Silahkan centang pada checkbox disamping kanan tabel, lalu klik tombol TAMBAHKAN KE ROMBEL !!!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="row">
      <div class="row table-responsive">
        <div class="col-12">
          <form action="/rombel/{{$id_rombel}}/simpanAnggota" method="POST">
            {{csrf_field()}}
            <table class="table table-hover table-head-fixed" id='notOrdering'>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Jenis Kelamin</th>
                  <th>Rombel Sebelumnya</th>
                  <th>Pilih</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0;
                ?>
                @foreach($data_pesdik_tapel_sebelumnya as $data_pesdik)
                <?php $no++; ?>
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$data_pesdik->nama}}</td>
                  <td>{{$data_pesdik->jenis_kelamin}}</td>
                  <td>{{$data_pesdik->rombel->nama_rombel}} {{$data_pesdik->rombel->tapel->semester}}</td>
                  <td>
                    <input type="checkbox" id="pilih[]" name="pilih[]" value="{{$data_pesdik->id}}" onclick="myFunction()">
                  </td>
                </tr>
                @endforeach
              </tbody>
             
              <tfoot>
                <tr>
                  <td colspan="5" align="right">
                    <button class="btn btn-success btn-sm my-1 mr-sm-1" style="display:none" type="submit" id="bayar">Tambahkan Ke Rombel</button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection