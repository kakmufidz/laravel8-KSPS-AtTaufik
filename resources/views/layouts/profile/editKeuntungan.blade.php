@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Keuntungan Mudorobah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Mudorobah</a></li>
            <li class="breadcrumb-item active">Keuntungan</li>
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
                        <h3 class="card-title">Edit Data Keuntungan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    
                        @if (session('statusdg'))
                        <div class="alert alert-danger">
                          {{session('statusdg')}}
                        </div>
                        @endif
                        <form action="/anggota/profile/updatekeuntungan/{{$keuntungan->id_keuntungan}}" method="post">
                            <!--card-body -->
                            @csrf
                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="id_anggota">ID Keuntungan</label>
                                    <input type="id" class="form-control col-md-4" name="id_keuntungan" value="{{$keuntungan->id_keuntungan}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="id_anggota">No. Anggota</label>
                                    <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$keuntungan->no_anggota}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="name" class="form-control col-md-6" id="name" value="{{$keuntungans->name}}" readonly>
                                </div>
                                <div class="form-group">
                                  <label>Tanggal</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input name="tglsetor" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{$keuntungan->tgl->format('d/m/Y')}}"/>
                                          @if ($errors->has('tglsetor'))
                                          <span class="text-danger">{{ $errors->first('tglsetor') }}</span>
                                          @endif
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label>Data Mudorobah</label>
                                  <div class="input-group mb-3">
                                    <input class="form-control bg-danger col-sm-2" name="id_mudorobah" value="{{$keuntungan->id_mudorobah}}" readonly>
                                    <input class="form-control bg-danger" name="data_mudorobah" value="{{$keuntungan->data_mudorobah}}" readonly>
                                  </div>
                                    @if ($errors->has('data_mudorobah'))
                                    <span class="text-danger">{{ $errors->first('data_mudorobah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="laba_usaha">Laba Usaha</label>
                                    <input type="text" class="form-control col-md-6" name="laba_usaha" value="{{$keuntungan->laba_usaha}}">
                                    @if ($errors->has('laba_usaha'))
                                    <span class="text-danger">{{ $errors->first('laba_usaha') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                  <label for="prosentase_danacadangan">Prosentase Dana Cadangan</label>
                                  <div class="input-group mb-3">
                                      <input type="text" class="form-control col-sm-3" name="prosentase_danacadangan" placeholder="0" value="{{$keuntungan->prosentase_danacadangan}}">
                                      <div class="input-group-append">
                                          <span class="input-group-text">%</span>
                                      </div>
                                  </div>
                                  @if ($errors->has('prosentase_danacadangan'))
                                      <span class="text-danger">{{ $errors->first('prosentase_danacadangan') }}</span>
                                  @endif
                                </div>
                                <div class="form-group">
                                  <label for="prosentase_danasosial">Prosentase Dana Sosial</label>
                                  <div class="input-group mb-3">
                                      <input type="text" class="form-control col-sm-3" name="prosentase_danasosial" placeholder="0" value="{{$keuntungan->prosentase_danasosial}}">
                                      <div class="input-group-append">
                                          <span class="input-group-text">%</span>
                                      </div>
                                  </div>
                                  @if ($errors->has('prosentase_danasosial'))
                                      <span class="text-danger">{{ $errors->first('prosentase_danasosial') }}</span>
                                  @endif
                                </div>
                                <div class="form-group">
                                  <label for="prosentase_shupengurus">Prosentase SHU Pengurus</label>
                                  <div class="input-group mb-3">
                                      <input type="text" class="form-control col-sm-3" name="prosentase_shupengurus" placeholder="0" value="{{$keuntungan->prosentase_shupengurus}}">
                                      <div class="input-group-append">
                                          <span class="input-group-text">%</span>
                                      </div>
                                  </div>
                                  @if ($errors->has('prosentase_shupengurus'))
                                      <span class="text-danger">{{ $errors->first('prosentase_shupengurus') }}</span>
                                  @endif
                                </div>
                                <div class="form-group">
                                  <label for="prosentase_shuanggota">Prosentase SHU Anggota</label>
                                  <div class="input-group mb-3">
                                      <input type="text" class="form-control col-sm-3" name="prosentase_shuanggota" placeholder="0" value="{{$keuntungan->prosentase_shuanggota}}">
                                      <div class="input-group-append">
                                          <span class="input-group-text">%</span>
                                      </div>
                                  </div>
                                  @if ($errors->has('prosentase_shuanggota'))
                                      <span class="text-danger">{{ $errors->first('prosentase_shuanggota') }}</span>
                                  @endif
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;" placeholder="Keterangan">{{$keuntungan->keterangan}}</textarea>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-body -->
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