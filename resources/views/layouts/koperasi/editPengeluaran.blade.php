@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Data Pengeluaran Koperasi</h1>
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
                            <h3 class="card-title">Edit Pengeluaran Baru</h3>
                        </div>
                        @if (session('statusdg'))
                        <div class="alert alert-danger">
                        {{session('statusdg')}}
                        </div>
                        @endif
                        <form action="/pengeluaran/update/{{$pengeluaran->id_pengeluaran}}" method="post">
                            @csrf
                            <!--card-body -->
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                    <label for="id_angsuran_kredit">ID</label>
                                    <input type="id" class="form-control col-md-4" name="id_angsuran_kredit" value="MSK{{$pengeluaran->id_pengeluaran}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tglkeluar">Tanggal</label>
                                    <input type="date" class="form-control col-sm-4" name="tglkeluar" placeholder="Tanggal" value="{{$pengeluaran->tgl}}">
                                    @if ($errors->has('tglhutang'))
                                    <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="pengeluaran">pengeluaran</label>
                                    <input type="text" class="form-control" name="pengeluaran" placeholder="Pengeluaran" value="{{$pengeluaran->pengeluaran}}">
                                    @if ($errors->has('pengeluaran'))
                                    <span class="text-danger">{{ $errors->first('pengeluaran') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" value="{{$pengeluaran->jumlah}}">
                                    @if ($errors->has('jumlah'))
                                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="{{$pengeluaran->harga}}">
                                    @if ($errors->has('harga'))
                                    <span class="text-danger">{{ $errors->first('harga') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="total_harga">Total Harga</label>
                                    <input type="text" class="form-control" id="total_harga" name="total_harga" placeholder="Total Harga" value="{{$pengeluaran->total_harga}}" readonly>
                                    @if ($errors->has('total_harga'))
                                    <span class="text-danger">{{ $errors->first('total_harga') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">{{$pengeluaran->keterangan}}</textarea>
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
    $(document).ready(function() {
        $("#jumlah, #harga").keyup(function() {
            var jumlah  = $("#jumlah").val();
            var harga = $("#harga").val();

            var total_harga = parseFloat(jumlah) * parseFloat(harga);
            $("#total_harga").val(total_harga);
        });
    });
</script>
@endsection