@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Master Data</h1>
        </div>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Master Data</h3>
                        </div>
                        @if (session('statusdg'))
                        <div class="alert alert-danger">
                        {{session('statusdg')}}
                        </div>
                        @endif
                        <div class="card-body">
                            <form action="/mdata/update/{{$mdata->id}}" method="POST">
                              @csrf
                                <div class="form-group">
                                    <label for="registrasi">Registrasi</label>
                                    <input type="text" class="form-control" name="registrasi" placeholder="Registrasi" value="{{$mdata->registrasi}}">
                                    @if ($errors->has('registrasi'))
                                    <span class="text-danger">{{ $errors->first('registrasi') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="s_pokok">Simpanan Pokok</label>
                                    <input type="text" class="form-control" name="s_pokok" placeholder="Simpanan Pokok" value="{{$mdata->s_pokok}}">
                                    @if ($errors->has('s_pokok'))
                                    <span class="text-danger">{{ $errors->first('s_pokok') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="s_wajib">Simpanan Wajib</label>
                                    <input type="text" class="form-control" name="s_wajib" placeholder="Simpanan Wajib" value="{{$mdata->s_wajib}}">
                                    @if ($errors->has('s_wajib'))
                                    <span class="text-danger">{{ $errors->first('s_wajib') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="qordh">Maksimal Hutang</label>
                                    <input type="text" class="form-control" name="qordh" placeholder="Maksimal Hutang" value="{{$mdata->qordh}}">
                                    @if ($errors->has('qordh'))
                                    <span class="text-danger">{{ $errors->first('qordh') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="keuntungan">Prosentase Keuntungan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control col-sm-3" name="keuntungan" placeholder="Prosentase Keuntungan" value="{{$mdata->prosentase_keuntungan}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @if ($errors->has('keuntungan'))
                                        <span class="text-danger">{{ $errors->first('keuntungan') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="danacadangan">Prosentase Dana Cadangan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control col-sm-3" name="danacadangan" placeholder="Prosentase Dana Cadangan" value="{{$mdata->prosentase_danacadangan}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @if ($errors->has('danacadangan'))
                                        <span class="text-danger">{{ $errors->first('danacadangan') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="danasosial">Prosentase Dana Sosial</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control col-sm-3" name="danasosial" placeholder="Prosentase Dana Sosial" value="{{$mdata->prosentase_danasosial}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @if ($errors->has('danasosial'))
                                        <span class="text-danger">{{ $errors->first('danasosial') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="shupengurus">Prosentase SHU Pengurus</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control col-sm-3" name="shupengurus" placeholder="Prosentase" value="{{$mdata->prosentase_shupengurus}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @if ($errors->has('shupengurus'))
                                        <span class="text-danger">{{ $errors->first('shupengurus') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="shuanggota">Prosentase SHU Anggota</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control col-sm-3" name="shuanggota" placeholder="Prosentase" value="{{$mdata->prosentase_shuanggota}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @if ($errors->has('shuanggota'))
                                        <span class="text-danger">{{ $errors->first('shuanggota') }}</span>
                                        @endif
                                    </div>
                                </div>
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                            </form>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection