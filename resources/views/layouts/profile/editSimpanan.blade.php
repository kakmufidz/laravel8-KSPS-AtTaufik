@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Simpanan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Simpanan</a></li>
            <li class="breadcrumb-item active">Data Simpanan</li>
          </ol>
        </div><!-- /.col -->
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Setoran</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="/anggota/profile/updatesimpanan/{{$datasimpanan->id_jumlah}}" method="POST">
                            <!--card-body -->
                            @csrf
                            <div class="card-body col-sm-6">
                              <div class="form-group">
                                  <label for="id_simpanan">Nomor Transaksi</label>
                                  <input type="id" class="form-control col-sm-4" name="id_simpanan" value="S100{{$datasimpanan->id_jumlah}}" readonly>
                              </div>
                              <div class="form-group ">
                                  <label for="id_anggota">Nomor Anggota</label>
                                  <input type="id" class="form-control col-sm-4" name="id_anggota" value="{{$datasimpanan->id_anggota}}" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="name">Nama Lengkap</label>
                                  <input type="name" class="form-control" name="name" value="{{$datasimpanan->name}}" readonly>
                              </div>
                              <div class="form-group">
                                <label>Tanggal</label>
                                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                      <input name="tglsetor" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" value="{{date('d/m/Y', strtotime($datasimpanan->tgl))}}"/>
                                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="{{str_replace(' ','',$datasimpanan->kategori)}}">{{$datasimpanan->kategori}}</label>
                                  <input type="text" class="form-control" name="{{str_replace(' ','',$datasimpanan->kategori)}}" placeholder="0" value="{{$datasimpanan->jumlah_simpanan}}">
                              </div>
                              <div class="form-group">
                                  <label for="catatan">Keterangan</label>
                                  <textarea class="form-control" name="keterangan" rows="3">{{$datasimpanan->keterangan}}</textarea>
                              </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                </div>
                </div>
            </div>
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
</script>
@endsection