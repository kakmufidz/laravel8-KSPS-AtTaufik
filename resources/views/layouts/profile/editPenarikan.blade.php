@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Penarikan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Simpanan</a></li>
            <li class="breadcrumb-item active">Edit Penarikan</li>
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
                        <h3 class="card-title">Data Penarikan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="/anggota/profile/updatepenarikan/{{$penarikan->id_penarikan}}" method="POST">
                            <!--card-body -->
                            @csrf
                            <div class="card-body col-sm-6">
                              <div class="form-group">
                                  <label for="id_penarikan">ID Transaksi</label>
                                  <input type="id" class="form-control col-sm-4" name="id_penarikan" value="P100{{$penarikan->id_penarikan}}" readonly>
                              </div>
                              <div class="form-group ">
                                  <label for="id_anggota">Nomor Anggota</label>
                                  <input type="id" class="form-control col-sm-4" name="id_anggota" value="{{$penarikan->no_anggota}}" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="name">Nama Lengkap</label>
                                  <input type="name" class="form-control" name="name" value="{{$penarikan->name}}" readonly>
                              </div>
                              <div class="form-group">
                                <label>Tanggal</label>
                                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                      <input name="tgltarik" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" value="{{date('d/m/Y', strtotime($penarikan->tgl))}}"/>
                                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="jumlah">Jumlah</label>
                                  <input type="text" class="form-control" name="jumlah" value="{{$penarikan->jumlah}}">
                              </div>
                              <div class="form-group">
                                  <label for="catatan">Catatan</label>
                                  <textarea class="form-control" name="catatan" rows="3">{{$penarikan->catatan}}</textarea>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                </div>
                <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
          <!-- /.content -->
          <!-- jQuery -->
    <!-- date-range-picker -->
</div>
  <!-- /.content-header -->
@endsection
@section('script')
<script type="text/javascript">
//Date range picker
$('#reservationdate').datetimepicker({
    format: 'DD/MM/YYYY'
});
    $(document).ready(function() {
        $("#tabungan, #s_wajib, #s_thr, #s_pendidikan, #lain").keyup(function() {
            var tabungan  = $("#tabungan").val();
            var s_wajib = $("#s_wajib").val();
            var s_thr = $("#s_thr").val();
            var s_pendidikan = $("#s_pendidikan").val();
            var lain = $("#lain").val();

            var total = parseInt(tabungan) + parseInt(s_wajib)+parseInt(s_thr) + parseInt(s_pendidikan)+ parseInt(lain);
            $("#total").val(total);
        });
    });
</script>
@endsection