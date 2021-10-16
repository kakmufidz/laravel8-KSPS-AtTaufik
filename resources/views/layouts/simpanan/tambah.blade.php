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
                              <div class="form-group ">
                                  <label for="id_anggota">Nomor Anggota</label>
                                  <input type="id" class="form-control col-sm-4" name="id_anggota" value="{{$detailAnggota->id_anggota}}" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="name">Nama Lengkap</label>
                                  <input type="name" class="form-control" name="name" value="{{$detailAnggota->name}}" readonly>
                              </div>
                              <div class="form-group">
                                <label>Tanggal</label>
                                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                      <input name="tglsetor" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{old('tglsetor')}}"/>
                                        @if ($errors->has('tglsetor'))
                                        <span class="text-danger">{{ $errors->first('tglsetor') }}</span>
                                        @endif
                                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="tabungan">Tabungan</label>
                                  <input type="text" id="tabungan" class="form-control" name="tabungan" placeholder="0" value="{{old('tabungan')}}">
                                    @if ($errors->has('tabungan'))
                                        <span class="text-danger">{{ $errors->first('tabungan') }}</span>
                                    @endif
                              </div>
                              <div class="form-group">
                                  <label for="s_wajib">Simpanan Wajib</label>
                                  <input type="text" id="s_wajib" class="form-control" name="s_wajib" placeholder="0" value="{{old('s_wajib')}}">
                                  @if ($errors->has('s_wajib'))
                                      <span class="text-danger">{{ $errors->first('s_wajib') }}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label for="s-thr">Simpanan THR</label>
                                  <input type="text" id="s_thr" class="form-control" name="s_thr" placeholder="0" value="{{old('s_thr')}}">
                                  @if ($errors->has('s_thr'))
                                      <span class="text-danger">{{ $errors->first('s_thr') }}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label for="s_pendidikan">Simpanan Pendidikan</label>
                                  <input type="text" id="s_pendidikan" class="form-control" name="s_pendidikan" placeholder="0" value="{{old('s_pendidikan')}}">
                                  @if ($errors->has('s_pendidikan'))
                                      <span class="text-danger">{{ $errors->first('s_pendidikan') }}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Catatan</label>
                                  <textarea class="form-control" rows="3" name="catatan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">Oke...</textarea>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer col-md-6">
                                <div class="form-group text-bold">
                                    <thead>
                                        <th>Total Setoran Rp. </th>
                                        <th>
                                        <input type="text" id="total" class="bg-light border-0 text-bold" value="0" readonly>
                                        </th>
                                    </thead>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
@section('script')
<script type="text/javascript">
//Date range picker
$('#reservationdate').datetimepicker({
    format: 'DD/MM/YYYY'
});
$(document).ready(function() {
    $("#tabungan, #s_wajib, #s_thr, #s_pendidikan").keyup(function() {
        var tabungan  = $("#tabungan").val();
        var s_wajib = $("#s_wajib").val();
        var s_thr = $("#s_thr").val();
        var s_pendidikan = $("#s_pendidikan").val();

        var total = parseFloat(tabungan) + parseFloat(s_wajib) + parseFloat(s_thr) + parseFloat(s_pendidikan);
        $("#total").val(total);
    });
});
</script>
@endsection