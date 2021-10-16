@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Setoran</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Setoran</a></li>
            <li class="breadcrumb-item active">Tambah Setoran</li>
          </ol>
        </div><!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Data Setoran Baru</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="/simpanan/tambah" method="POST">
                            <!--card-body -->
                            @csrf
                            <div class="card-body col-sm-6">
                              <div class="form-group" style="display: none">
                                @if (empty($data_simpanan))
                                    <label for="id_simpanan">Nomor Transaksi</label>
                                    <input id="id_simpanan" type="id" class="form-control col-sm-4" name="id_simpanan" value="1" readonly>
                                    @if ($errors->has('id_simpanan'))
                                        <span class="text-danger">{{ $errors->first('id_simpanan') }}</span>
                                    @endif
                                @else
                                    @php 
                                        $no=$data_simpanan->id_simpanan+1;
                                        $urut = sprintf($no++);
                                    @endphp
                                    <label for="id_simpanan">Nomor Transaksi</label>
                                    <input id="id_simpanan" type="id" class="form-control col-sm-4" name="id_simpanan" placeholder="Nomor Anggota" value="{{$urut}}" readonly>
                                    @if ($errors->has('id_simpanan'))
                                        <span class="text-danger">{{ $errors->first('id_simpanan') }}</span>
                                    @endif
                                @endif
                              </div>
                              <div class="form-group ">
                                  <label for="id_anggota">Nomor Anggota</label>
                                  <input type="id" class="form-control col-sm-4" name="id_anggota" value="{{$id_anggota}}" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="name">Nama Lengkap</label>
                                  <input type="name" class="form-control" name="name" value="{{$joinData->name}}" readonly>
                              </div>
                              <div class="form-group">
                                <label>Tanggal</label>
                                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                      <input name="tglsetor" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{old('tglsetor')}}"/>
                                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                                  @if ($errors->has('tglsetor'))
                                  <span class="text-danger">{{ $errors->first('tglsetor') }}</span>
                                  @endif
                              </div>
                              {{-- Pilih Simpanan --}}
                              <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-cart">
                                <i class="fas fa-pencil-alt"></i> Pilih Transaksi
                              </button>
                              {{-- Jenis Simpanan --}}
                              @foreach ($jenis_simpanan as $jenis_simpanans)
                              @if ($jenis_simpanans->kategori == 'Registrasi')
                              @else
                              <div id="{{$jenis_simpanans->kode_jenis}}" style="display: none" class="form-group">
                                  <label for="{{$jenis_simpanans->kode_jenis}}">{{$jenis_simpanans->kategori}}</label>
                                  <input type="text" class="form-control" name="{{$jenis_simpanans->kode_jenis}}" placeholder="0" value="0">
                              </div>
                              @endif
                              @endforeach
                              <div class="form-group">
                                  <label>Keterangan</label>
                                  <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">Oke...</textarea>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer col-md-6">
                                {{-- <div class="form-group text-bold">
                                    <thead>
                                        <th>Total Setoran Rp. </th>
                                        <th>
                                        <input type="text" id="total" class="bg-light border-0 text-bold" value="0" readonly>
                                        </th>
                                    </thead>
                                </div> --}}
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            <div class="modal fade" id="modal-cart">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header bg-success">
                                    <h4 class="modal-title">Pilih Transaksi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="card-body">
                                    <div class="row">
                                      @foreach ($jenis_simpanan as $jenis_simpanans)
                                        @if ($jenis_simpanans->kategori == 'Registrasi')
                                        @elseif ($jenis_simpanans->kategori == 'Simpanan Pokok')
                                        @else
                                        <div class="col-sm-4">
                                          <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                              <input type="checkbox" id="cek{{$jenis_simpanans->kode_jenis}}" onclick="clk{{$jenis_simpanans->kode_jenis}}()">
                                              <label for="cek{{$jenis_simpanans->kode_jenis}}">
                                                {{$jenis_simpanans->kategori}}
                                              </label>
                                            </div>
                                          </div>
                                        </div>
                                        @endif
                                      @endforeach
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-sm btn-primary"  data-dismiss="modal">Pilih</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </form>
                </div>
                <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
</div>
{{-- @if (empty($mdata))
@else
    <input type="hidden" name="sim_wajib" id="sim_wajib" value="{{$mdata->s_wajib}}" hidden>
@endif
@if (empty($jenis_simpanan))
@else
  @foreach ($jenis_simpanan as $jenis_simpanans)
    <input type="hidden" name="hide{{$jenis_simpanans->kode_jenis}}" id="hide{{$jenis_simpanans->kode_jenis}}" value="{{$jenis_simpanans->kategori}}" hidden>
  @endforeach
@endif --}}
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {
  $('#reservationdate').datetimepicker({
      format: 'DD/MM/YYYY'
  });
  $("#sim_wajib").ready(function () {
      var sim_wajib = $("#sim_wajib").val();
      $("#regForm").validate({
          rules: {
              s_wajib: {
                  required: true,
                  min: parseInt(sim_wajib)
              }
          }
      });
  });
});
</script>
@foreach ($jenis_simpanan as $jenis_simpanans)
<script>
  function clk{{$jenis_simpanans->kode_jenis}}() {
    var checkbox = document.getElementById('cek{{$jenis_simpanans->kode_jenis}}');
    var {{$jenis_simpanans->kode_jenis}} = document.getElementById('{{$jenis_simpanans->kode_jenis}}');
    if (checkbox.checked == true) {
      {{$jenis_simpanans->kode_jenis}}.style.display = "block";
    } else {
      {{$jenis_simpanans->kode_jenis}}.style.display = "none";
    }
  }
</script>
@endforeach
@endsection