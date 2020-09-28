@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
  <div class="box">
    <h4><i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Bayar Tagihan Siswa</h4>
    <hr>
    <div class=" callout callout-primary alert alert-info alert-dismissible fade show" role="alert">
      <h5><i class="fas fa-info"></i> Informasi :</h5>
      - Pastikan data yang anda pilih sudah benar ! <br>
      - Klik tombol SIMPAN untuk melanjutkan proses pembayaran
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <section class="content">
      <form action="/pembayaran/transaksipembayaran/bayar" method="POST">
        {{csrf_field()}}
        <table class="table table-hover table-head-fixed bg-white">
          <thead>
            <tr>
              <th>No</th>
              <th>Kelas</th>
              <th>Rincian</th>
              <th>Tagihan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 0;
            $pesdik_id = $pesdik;
            ?>
            @foreach($tagihan_siswa as $tagih)
            <?php $no++; ?>
            <tr>
              <td visibility: hidden>
                <input value="{{$tagih->id}}" name="tagihan_id[]" type="text" class="form-control bg-white" id="tagihan_id[]">
              </td>
              <td visibility: hidden>
                <input value="{{$pesdik_id}}" name="pesdik_id[]" type="text" class="form-control bg-white" id="pesdik_id[]">
              </td>
              <td visibility: hidden>
                <input value="{{$tagih->rombel_id}}" name="rombel_id[]" type="text" class="form-control bg-white" id="rombel_id[]">
              </td>
              <td>{{$no}}</td>
              <td>{{$tagih->rombel->nama_rombel}} {{$tagih->rombel->tapel->semester}}</td>
              <td>{{$tagih->rincian}}</td>
              <td>@currency($tagih->nominal),00</td>
              <td visibility: hidden>
                <div class="form-group row">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp.</span>
                    </div>
                    <input value="{{$tagih->nominal}}" name="jumlah_bayar[]" type="text" class="form-control" id="jumlah_bayar[]" required>
                    <div class="input-group-append">
                      <span class="input-group-text">.00</span>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" align="center"><b>Jumlah Harus Dibayar</b></td>
              <td align="left">
                <?php
                $jumlah_tagihan = \App\Tagihan::whereIn('id', $pilihTagihan)->sum('nominal');
                ?>
                <b>@currency($jumlah_tagihan),00</b><br>
              </td>
            </tr>
          </tfoot>
        </table>
        <hr>
        <div align="right">
          <a class="btn btn-danger btn-sm" href="/pembayaran/transaksipembayaran/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
          <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
        </div>
      </form>
    </section>
  </div>
</section>
@endsection