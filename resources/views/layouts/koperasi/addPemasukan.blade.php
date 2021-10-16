@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Pemasukan Koperasi</h1>
        </div>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Pemasukan Baru</h3>
                        </div>
                        @if (session('statusdg'))
                        <div class="alert alert-danger">
                        {{session('statusdg')}}
                        </div>
                        @endif
                        <form action="/pemasukan/tambah" method="post">
                            @csrf
                            <!--card-body -->
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                  <label>Tanggal</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input name="tglmasuk" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{old('tglmasuk')}}"/>
                                          @if ($errors->has('tglmasuk'))
                                          <span class="text-danger">{{ $errors->first('tglmasuk') }}</span>
                                          @endif
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_pemasukan">Jenis Pemasukan</label>
                                    <select class="form-control bg-secondary" name="jenis_pemasukan" value="{{old('jenis_pemasukan')}}">
                                      <option>Dana Aman</option>
                                      <option>Dana Cadangan</option>
                                      <option>Dana Sosial</option>
                                    </select>
                                  </div>
                                  @if ($errors->has('jenis_pemasukan'))
                                  <span class="text-danger">{{ $errors->first('jenis_pemasukan') }}</span>
                                  @endif
                                <div class="form-group">
                                    <label for="pemasukan">Pemasukan</label>
                                    <input type="text" class="form-control" name="pemasukan" placeholder="Pemasukan" value="{{old('pemasukan')}}">
                                    @if ($errors->has('pemasukan'))
                                    <span class="text-danger">{{ $errors->first('pemasukan') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" placeholder="Jumlah" value="{{old('jumlah')}}">
                                    @if ($errors->has('jumlah'))
                                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">Oke...</textarea>
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