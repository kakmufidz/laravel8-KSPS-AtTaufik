@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Penarikan Simpanan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Simpanan</a></li>
            <li class="breadcrumb-item active">Penarikan Simpanan</li>
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
                        <h3 class="card-title">Data Penarikan Baru</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="/penarikan/tarik" method="post">
                            <!--card-body -->
                            @csrf
                            <div class="card-body">
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
                                        <input name="tgltarik" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{old('tgltarik')}}"/>
                                          @if ($errors->has('tgltarik'))
                                          <span class="text-danger">{{ $errors->first('tgltarik') }}</span>
                                          @endif
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label for="jenis_penarikan">Jenis Penarikan</label>
                                  <select class="form-control" name="jenis_penarikan" value="{{old('jenis_penarikan')}}">
                                    <option>Tabungan Umum</option>
                                    <option>Tabungan Pendidikan</option>
                                    <option>THR</option>
                                  </select>
                                </div>
                                @if ($errors->has('jenis_penarikan'))
                                <span class="text-danger">{{ $errors->first('jenis_penarikan') }}</span>
                                @endif
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control col-md-6" name="jumlah" placeholder="0" value="{{old('jumlah')}}">
                                      @if ($errors->has('jumlah'))
                                      <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                      @endif
                                  </div>
                                <div class="form-group">
                                  <label>Catatan</label>
                                  <textarea class="form-control" rows="3" name="catatan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">Oke...</textarea>
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
</script>
@endsection