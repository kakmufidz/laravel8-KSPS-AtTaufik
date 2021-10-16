@extends('layouts.master')
@section('konten')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Keuntungan Mudorobah</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Mudorobah</a></li>
          <li class="breadcrumb-item active">Keuntungan</li>
        </ol>
      </div>
    </div>
  </div>

  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">Data Keuntungan</h3>
                  </div>
                  @if (session('statusdg'))
                  <div class="alert alert-danger">
                    {{session('statusdg')}}
                  </div>
                  @endif
                  <form action="/angsuran/mudorobah/keuntungan/tambah" method="post">
                      @csrf
                      <div class="card-body col-md-6">
                          <div class="form-group">
                              <label for="id_anggota">No. Anggota</label>
                              <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$detailAnggota->id_anggota}}" readonly>
                          </div>
                          <div class="form-group">
                              <label for="name">Nama</label>
                              <input type="name" class="form-control col-md-6" id="name" value="{{$detailAnggota->name}}" readonly>
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
                            <label>Data Mudorobah</label>
                            @if ($detailMudorobah == null)
                              <div class="alert alert-danger">
                                Data mudorobah tidak ditemukan
                              </div>
                            @else
                            <div class="input-group mb-3">
                              <input class="form-control bg-danger col-sm-2" name="id_mudorobah" value="{{$detailMudorobah->id_mudorobah}}" readonly>
                              <input class="form-control bg-danger" name="data_mudorobah" value="{{$detailAnggota->name}} | {{$detailMudorobah->tgl}} | {{$detailMudorobah->jenis_usaha}} = Rp. @currency($detailMudorobah->jumlah) | {{$detailMudorobah->bagi_hasil}}%" readonly>
                            </div>
                            @if ($errors->has('data_mudorobah'))
                              <span class="text-danger">{{ $errors->first('data_mudorobah') }}</span>
                              @endif
                            @endif
                          </div>
                          <div class="form-group">
                              <label for="laba_usaha">Laba Usaha</label>
                              <input type="text" class="form-control col-md-6" name="laba_usaha" placeholder="Laba Usaha" value="{{old('laba_usaha')}}">
                              @if ($errors->has('laba_usaha'))
                              <span class="text-danger">{{ $errors->first('laba_usaha') }}</span>
                              @endif
                          </div>
                          <div class="form-group">
                              <label>Keterangan</label>
                              <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;" placeholder="Keterangan">{{old('keterangan')}}</textarea>
                          </div>
                          @if ($errors->has('keterangan'))
                              <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                          @endif
                        </div>
                        @if (empty($mdata))
                        @else
                            <input type="hidden" name="prosentase_danacadangan" value="{{$mdata->prosentase_danacadangan}}" hidden>
                            <input type="hidden" name="prosentase_danasosial" value="{{$mdata->prosentase_danasosial}}" hidden>
                            <input type="hidden" name="prosentase_shupengurus" value="{{$mdata->prosentase_shupengurus}}" hidden>
                            <input type="hidden" name="prosentase_shuanggota" value="{{$mdata->prosentase_shuanggota}}" hidden>
                        @endif
                        <div class="timeline timeline-inverse ml-4">
                            <div class="time-label">
                            <span class="bg-danger">
                                Penting !!!
                            </span>
                            </div>
                            <div>
                            <i class="fas fa-user bg-primary"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="#">Setoran</a> keuntungan</h3>
                                @if (empty($mdata))
                                    <div class="timeline-body bg-danger">
                                        Master data belum diatur...<br>
                                    </div>
                                @else
                                    <div class="timeline-body">
                                        Keuntungan yang didapatkan oleh koperasi adalah <strong>{{$mdata->prosentase_keuntungan}}%</strong> dari Laba Usaha yang dilakukan anggota. <br>
                                        Rincian dana keuntungan nantinya akan dibagi: <br>
                                        1. Dana Cadangan {{$mdata->prosentase_danacadangan}}%<br>
                                        2. Dana S0sial {{$mdata->prosentase_danasosial}}%<br>
                                        3. SHU Pengurus {{$mdata->prosentase_shupengurus}}%<br>
                                        3. SHU Anggota {{$mdata->prosentase_shuanggota}}%<br>
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div>
                            <i class="far fa-clock bg-gray"></i>
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