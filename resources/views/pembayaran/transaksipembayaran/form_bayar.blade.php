@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
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
    <h3><i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Bayar Tagihan Siswa</h3>
    <hr>
    <section class="content">
      <table class="table table-bordered table-head-fixed bg-white" id='tabelAgendaMasuk'>
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Kelas</th>
            <th>Rincian</th>
            <th>Tagihan</th>
            <th>Sisa Tagihan</th>
            <th>Nominal Bayar</th>
            <th style="width: 40px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0; ?>
          @foreach($tagihan_siswa as $tagih)
          <?php $no++; ?>
          <tr>
            <td>{{$no}}</td>
            <td>{{$tagih->rombel->nama_rombel}} {{$tagih->rombel->tapel->semester}}</td>
            <td>{{$tagih->rincian}}</td>
            <td>@currency($tagih->nominal),00</td>
            <td>@currency($tagih->nominal),00</td>
            <td>
              <div class="form-group row">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input value="{{old('jumlah')}}" name="jumlah" type="text" class="form-control" id="jumlah" required>
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <a href="#" class="btn btn-success btn-sm"> Bayar</a>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" align="center"><b>Jumlah</b></td>
            <td align="left">
              <?php
              $jumlah_tagihan = \App\Tagihan::whereIn('rombel_id', $pesdik_pilih)
                ->WhereIn('jenis_kelamin', $pilih_jk)->sum('nominal');
              ?>
              <b>@currency($jumlah_tagihan),00</b><br>
            </td>
            <td align="left">
              <?php
              $jumlah_tagihan =  \App\Tagihan::where('rombel_id', '=', '4')
                ->where(function ($query) {
                  $query->where('jenis_kelamin', 'Laki-Laki')
                    ->orWhere('jenis_kelamin', 'Semua');
                })->sum('nominal');
              ?>
              <b>@currency($jumlah_tagihan),00</b><br>
            </td>
            <td colspan="2" align="left">
              <?php
              $sisa_tagihan = \App\Tagihan::whereIn('rombel_id', $pesdik_pilih)
                ->WhereIn('jenis_kelamin', $pilih_jk)->sum('nominal');
              ?>
              <b>@currency($sisa_tagihan),00</b><br>
            </td>
          </tr>
        </tfoot>
      </table>
    </section>
  </div>
</section>
@endsection